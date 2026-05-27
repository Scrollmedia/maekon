import { initArticleSlider } from './sliders/article'
import { initDirectionSlider } from './sliders/direction'
import { initHeroSlider } from './sliders/hero'
import { initVerticalPaginatedSlider } from './sliders/vertical-paginated'
import { initPartnerSlider } from './sliders/partner'
import { initSliderCenter } from './sliders/slider-center'
import { initSliderInfo } from './sliders/slider-info'
import { initGalleryVideoSlider } from './sliders/gallery-video'
import { initArticleDetailSlider } from './sliders/article-detail'

import { initThemeSwitcher } from './common/theme-switcher'
import { initLangSwitcher } from './common/lang-switcher'
import { initAccordion } from './common/accordion'
import { initHeaderNav } from './common/header-nav'
import { initOverflowFade } from './common/overflow-fade'
import { initHeadingReveal } from './common/heading-reveal'
import { initTextLineReveal } from './common/text-line-reveal'
import { initDigitRoll } from './common/digit-roll'
import { initDirectionCardCursor } from './common/direction-card-cursor'
import { initCardReveal } from './common/card-reveal'
import { initSmoothScroll } from './common/smooth-scroll'
import { initHeaderEnter } from './common/header-enter'
import { initHeaderScrollHide } from './common/header-scroll-hide'
import { initArticleDetailShare } from './common/article-detail-share'

const sliderOptions = {
    speed: 600,
}

initSmoothScroll()
initHeaderEnter()
initHeaderScrollHide()
initArticleDetailShare()

initArticleSlider(sliderOptions)
initDirectionSlider(sliderOptions)
initHeroSlider(sliderOptions)
initVerticalPaginatedSlider(sliderOptions)
initPartnerSlider(sliderOptions)
initSliderCenter(sliderOptions)
initSliderInfo(sliderOptions)
initGalleryVideoSlider(sliderOptions)
initArticleDetailSlider(sliderOptions)
initThemeSwitcher()
initLangSwitcher()
initAccordion()
initHeaderNav()
initOverflowFade()
initHeadingReveal()
initTextLineReveal()
initDigitRoll()
initDirectionCardCursor()
initCardReveal()
