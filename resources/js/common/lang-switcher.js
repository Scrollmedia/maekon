const LANG_STORAGE_KEY = 'lang'
const LANG_DEFAULT = 'ru'
const AVAILABLE_LANGS = ['ru', 'en', 'by']

// Функция для чтения куки Google Translate
function getGoogleTranslateCookie() {
    const match = document.cookie.match(/googtrans=\/[^/]+\/([^;]+)/);
    if (!match) return null;
    const lang = match[1];
    return lang === 'be' ? 'by' : lang; // возвращаем 'by', если у Google записан 'be'
}

function getInitialLang() {
    const langFromQuery = new URLSearchParams(window.location.search).get(LANG_STORAGE_KEY)
    if (AVAILABLE_LANGS.includes(langFromQuery)) return langFromQuery

    const savedLang = localStorage.getItem(LANG_STORAGE_KEY)
    if (AVAILABLE_LANGS.includes(savedLang)) return savedLang

    // Проверяем куки самого гугла (важно при переходах между страницами)
    const googleLang = getGoogleTranslateCookie();
    if (AVAILABLE_LANGS.includes(googleLang)) return googleLang;

    if (AVAILABLE_LANGS.includes(document.documentElement.lang)) return document.documentElement.lang

    return LANG_DEFAULT
}

function changeGoogleLanguage(langCode) {
    const googleLangCode = langCode === 'by' ? 'be' : langCode;
    const googleSelect = document.querySelector('#google_translate_element select');
    
    if (googleSelect) {
        // Если выбран дефолтный язык (ru) и гугл еще ничего не переводил, просто выходим из функции
        if (googleLangCode === 'ru' && !getGoogleTranslateCookie()) return;

        if (googleSelect.value !== googleLangCode) {
            googleSelect.value = googleLangCode;
            googleSelect.dispatchEvent(new Event('change'));
        }
    } else {
        // Избегаем бесконечного вызова для дефолтного языка при загрузке
        if (langCode === 'ru' && !getGoogleTranslateCookie()) return;
        
        setTimeout(() => changeGoogleLanguage(langCode), 150);
    }
}

function applyLang(lang, switchers) {
    changeGoogleLanguage(lang);

    document.documentElement.lang = lang
    document.documentElement.dataset.lang = lang
    localStorage.setItem(LANG_STORAGE_KEY, lang)

    switchers.forEach((switcher) => {
        const currentEl = switcher.querySelector('[data-lang-current]')
        const optionEls = Array.from(switcher.querySelectorAll('[data-lang-option]'))

        if (currentEl) {
            currentEl.textContent = lang.toUpperCase()
            currentEl.setAttribute('href', `?lang=${lang}`)
        }

        optionEls.forEach((optionEl) => {
            const optionLang = optionEl.getAttribute('data-lang-option')
            optionEl.classList.toggle('active', optionLang === lang)
        })
    })
}

function initMenuLabelsTranslation() {

    const menuTracks = document.querySelectorAll('.header__menu-link-track[data-label]');

    menuTracks.forEach((track) => {
        const textEl = track.querySelector('.header__menu-link-text');
        if (!textEl) return;

        const observer = new MutationObserver(() => {

            const translatedText = textEl.textContent.trim();
            
            if (translatedText && track.getAttribute('data-label') !== translatedText) {
                track.setAttribute('data-label', translatedText);
            }
        });

        observer.observe(textEl, {
            childList: true,
            characterData: true,
            subtree: true
        });
    });
}

export function initLangSwitcher() {
    const switchers = Array.from(document.querySelectorAll('.lang-switcher'))

    if (switchers.length === 0) return

    let currentLang = getInitialLang()

    applyLang(currentLang, switchers)

    switchers.forEach((switcher) => {
        const links = switcher.querySelectorAll('[data-lang-option], [data-lang-current]')

        links.forEach((linkEl) => {
            linkEl.addEventListener('click', (event) => {
                event.preventDefault()
                const nextLang = linkEl.getAttribute('data-lang-option') || currentLang
                if (!AVAILABLE_LANGS.includes(nextLang)) return

                currentLang = nextLang
                applyLang(currentLang, switchers)
            })
        })

        switcher.addEventListener('mouseleave', () => {
            applyLang(currentLang, switchers)
        })
    })
    initMenuLabelsTranslation();
}
