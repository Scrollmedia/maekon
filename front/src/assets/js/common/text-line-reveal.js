import gsap from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

const WORD_SPLIT = /[\u0020\n\r\t\f\v]+/

let inited = false

function appendWrappedWordsFromText(frag, text) {
    if (!text) return

    const hasLeading = /^[\u0020\n\r\t\f\v]/.test(text)
    const hasTrailing = /[\u0020\n\r\t\f\v]$/.test(text)
    const core = text.replace(/^[\u0020\n\r\t\f\v]+/, '').replace(/[\u0020\n\r\t\f\v]+$/, '')
    const words = core.split(WORD_SPLIT).filter(Boolean)

    if (!words.length) {
        if ((hasLeading || hasTrailing) && frag.lastChild) frag.appendChild(document.createTextNode(' '))
        return
    }

    if (hasLeading && frag.lastChild) frag.appendChild(document.createTextNode(' '))

    words.forEach((word, index) => {
        if (index) frag.appendChild(document.createTextNode(' '))
        const span = document.createElement('span')
        span.className = 'line-reveal__word'
        span.textContent = word
        frag.appendChild(span)
    })

    if (hasTrailing) frag.appendChild(document.createTextNode(' '))
}

function wrapWords(node) {
    if (node.nodeType === Node.TEXT_NODE) {
        const text = node.textContent ?? ''
        const frag = document.createDocumentFragment()
        appendWrappedWordsFromText(frag, text)
        node.replaceWith(frag)
        return
    }

    if (node.nodeType !== Node.ELEMENT_NODE) return
    const el = node
    if (el.matches('[data-digit-roll], .digit-roll')) return

    ;[...el.childNodes].forEach((child) => wrapWords(child))
}

function splitIntoLines(target) {
    if (target.dataset.lineRevealDone === 'true') return

    wrapWords(target)

    const words = [...target.querySelectorAll('.line-reveal__word')]
    if (!words.length) return

    const lines = []
    let currentLine = []
    let currentTop = null
    const threshold = 2

    words.forEach((word) => {
        const top = Math.round(word.getBoundingClientRect().top)
        if (currentTop === null || Math.abs(top - currentTop) <= threshold) {
            currentLine.push(word)
            currentTop = currentTop === null ? top : currentTop
            return
        }
        lines.push(currentLine)
        currentLine = [word]
        currentTop = top
    })

    if (currentLine.length) lines.push(currentLine)

    const rebuilt = document.createDocumentFragment()

    lines.forEach((lineWords, lineIndex) => {
        const line = document.createElement('span')
        line.className = 'line-reveal__line'
        const inner = document.createElement('span')
        inner.className = 'line-reveal__line-inner'

        lineWords.forEach((word, index) => {
            if (index) inner.appendChild(document.createTextNode(' '))
            inner.appendChild(word)
        })

        line.appendChild(inner)
        rebuilt.appendChild(line)
        if (lineIndex < lines.length - 1) rebuilt.appendChild(document.createTextNode(' '))
    })

    target.replaceChildren(rebuilt)

    target.dataset.lineRevealDone = 'true'
}

export function initTextLineReveal() {
    if (inited) return

    const main = document.querySelector('main')
    if (!main) return
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return

    main.querySelectorAll('.prose p, .prose li, .prose > strong').forEach((el) => {
        if (el.hasAttribute('data-line-reveal')) return
        el.setAttribute('data-line-reveal-auto', 'true')
    })

    const targets = [...main.querySelectorAll('[data-line-reveal], [data-line-reveal-auto="true"]')]
    if (!targets.length) return

    inited = true
    gsap.registerPlugin(ScrollTrigger)

    const runAnimations = () => {
        targets.forEach((target) => {
            splitIntoLines(target)
            const lineInners = target.querySelectorAll('.line-reveal__line-inner')
            if (!lineInners.length) return

            gsap.set(lineInners, { y: '115%' })
            gsap.to(lineInners, {
                y: '0%',
                duration: 0.72,
                ease: 'power3.out',
                stagger: 0.045,
                scrollTrigger: {
                    trigger: target,
                    start: 'top 90%',
                    once: true,
                },
            })
        })

        ScrollTrigger.refresh()
    }

    if (document.fonts?.ready) document.fonts.ready.then(runAnimations)
    else runAnimations()
}
