import gsap from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

let inited = false

function getRevealDelay(item, group) {
    const raw = item.dataset.cardRevealDelay ?? group.dataset.cardRevealDelay
    if (raw == null) return 0

    const value = Number(raw)
    if (!Number.isFinite(value) || value < 0) return 0
    return value
}

export function initCardReveal() {
    if (inited) return

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return

    const groups = [...document.querySelectorAll('[data-card-reveal-group]')]
    if (!groups.length) return

    inited = true
    gsap.registerPlugin(ScrollTrigger)

    groups.forEach((group) => {
        const items = [...group.querySelectorAll('[data-card-reveal-item]')].filter(
            (el) => !el.classList.contains('swiper-slide-duplicate')
        )
        if (!items.length) return

        const start =
            group.dataset.cardRevealStart?.trim() || 'top 88%'

        items.forEach((item) => {
            const delay = getRevealDelay(item, group)
            gsap.fromTo(
                item,
                { y: 100, opacity: 0 },
                {
                    y: 0,
                    opacity: 1,
                    duration: 0.65,
                    delay,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: item,
                        start,
                        once: true,
                    },
                }
            )
        })
    })

    ScrollTrigger.refresh()
}
