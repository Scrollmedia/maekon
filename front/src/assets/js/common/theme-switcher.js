const THEME_STORAGE_KEY = 'theme'
const DARK_THEME = 'dark'
const LIGHT_THEME = 'light'

function getInitialTheme() {
    const savedTheme = localStorage.getItem(THEME_STORAGE_KEY)

    if (savedTheme === DARK_THEME || savedTheme === LIGHT_THEME) return savedTheme

    return window.matchMedia('(prefers-color-scheme: dark)').matches ? DARK_THEME : LIGHT_THEME
}

function setTheme(theme, switchers) {
    const isDark = theme === DARK_THEME

    document.documentElement.dataset.theme = theme
    document.documentElement.style.colorScheme = theme
    localStorage.setItem(THEME_STORAGE_KEY, theme)

    switchers.forEach((switcher) => {
        switcher.classList.toggle('theme-switcher--dark', isDark)
    })
}

export function initThemeSwitcher() {
    const switchers = Array.from(document.querySelectorAll('.theme-switcher'))

    if (switchers.length === 0) return

    let currentTheme = getInitialTheme()

    setTheme(currentTheme, switchers)

    switchers.forEach((switcher) => {
        switcher.addEventListener('click', () => {
            currentTheme = currentTheme === DARK_THEME ? LIGHT_THEME : DARK_THEME
            setTheme(currentTheme, switchers)
        })
    })
}
