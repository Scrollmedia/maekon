import gulp from 'gulp';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import rename from 'gulp-rename';
import concat from 'gulp-concat';
import nunjucksRender from 'gulp-nunjucks-render';
import prettyHtml from 'gulp-pretty-html';
import browserSync from 'browser-sync';
import { deleteAsync } from 'del';
import fs from 'node:fs';
import path from 'node:path';
import { optimize } from 'svgo';
import through2 from 'through2';
import { build as esbuildBuild } from 'esbuild';

const bs = browserSync.create();
const COMBINE_COMPONENT_CSS = true;

const SVGO_ICONS = {
  plugins: [
    {
      name: 'removeAttrs',
      params: {
        attrs: '*:(fill|width|height)',
      },
    },
  ],
};

const SVGO_ICONS_KEEP_FILL = {
  plugins: [
    {
      name: 'removeAttrs',
      params: {
        attrs: '*:(width|height)',
      },
    },
  ],
};

// ====================== Очистка ======================
function clean() {
  return deleteAsync(['dist']);
}

// ====================== Сборка CSS ======================
function buildCommonCss() {
  return gulp.src('src/assets/css/common.css')
    .pipe(sourcemaps.init())
    .pipe(postcss())
    .pipe(rename('common.css'))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('dist/assets/css'));
}

function buildComponentCssSplit() {
  return gulp.src('src/components/**/*.css', { base: 'src/components' })
    .pipe(sourcemaps.init())
    .pipe(postcss())
    .pipe(rename((path) => {
      const segments = path.dirname.split('/');
      if (segments.length > 0) {
        segments.pop();
        path.dirname = segments.join('/');
      }
    }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('dist/assets/css/components'));
}

function buildComponentCssBundle() {
  return gulp.src('src/components/**/*.css')
    .pipe(sourcemaps.init())
    .pipe(postcss())
    .pipe(concat('components.css'))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('dist/assets/css'));
}

function copyFonts() {
  // Gulp 5: по умолчанию utf8 — бинарные woff/woff2 портятся → OTS / decode errors в браузере
  return gulp.src('src/assets/fonts/**/*', { allowEmpty: true, encoding: false })
    .pipe(gulp.dest('dist/assets/fonts', { encoding: false }))
    .pipe(bs.stream());
}

function copyImages() {
  return gulp.src('src/assets/images/**/*', { allowEmpty: true, encoding: false })
    .pipe(gulp.dest('dist/assets/images', { encoding: false }))
    .pipe(bs.stream());
}

const buildComponentCss = COMBINE_COMPONENT_CSS ? buildComponentCssBundle : buildComponentCssSplit;

const buildCss = gulp.parallel(buildCommonCss);
const buildCssThenFonts = gulp.series(buildCss, copyFonts);

function processIcons() {
  return Promise.resolve();
}

function buildSvgSprite() {
  const iconsGlob = 'src/assets/icons/**/*.svg';
  const files = [];

  return gulp.src(iconsGlob, { allowEmpty: true })
    .pipe(through2.obj((file, _, cb) => {
      files.push(file);
      cb(null, file);
    }, async function flush(cb) {
      try {
        const symbols = files
          .filter(file => file.isBuffer())
          .map(file => {
            const relativePath = path.relative(path.resolve('src/assets/icons'), file.path);
            const iconId = relativePath
              .replace(/\\/g, '/')
              .replace(/\.svg$/i, '')
              .replace(/\//g, '-')
              .replace(/[^a-zA-Z0-9_-]/g, '-');

            const raw = file.contents.toString('utf8');
            const normalizedRelativePath = relativePath.replace(/\\/g, '/');
            const iconSvgoConfig = normalizedRelativePath === 'logo-scroll.svg'
              ? SVGO_ICONS_KEEP_FILL
              : SVGO_ICONS;
            const optimized = optimize(raw, iconSvgoConfig);
            if (optimized.error) throw new Error(optimized.error);

            const viewBoxMatch = optimized.data.match(/viewBox="([^"]+)"/i);
            const viewBox = viewBoxMatch ? viewBoxMatch[1] : '0 0 24 24';
            const svgContent = optimized.data
              .replace(/<\?xml[\s\S]*?\?>/gi, '')
              .replace(/<!doctype[\s\S]*?>/gi, '')
              .replace(/<svg[^>]*>/i, '')
              .replace(/<\/svg>\s*$/i, '')
              .trim();

            return `<symbol id="${iconId}" viewBox="${viewBox}">${svgContent}</symbol>`;
          });

        const sprite = `<svg xmlns="http://www.w3.org/2000/svg" style="display:none">${symbols.join('')}</svg>`;
        fs.mkdirSync('dist/assets/icons', { recursive: true });
        fs.writeFileSync('dist/assets/icons/sprite.svg', sprite, 'utf8');
        cb();
      } catch (error) {
        cb(error);
      }
    }));
}

