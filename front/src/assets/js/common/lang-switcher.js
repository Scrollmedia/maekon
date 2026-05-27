const LANG_STORAGE_KEY = 'lang'
const LANG_DEFAULT = 'ru'
const AVAILABLE_LANGS = ['ru', 'en', 'by']

function getInitialLang() {
    const langFromQuery = new URLSearchParams(window.location.search).get(LANG_STORAGE_KEY)
    if (AVAILABLE_LANGS.includes(langFromQuery)) return langFromQuery

    const savedLang = localStorage.getItem(LANG_STORAGE_KEY)
    if (AVAILABLE_LANGS.includes(savedLang)) return savedLang

    if (AVAILABLE_LANGS.includes(document.documentElement.lang)) return document.documentElement.lang

    return LANG_DEFAULT
}

function applyLang(lang, switchers) {
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
}
