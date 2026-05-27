import Lenis from 'lenis'
import gsap from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

let inited = false
let lenisInstance = null

export function getLenis() {
    return lenisInstance
}

export function initSmoothScroll() {
    if (inited) return
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return

    inited = true
    gsap.registerPlugin(ScrollTrigger)

    lenisInstance = new Lenis({
        lerp: 0.085,
        smoothWheel: true,
        wheelMultiplier: 1,
        touchMultiplier: 1,
        anchors: true,
        allowNestedScroll: true,
    })

    lenisInstance.on('scroll', ScrollTrigger.update)

    gsap.ticker.add((time) => {
        lenisInstance.raf(time * 1000)
    })
    gsap.ticker.lagSmoothing(0)
}
