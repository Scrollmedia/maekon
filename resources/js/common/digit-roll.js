import gsap from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

function parseTarget(raw) {
    const digits = String(raw || '').replace(/\D/g, '')
    const n = parseInt(digits, 10)
    return Number.isFinite(n) ? n : NaN
}

function initDigitRoll() {
    const roots = document.querySelectorAll('[data-digit-roll]')
    if (!roots.length) return

    gsap.registerPlugin(ScrollTrigger)

    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches

    const run = () => {
        roots.forEach((root) => {
            if (root.dataset.digitRollInited === 'true') return

            const valueEl = root.querySelector('[data-digit-roll-value]')
            if (!valueEl) return

            const target = parseTarget(root.dataset.value)
            if (!Number.isFinite(target) || target < 0) return

            root.dataset.digitRollInited = 'true'

            if (prefersReduced) {
                valueEl.textContent = String(target)
                return
            }

            const state = { n: 0 }
            gsap.to(state, {
                n: target,
                duration: 1.5,
                ease: 'power2.out',
                onUpdate: () => {
                    valueEl.textContent = String(Math.round(state.n))
                },
                scrollTrigger: {
                    trigger: root,
                    start: 'top 88%',
                    once: true,
                },
            })
        })

        ScrollTrigger.refresh()
    }

    if (document.fonts?.ready) {
        document.fonts.ready.then(run)
    } else {
        run()
    }
}

export { initDigitRoll }