// ====================== Nunjucks ======================
function nunjucks() {
  return gulp.src('src/pages/**/*.njk')
    .pipe(nunjucksRender({
      path: ['dist/assets/icons', 'src/assets/images', 'src/components', 'src/pages'],
      data: { combineComponentCss: COMBINE_COMPONENT_CSS },
      envOptions: { autoescape: false }
    }))
    .pipe(rename({ extname: '.html' }))
    .pipe(prettyHtml({
      indent_size: 2,
      indent_char: ' ',
      preserve_newlines: false,
      max_preserve_newlines: 0,
      unformatted: []
    }))
    .pipe(gulp.dest('dist'))
    .pipe(bs.stream());
}

// ====================== JS ======================
async function scriptsDev() {
  if (!fs.existsSync('src/assets/js')) return;

  const swiperEntry = 'src/assets/js/main.js';
  const swiperOutFile = 'dist/assets/js/main.js';

  if (fs.existsSync(swiperEntry)) {
    await esbuildBuild({
      entryPoints: [swiperEntry],
      outfile: swiperOutFile,
      bundle: true,
      format: 'esm',
      platform: 'browser',
      target: ['es2017'],
      sourcemap: true,
      minify: false,
    });
  }

  return gulp.src(['src/assets/js/**/*', '!src/assets/js/main.js'], { allowEmpty: true })
    .pipe(gulp.dest('dist/assets/js'))
    .pipe(bs.stream());
}

async function scriptsBuild() {
  if (!fs.existsSync('src/assets/js')) return;

  const entryPoints = fs.readdirSync('src/assets/js')
    .filter((fileName) => fileName.endsWith('.js'))
    .map((fileName) => path.join('src/assets/js', fileName));

  if (entryPoints.length === 0) return;

  await esbuildBuild({
    entryPoints,
    outdir: 'dist/assets/js',
    bundle: true,
    format: 'esm',
    platform: 'browser',
    target: ['es2017'],
    sourcemap: true,
    minify: true,
  });
}

// ====================== Live сервер ======================
function serve(done) {
  bs.init({
    server: { baseDir: 'dist' },
    port: 3000,
    notify: false,
    open: false,
    files: [
      'dist/assets/css/**/*.css',
      'dist/assets/fonts/**/*',
      'dist/assets/icons/**/*',
      'dist/assets/images/**/*',
      'dist/**/*.html',
      'dist/assets/js/**/*'
    ]
  }, done);
}

const rebuildTailwindAndPages = gulp.series(buildCommonCss, nunjucks);
const buildIcons = gulp.series(processIcons, buildSvgSprite);
const rebuildIconsAndPages = gulp.series(buildIcons, nunjucks);

function watchFiles() {
  gulp.watch('src/assets/css/common.css', buildCommonCss);
  gulp.watch('src/assets/css/**/**/**/**/*.css', buildCommonCss);
  gulp.watch('src/assets/fonts/**/*', copyFonts);
  gulp.watch('src/assets/icons/**/*.svg', rebuildIconsAndPages);
  gulp.watch('src/assets/images/**/*', gulp.series(copyImages, nunjucks));
  gulp.watch(['src/pages/**/*.njk', 'src/components/**/*.njk'], rebuildTailwindAndPages);
  gulp.watch('src/assets/js/**/*', scriptsDev);
}

// ====================== Основные задачи ======================
const devTask = gulp.series(
  clean,
  gulp.parallel(buildCssThenFonts, buildIcons, copyImages),
  gulp.parallel(nunjucks, scriptsDev),
  gulp.parallel(serve, watchFiles)
);

const buildTask = gulp.series(
  clean,
  gulp.parallel(buildCssThenFonts, buildIcons, copyImages),
  gulp.parallel(nunjucks, scriptsBuild)
);

export { devTask as dev };
export { buildTask as build };
export default devTask;