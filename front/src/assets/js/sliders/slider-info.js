import Swiper from 'swiper'
import { Navigation } from 'swiper/modules'

export function initSliderInfo() {
    const sliderEl = document.querySelector('.slider-info__slider')

    if (!sliderEl) return

    const sectionEl = sliderEl.closest('.slider-info')
    const currentEl = sectionEl?.querySelector('.slider-counter__current')
    const totalEl = sectionEl?.querySelector('.slider-counter__total')
    const navButtons = sectionEl?.querySelectorAll('.slider-btn')
    const prevButtonEl = navButtons?.[0]
    const nextButtonEl = navButtons?.[1]
    const slidesCount = sliderEl.querySelectorAll('.swiper-slide').length

    if (totalEl) totalEl.textContent = String(slidesCount)

    const slider = new Swiper(sliderEl, {
        modules: [Navigation],
        slidesPerView: 1,
        spaceBetween: 20,
        speed: 600,
        navigation: {
            prevEl: prevButtonEl,
            nextEl: nextButtonEl,
        },
    })

    const updateCounter = () => {
        if (!currentEl) return

        currentEl.textContent = String(slider.realIndex + 1)
    }

    updateCounter()
    slider.on('slideChange', updateCounter)
}
