import Swiper from 'swiper'
import { Navigation } from 'swiper/modules'

const SWIPE_MIN_PX = 48

function bindHorizontalSwipeSlide(el, slider) {
    let startX = 0
    let startY = 0
    let activeId = null

    const onDown = (e) => {
        if (e.pointerType === 'mouse' && e.button !== 0) return
        startX = e.clientX
        startY = e.clientY
        activeId = e.pointerId
        try {
            e.currentTarget.setPointerCapture(e.pointerId)
        } catch {
            /* noop */
        }
    }

    const onEnd = (e) => {
        if (e.pointerId !== activeId) return
        activeId = null
        try {
            e.currentTarget.releasePointerCapture(e.pointerId)
        } catch {
            /* noop */
        }

        const dx = e.clientX - startX
        const dy = e.clientY - startY
        if (Math.abs(dx) < SWIPE_MIN_PX || Math.abs(dx) <= Math.abs(dy) * 1.15) return

        if (dx < 0) slider.slideNext()
        else slider.slidePrev()
    }

    el.addEventListener('pointerdown', onDown)
    el.addEventListener('pointerup', onEnd)
    el.addEventListener('pointercancel', onEnd)
}

export function initGalleryVideoSlider(options = {}) {
    const sliderEl = document.querySelector('.gallery-video-slider')

    if (!sliderEl) return

    const sectionEl = sliderEl.closest('.specs-info__block')
    const counterRoots = sectionEl
        ? [...sectionEl.querySelectorAll('.gallery-video-slider__counter')]
        : []
    const slidesCount = sliderEl.querySelectorAll('.swiper-slide').length

    for (const root of counterRoots) {
        const totalEl = root.querySelector('.slider-counter__total')
        if (totalEl) totalEl.textContent = String(slidesCount)
    }

    const slider = new Swiper(sliderEl, {
        modules: [Navigation],
        slidesPerView: 1,
        spaceBetween: 12,
        speed: options.speed ?? 600,
        loop: true,
        navigation: {
            nextEl: '.gallery-video-slider__next',
            prevEl: '.gallery-video-slider__prev',
        },
        breakpoints: {
            768: {
                slidesPerView: sliderEl.closest('.article-detail') ? 2 : 'auto',
                spaceBetween: 16,
            },
            1280: {
                slidesPerView: sliderEl.closest('.article-detail') ? 2 : 'auto',
                spaceBetween: 20,
            },
            1868: {
                slidesPerView: sliderEl.closest('.article-detail') ? 2 : 3,
            },
        },
    })

    const updateCounter = () => {
        const value = String(slider.realIndex + 1)
        for (const root of counterRoots) {
            const currentEl = root.querySelector('.slider-counter__current')
            if (currentEl) currentEl.textContent = value
        }
    }

    updateCounter()
    slider.on('slideChange', updateCounter)

    const swipeZones = sliderEl.querySelectorAll(
        '.gallery-video-card__edge, .gallery-video-card__content'
    )
    swipeZones.forEach((zone) => bindHorizontalSwipeSlide(zone, slider))
}
