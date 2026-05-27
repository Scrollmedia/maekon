import Swiper from 'swiper'
import { Navigation } from 'swiper/modules'

export function initArticleDetailSlider(options = {}) {
    const sliderWrappers = document.querySelectorAll('.article-detail__slider-wrapper')

    sliderWrappers.forEach((wrapperEl) => {
        const sliderEl = wrapperEl.querySelector('.article-detail__slider')
        if (!sliderEl) return

        const currentEl = wrapperEl.querySelector('.article-detail__slider-counter .slider-counter__current')
        const totalEl = wrapperEl.querySelector('.article-detail__slider-counter .slider-counter__total')
        const prevEl = wrapperEl.querySelector('.article-detail__slider-prev')
        const nextEl = wrapperEl.querySelector('.article-detail__slider-next')
        const slidesCount = sliderEl.querySelectorAll('.swiper-slide').length

        if (totalEl) totalEl.textContent = String(slidesCount)

        const slider = new Swiper(sliderEl, {
            modules: [Navigation],
            slidesPerView: 1,
            spaceBetween: 0,
            speed: options.speed ?? 600,
            loop: true,
            navigation: {
                prevEl,
                nextEl,
            },
        })

        const updateCounter = () => {
            if (!currentEl) return

            currentEl.textContent = String(slider.realIndex + 1)
        }

        updateCounter()
        slider.on('slideChange', updateCounter)
    })
}
