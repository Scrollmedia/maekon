import Swiper from 'swiper'
import { Navigation } from 'swiper/modules'

export function initArticleSlider(options = {}) {
    const articleSwiper = document.querySelector('.article__slider')

    if (!articleSwiper) return

    const sectionEl = articleSwiper.closest('.article')
    const currentEl = sectionEl?.querySelector('.article__slider-counter .slider-counter__current')
    const totalEl = sectionEl?.querySelector('.article__slider-counter .slider-counter__total')
    const slidesCount = articleSwiper.querySelectorAll('.swiper-slide').length

    if (totalEl) totalEl.textContent = String(slidesCount)

    const slider = new Swiper(articleSwiper, {
        modules: [Navigation],
        slidesPerView: 1,
        spaceBetween: 12,
        loop: true,
        speed: options.speed ?? 600,
        navigation: {
            nextEl: '.article__slider-next',
            prevEl: '.article__slider-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 'auto',
                spaceBetween: 16,
            },
            1280: {
                slidesPerView: 'auto',
                spaceBetween: 20,
            },
            1868: {
                slidesPerView: 3,
            },
        },
    })

    const updateCounter = () => {
        if (!currentEl) return
        currentEl.textContent = String(slider.realIndex + 1)
    }

    updateCounter()
    slider.on('slideChange', updateCounter)
}
