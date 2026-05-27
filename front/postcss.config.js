import tailwindcss from '@tailwindcss/postcss';
import autoprefixer from 'autoprefixer';
import cssnano from 'cssnano';

export default {
  plugins: [
    tailwindcss({
      transformAssetUrls: false,
    }),
    autoprefixer(),
    cssnano({
      preset: [
        'default',
        {
          discardComments: {
            removeAll: true,
          },
        },
      ],
    }),
  ],
};

