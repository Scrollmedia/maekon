const XL_MAX = 1279
const MD_MIN = 768

export function initHeaderNav() {
    const header = document.querySelector('.header')
    const burger = document.querySelector('.burger-btn')
    const drawer = document.querySelector('#header-menu-panel')

    if (!header || !burger || !drawer) return

    const mq = window.matchMedia(`(max-width: ${XL_MAX}px)`)
    const mqMdUp = window.matchMedia(`(min-width: ${MD_MIN}px)`)

    const syncDrawerAria = () => {
        if (!mq.matches) {
            drawer.removeAttribute('aria-hidden')
            return
        }
        drawer.setAttribute('aria-hidden', header.classList.contains('header--nav-open') ? 'false' : 'true')
    }

    const body = header.querySelector('.header__body')

    const updateBodyHeight = () => {
        if (!body) return
        if (header.classList.contains('header--nav-open') && !mqMdUp.matches) {
            const drawerHeight = drawer.getBoundingClientRect().height
            body.style.height = `calc(var(--header-height) + ${drawerHeight}px)`
        } else {
            body.style.height = ''
        }
    }

    const close = () => {
        header.classList.remove('header--nav-open')
        burger.classList.remove('active')
        burger.setAttribute('aria-expanded', 'false')
        syncDrawerAria()
        document.documentElement.classList.remove('overflow-hidden')
        updateBodyHeight()
    }

    const open = () => {
        if (!mq.matches) return

        header.classList.add('header--nav-open')
        burger.classList.add('active')
        burger.setAttribute('aria-expanded', 'true')
        syncDrawerAria()
        document.documentElement.classList.add('overflow-hidden')
        updateBodyHeight()
    }

    const toggle = () => {
        if (header.classList.contains('header--nav-open')) close()
        else open()
    }

    burger.addEventListener('click', () => {
        if (!mq.matches) return
        toggle()
    })

    drawer.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', close)
    })

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') close()
    })

    mq.addEventListener('change', () => {
        if (!mq.matches) close()
        syncDrawerAria()
    })
    mqMdUp.addEventListener('change', updateBodyHeight)

    syncDrawerAria()
}
