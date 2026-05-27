import Swiper from 'swiper'
import { Navigation } from 'swiper/modules'

export function initDirectionSlider(options = {}) {
    const sliderEl = document.querySelector('.direction__slider')

    if (!sliderEl) return

    const sectionEl = sliderEl.closest('.direction')
    const currentEl = sectionEl?.querySelector('.direction__slider-counter .slider-counter__current')
    const totalEl = sectionEl?.querySelector('.direction__slider-counter .slider-counter__total')
    const slidesCount = sliderEl.querySelectorAll('.swiper-slide').length

    if (totalEl) totalEl.textContent = String(slidesCount)

    const slider = new Swiper(sliderEl, {
        modules: [Navigation],
        slidesPerView: 1,
        spaceBetween: 10,
        speed: options.speed ?? 600,
        navigation: {
            nextEl: '.direction__slider-btn-next',
        },
        breakpoints: {
            768: {
                spaceBetween: 20,
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
