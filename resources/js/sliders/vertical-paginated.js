import Swiper from 'swiper'

export function initVerticalPaginatedSlider(options = {}) {
    const sliderEls = document.querySelectorAll('.vertical-paginated-slider')

    sliderEls.forEach((sliderEl) => {
        if (!sliderEl) return

        const paginationEl = document.querySelector(`[data-pagination="${sliderEl.dataset.slider}"]`)
        if (!paginationEl) return

        paginationEl.textContent = ''

        const slides = Array.from(sliderEl.querySelectorAll('.swiper-slide'))

        const paginationItems = slides.map((slide, index) => {
            const item = document.createElement('button')
            item.type = 'button'
            item.className = 'vertical-paginated-pagination__item'
            item.setAttribute('data-card-reveal-item', '')
            item.textContent = slide.dataset.name || `Слайд ${index + 1}`
            item.dataset.slideIndex = String(index)
            paginationEl.appendChild(item)
            return item
        })

        const slider = new Swiper(sliderEl, {
            direction: 'vertical',
            slidesPerView: 1,
            spaceBetween: 0,
            speed: options.speed ?? 600,
            allowTouchMove: false,
            simulateTouch: false,
            on: {
                init(swiper) {
                    for (const node of [
                        swiper.el,
                        swiper.wrapperEl,
                        ...Array.from(swiper.slides),
                    ]) {
                        node?.style.setProperty('touch-action', 'pan-y')
                    }
                },
            },
        })

        const setActiveItem = (activeIndex) => {
            paginationItems.forEach((item, index) => {
                item.classList.toggle('active', index === activeIndex)
            })
        }

        paginationItems.forEach((item) => {
            item.addEventListener('click', () => {
                slider.slideTo(Number(item.dataset.slideIndex))
            })
        })

        setActiveItem(slider.activeIndex)

        slider.on('slideChange', () => {
            setActiveItem(slider.activeIndex)
        })
    })
}
