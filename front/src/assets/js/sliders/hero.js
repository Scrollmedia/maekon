import Swiper from 'swiper'
import { Autoplay, Navigation } from 'swiper/modules'

export function initHeroSlider(options = {}) {
    const sliderEl = document.querySelector('.hero__slider')
    const paginationEl = document.querySelector('.hero__slider-pagination')

    if (!sliderEl || !paginationEl) return

    paginationEl.textContent = ''

    const trackEl = document.createElement('div')
    trackEl.className = 'hero__slider-pagination-track'
    paginationEl.appendChild(trackEl)

    const slides = Array.from(sliderEl.querySelectorAll('.swiper-slide'))

    const paginationItems = slides.map((_, index) => {
        const item = document.createElement('button')
        item.type = 'button'
        item.className = 'hero__slider-pagination-item'
        item.style.setProperty('--progress', '100%')
        item.dataset.slideIndex = String(index)
        trackEl.appendChild(item)
        return item
    })

    const updateOverflowClass = () => {
        const overflow = trackEl.scrollWidth > paginationEl.clientWidth + 1
        paginationEl.classList.toggle('hero__slider-pagination--overflow', overflow)
    }

    const updateTrackTransform = (realIndex) => {
        const active = paginationItems[realIndex]
        if (!active) return

        const vw = paginationEl.clientWidth
        const tw = trackEl.scrollWidth
        const minX = Math.min(0, vw - tw)

        const activeCenter = active.offsetLeft + active.offsetWidth / 2
        let x = vw / 2 - activeCenter
        x = Math.max(minX, Math.min(0, x))

        trackEl.style.transform = `translate3d(${x}px,0,0)`
    }

    const setActiveItem = (realIndex) => {
        paginationItems.forEach((item, index) => {
            item.classList.toggle('active', index === realIndex)
            item.style.setProperty('--progress', index === realIndex ? '100%' : '0%')
        })
        updateTrackTransform(realIndex)
    }

    const slider = new Swiper(sliderEl, {
        modules: [Autoplay, Navigation],
        slidesPerView: 1,
        loop: true,
        speed: options.speed ?? 600,
        autoplay: {
            delay: 5000,
            pauseOnMouseEnter: true,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.hero__slider-next',
            prevEl: '.hero__slider-prev',
        },
        on: {
            init(swiper) {
                updateOverflowClass()
                setActiveItem(swiper.realIndex)
            },
            slideChange(swiper) {
                setActiveItem(swiper.realIndex)
            },
            autoplayTimeLeft(swiper, _timeLeft, percentage) {
                const activeItem = paginationItems[swiper.realIndex]
                if (!activeItem) return

                activeItem.style.setProperty('--progress', `${percentage * 100}%`)
            },
        },
    })

    const ro = new ResizeObserver(() => {
        updateOverflowClass()
        updateTrackTransform(slider.realIndex)
    })
    ro.observe(paginationEl)
    ro.observe(trackEl)

    paginationItems.forEach((item) => {
        item.addEventListener('click', () => {
            slider.slideToLoop(Number(item.dataset.slideIndex))
        })
    })
}
