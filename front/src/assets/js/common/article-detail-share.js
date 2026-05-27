import gsap from 'gsap'

const touchLikeQuery = '(hover: none), (pointer: coarse)'

function prefersReducedMotion() {
    return window.matchMedia('(prefers-reduced-motion: reduce)').matches
}

function duration() {
    return prefersReducedMotion() ? 0 : 0.3
}

function initPanel(content) {
    gsap.killTweensOf(content)
    gsap.set(content, {
        autoAlpha: 0,
        y: -8,
        scale: 0.96,
        transformOrigin: 'top center',
        pointerEvents: 'none',
    })
}

function openPanel(content) {
    const d = duration()
    gsap.killTweensOf(content)
    gsap.set(content, { pointerEvents: 'auto' })
    gsap.to(content, {
        autoAlpha: 1,
        y: 0,
        scale: 1,
        duration: d,
        ease: d ? 'power3.out' : 'none',
        overwrite: 'auto',
    })
}

function closePanel(content, onComplete) {
    const d = duration()
    gsap.killTweensOf(content)
    gsap.to(content, {
        autoAlpha: 0,
        y: -8,
        scale: 0.96,
        duration: d,
        ease: d ? 'power3.in' : 'none',
        overwrite: 'auto',
        onComplete: () => {
            gsap.set(content, { pointerEvents: 'none' })
            onComplete?.()
        },
    })
}

export function initArticleDetailShare() {
    const roots = document.querySelectorAll('.article-detail__share')
    if (!roots.length) return

    const touchMql = window.matchMedia(touchLikeQuery)

    roots.forEach((root) => {
        const content = root.querySelector('.article-detail__share-content')
        const btn = root.querySelector('.article-detail__share-btn')
        if (!content || !btn) return

        initPanel(content)

        const stateClose = () => {
            root.classList.remove('is-open')
            btn.setAttribute('aria-expanded', 'false')
        }

        root.addEventListener('mouseenter', () => {
            if (touchMql.matches) return
            openPanel(content)
        })

        root.addEventListener('mouseleave', () => {
            if (touchMql.matches) return
            closePanel(content)
        })

        btn.setAttribute('aria-haspopup', 'true')
        btn.setAttribute('aria-expanded', 'false')

        btn.addEventListener('click', (e) => {
            if (!touchMql.matches) return
            e.preventDefault()
            e.stopPropagation()

            const opening = !root.classList.contains('is-open')

            if (opening) {
                roots.forEach((other) => {
                    if (other === root || !other.classList.contains('is-open')) return
                    const otherContent = other.querySelector('.article-detail__share-content')
                    const otherBtn = other.querySelector('.article-detail__share-btn')
                    if (!otherContent || !otherBtn) return
                    closePanel(otherContent, () => {
                        other.classList.remove('is-open')
                        otherBtn.setAttribute('aria-expanded', 'false')
                    })
                })
                root.classList.add('is-open')
                btn.setAttribute('aria-expanded', 'true')
                openPanel(content)
            } else {
                closePanel(content, stateClose)
            }
        })
    })

    const onDocPointerDown = (e) => {
        if (!touchMql.matches) return
        roots.forEach((root) => {
            if (!root.classList.contains('is-open')) return
            if (root.contains(e.target)) return
            const content = root.querySelector('.article-detail__share-content')
            const btn = root.querySelector('.article-detail__share-btn')
            if (!content || !btn) return
            closePanel(content, () => {
                root.classList.remove('is-open')
                btn.setAttribute('aria-expanded', 'false')
            })
        })
    }

    document.addEventListener('pointerdown', onDocPointerDown)
}
