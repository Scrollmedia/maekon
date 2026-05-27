const MQ_3XL = 1919
const EDGE_EPS = 2

const FADE_SCROLL_CLASSES = ['fade-scroll--start', 'fade-scroll--mid', 'fade-scroll--end']

function clearFadeScroll(el) {
    for (const c of FADE_SCROLL_CLASSES) {
        el.classList.remove(c)
    }
}

function syncScrollFade(el, mq) {
    clearFadeScroll(el)
    if (!mq.matches || !el.classList.contains('is-overflow')) return

    const { scrollTop, scrollHeight, clientHeight } = el
    const maxScroll = scrollHeight - clientHeight
    if (maxScroll <= 0) return

    if (maxScroll <= EDGE_EPS) {
        el.classList.add('fade-scroll--start')
        return
    }

    const atTop = scrollTop <= EDGE_EPS
    const atBottom = scrollTop >= maxScroll - EDGE_EPS

    if (atTop && !atBottom) el.classList.add('fade-scroll--start')
    else if (!atTop && atBottom) el.classList.add('fade-scroll--end')
    else if (!atTop && !atBottom) el.classList.add('fade-scroll--mid')
    else el.classList.add('fade-scroll--mid')
}

export function initOverflowFade() {
    const wrappers = [
        ...document.querySelectorAll('.direction2-card__content-inner'),
        ...document.querySelectorAll('.slider-info-card__content'),
    ]
    if (!wrappers.length) return

    const mq = window.matchMedia(`(max-width: ${MQ_3XL}px)`)

    const onScroll = (ev) => {
        syncScrollFade(ev.currentTarget, mq)
    }

    const update = () => {
        wrappers.forEach((el) => {
            if (mq.matches) {
                el.classList.toggle('is-overflow', el.scrollHeight > el.clientHeight)
            } else {
                el.classList.remove('is-overflow')
            }
            syncScrollFade(el, mq)
        })
    }

    for (const el of wrappers) {
        el.addEventListener('scroll', onScroll, { passive: true })
    }

    update()
    mq.addEventListener('change', update)
    window.addEventListener('resize', update)
}
