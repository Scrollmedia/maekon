import gsap from 'gsap'

function prefersReducedMotion() {
    return window.matchMedia('(prefers-reduced-motion: reduce)').matches
}

function measureExpandedHeight(content) {
    gsap.set(content, {
        height: 'auto',
        position: 'absolute',
        left: 0,
        right: 0,
        width: '100%',
        visibility: 'hidden',
        overflow: 'visible',
        pointerEvents: 'none',
    })
    const h = Math.ceil(content.offsetHeight)
    gsap.set(content, {
        clearProps: 'position,left,right,width,visibility,overflow,pointerEvents',
    })
    return Math.max(0, h)
}

function openPanel(content, prefersReduced) {
    gsap.killTweensOf(content)

    if (prefersReduced) {
        gsap.set(content, { height: 'auto', overflow: 'hidden' })
        return
    }

    requestAnimationFrame(() => {
        const target = measureExpandedHeight(content)
        gsap.set(content, { height: 0, overflow: 'hidden' })

        if (target <= 0) {
            gsap.set(content, { height: 'auto', overflow: 'hidden' })
            return
        }

        gsap.to(content, {
            height: target,
            duration: 0.45,
            ease: 'power2.out',
            onComplete: () => {
                gsap.set(content, { height: 'auto' })
            },
        })
    })
}

function closePanel(content, accordion, prefersReduced) {
    gsap.killTweensOf(content)

    const finish = () => {
        accordion.classList.remove('active')
    }

    if (prefersReduced) {
        gsap.set(content, { height: 0, overflow: 'hidden' })
        finish()
        return
    }

    const current = Math.max(1, content.offsetHeight)
    gsap.set(content, { height: current, overflow: 'hidden' })

    gsap.to(content, {
        height: 0,
        duration: 0.35,
        ease: 'power2.in',
        onComplete: () => {
            gsap.set(content, { height: 0, overflow: 'hidden' })
            finish()
        },
    })
}

export function initAccordion() {
    const accordions = Array.from(document.querySelectorAll('.accordion'))

    if (accordions.length === 0) return

    const prefersReduced = prefersReducedMotion()

    accordions.forEach((accordion, index) => {
        const header = accordion.querySelector('.accordion__header')
        const toggle = accordion.querySelector('.accordion__toggle')
        const content = accordion.querySelector('.accordion__content')

        if (!header || !toggle || !content) return

        const contentId = content.id || `accordion-content-${index + 1}`
        content.id = contentId

        toggle.type = 'button'
        toggle.setAttribute('aria-controls', contentId)
        toggle.setAttribute('aria-expanded', 'false')

        gsap.set(content, { height: 0, overflow: 'hidden' })

        header.addEventListener('click', () => {
            const isExpanded = toggle.getAttribute('aria-expanded') === 'true'
            const nextExpanded = !isExpanded

            toggle.setAttribute('aria-expanded', String(nextExpanded))

            if (nextExpanded) {
                accordion.classList.add('active')
                openPanel(content, prefersReduced)
            } else {
                closePanel(content, accordion, prefersReduced)
            }
        })
    })
}
