import Swiper from 'swiper'
import { Navigation, EffectCoverflow } from 'swiper/modules'

export function initSliderCenter(options = {}) {
    const sliderEl = document.querySelector('.slider-center__slider')

    if (!sliderEl) return

    const sectionEl = sliderEl.closest('.slider-center')
    const currentEl = sectionEl?.querySelector('.slider-counter__current')
    const totalEl = sectionEl?.querySelector('.slider-counter__total')
    const slidesCount = sliderEl.querySelectorAll('.swiper-slide').length

    if (totalEl) totalEl.textContent = String(slidesCount)

    new Swiper(sliderEl, {
        effect: 'coverflow',
        modules: [Navigation, EffectCoverflow],
        loop: true,
        slidesPerView: 'auto',
        spaceBetween: 12,
        centeredSlides: true,
        speed: options.speed ?? 600,
        on: {
            init(swiper) {
                if (currentEl) currentEl.textContent = String(swiper.realIndex + 1)
            },
            slideChange(swiper) {
                if (currentEl) currentEl.textContent = String(swiper.realIndex + 1)
            },
        },
        breakpoints: {
            768: {
                spaceBetween: 16,
            },
            1280: {
                spaceBetween: 20,
            },
        },
        coverflowEffect: {
            scale: 0.875,
            rotate: 0,
            stretch: 0,
            depth: 154,
            modifier: 1,
            slideShadows: false,
        },
        navigation: {
            nextEl: '.slider-center__slider-btn-next',
            prevEl: '.slider-center__slider-btn-prev',
        },
    })
}
