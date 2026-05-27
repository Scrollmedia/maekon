import gsap from 'gsap'

export function initHeaderEnter() {
    const header = document.querySelector('.header')
    if (!header) return
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return

    const inner = header.querySelector(':scope > .container')
    if (!inner) return

    gsap.set(inner, { autoAlpha: 0, y: -32 })

    gsap.to(inner, {
        autoAlpha: 1,
        y: 0,
        duration: 0.75,
        ease: 'power3.out',
        delay: 0.06,
    })
}
