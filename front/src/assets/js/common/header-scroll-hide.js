import { getLenis } from './smooth-scroll'

const TOP_REVEAL_PX = 48
const DELTA_MIN = 10

export function initHeaderScrollHide() {
    const header = document.querySelector('.header')
    if (!header) return

    let lastY = window.scrollY || document.documentElement.scrollTop

    const handle = (y) => {
        if (header.classList.contains('header--nav-open')) {
            header.classList.remove('header--scroll-hidden')
            lastY = y
            return
        }

        const d = y - lastY
        lastY = y

        if (y <= TOP_REVEAL_PX) {
            header.classList.remove('header--scroll-hidden')
            return
        }
        if (d > DELTA_MIN) header.classList.add('header--scroll-hidden')
        else if (d < -DELTA_MIN) header.classList.remove('header--scroll-hidden')
    }

    const lenis = getLenis()
    if (lenis) {
        lastY = lenis.scroll
        lenis.on('scroll', (l) => handle(l.scroll))
    } else {
        window.addEventListener(
            'scroll',
            () => handle(window.scrollY || document.documentElement.scrollTop),
            { passive: true }
        )
    }
}
