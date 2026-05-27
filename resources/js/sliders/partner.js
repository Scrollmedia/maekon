import Swiper from 'swiper'
import { Navigation, Autoplay } from 'swiper/modules'

export function initPartnerSlider(options = {}) {
    const partnerSwiper = document.querySelector('.partner__slider')

    if (!partnerSwiper) return

    const sectionEl = partnerSwiper.closest('.partner')
    const currentEl = sectionEl?.querySelector('.partner__slider-counter .slider-counter__current')
    const totalEl = sectionEl?.querySelector('.partner__slider-counter .slider-counter__total')
    const slidesCount = partnerSwiper.querySelectorAll('.swiper-slide').length

    if (totalEl) totalEl.textContent = String(slidesCount)

    const slider = new Swiper(partnerSwiper, {
        modules: [Navigation, Autoplay],
        slidesPerView: 2,
        spaceBetween: 12,
        loop: true,
        autoplay: {
            delay: 5000,
            pauseOnMouseEnter: true,
        },
        speed: options.speed ?? 600,
        navigation: {
            nextEl: '.partner__slider-next',
            prevEl: '.partner__slider-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 4,
                spaceBetween: 16,
            },
            1280: {
                slidesPerView: 4,
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
