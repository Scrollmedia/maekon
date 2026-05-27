import gsap from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

/** Только пробелы/переносы (не NBSP) — чтобы «и&nbsp;стандарты» оставалось одним словом */
const WORD_SPLIT = /[\u0020\n\r\t\f\v]+/

const SPLITTABLE_INLINE = new Set([
    'SPAN',
    'B',
    'STRONG',
    'EM',
    'I',
    'U',
    'MARK',
    'SMALL',
    'ABBR',
    'CITE',
    'CODE',
    'A',
    'SUB',
    'SUP',
])

let inited = false

function shouldSkipWholeElement(el) {
    if (!(el instanceof Element)) return false
    if (el.matches('[data-digit-roll], .digit-roll')) return true
    if (el.classList.contains('sr-only')) return true
    return false
}

function isSplittableInline(el) {
    if (!(el instanceof Element)) return false
    if (shouldSkipWholeElement(el)) return false
    return SPLITTABLE_INLINE.has(el.tagName)
}

function createWordSpan(word) {
    const outer = document.createElement('span')
    outer.className = 'heading-reveal__word'
    const inner = document.createElement('span')
    inner.className = 'heading-reveal__word-inner'
    inner.textContent = word
    outer.appendChild(inner)
    return outer
}

function appendWordsFromText(frag, text) {
    if (!text) return
    const hasLeading = /^[\u0020\n\r\t\f\v]/.test(text)
    const hasTrailing = /[\u0020\n\r\t\f\v]$/.test(text)
    const core = text.replace(/^[\u0020\n\r\t\f\v]+/, '').replace(/[\u0020\n\r\t\f\v]+$/, '')
    const words = core.split(WORD_SPLIT).filter(Boolean)

    if (!words.length) {
        if (hasLeading && frag.lastChild) frag.appendChild(document.createTextNode(' '))
        if (hasTrailing) frag.appendChild(document.createTextNode(' '))
        return
    }

    if (hasLeading && frag.lastChild) frag.appendChild(document.createTextNode(' '))

    words.forEach((w, i) => {
        if (i) frag.appendChild(document.createTextNode(' '))
        frag.appendChild(createWordSpan(w))
    })

    if (hasTrailing) frag.appendChild(document.createTextNode(' '))
}

function processNodeToFragment(node, frag) {
    if (node.nodeType === Node.TEXT_NODE) {
        appendWordsFromText(frag, node.textContent)
        return
    }

    if (node.nodeType !== Node.ELEMENT_NODE) return

    const el = node

    if (el.tagName === 'BR') {
        frag.appendChild(el)
        return
    }

    if (shouldSkipWholeElement(el)) {
        frag.appendChild(el)
        return
    }

    if (isSplittableInline(el)) {
        const innerFrag = document.createDocumentFragment()
        for (const child of [...el.childNodes]) {
            processNodeToFragment(child, innerFrag)
        }
        el.replaceChildren(innerFrag)
        frag.appendChild(el)
        return
    }

    frag.appendChild(el)
}

function buildHeadingFragment(heading) {
    const frag = document.createDocumentFragment()
    for (const node of [...heading.childNodes]) {
        processNodeToFragment(node, frag)
    }
    return frag
}

function splitHeadingIntoWords(heading) {
    if (heading.dataset.headingRevealDone === 'true') return

    heading.replaceChildren(buildHeadingFragment(heading))

    if (heading.querySelector('.heading-reveal__word')) {
        heading.classList.add('heading-reveal')
    }

    heading.dataset.headingRevealDone = 'true'
}

function shouldProcessHeading(heading) {
    if (heading.dataset.headingReveal === 'off') return false
    if (heading.closest('.swiper-slide-duplicate')) return false
    if (!heading.textContent || !heading.textContent.trim()) return false
    return true
}

function initHeadingReveal() {
    if (inited) return

    const main = document.querySelector('main')
    if (!main) return

    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches
    if (prefersReduced) return

    inited = true
    gsap.registerPlugin(ScrollTrigger)

    const headings = main.querySelectorAll('h1, h2, h3, h4, h5, h6')

    headings.forEach((heading) => {
        if (!shouldProcessHeading(heading)) return
        splitHeadingIntoWords(heading)
    })

    const runAnimations = () => {
        main.querySelectorAll('.heading-reveal').forEach((heading) => {
            const inners = heading.querySelectorAll('.heading-reveal__word-inner')
            if (!inners.length) return

            gsap.set(inners, { y: '115%' })
            gsap.to(inners, {
                y: '0%',
                duration: 0.72,
                ease: 'power3.out',
                stagger: 0.045,
                scrollTrigger: {
                    trigger: heading,
                    start: 'top 90%',
                    once: true,
                },
            })
        })

        ScrollTrigger.refresh()
    }

    if (document.fonts?.ready) {
        document.fonts.ready.then(runAnimations)
    } else {
        runAnimations()
    }
}

export { initHeadingReveal }
