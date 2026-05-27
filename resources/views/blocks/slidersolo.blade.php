   <div class="slider-info">
      <div class="slider-info__container container mx-auto">
        <div class="swiper slider-info__slider">
          <div class="swiper-wrapper">
            @foreach ($metaItem['slider'] as $slide)
            <div class="swiper-slide">
              <div class="slider-info-card" data-card-reveal-group>
                <div class="slider-info-card__image-wrapper" data-card-reveal-item>
                  <img class="slider-info-card__image" src="{{ $slide['image_id']['url'] }}" alt="Печь камерного типа" />
                </div>
                <div class="slider-info-card__content">
                  <h4 class="slider-info-card__title"> {!! $slide['title'] !!}
                  </h4>
                  <div class="slider-info-card__description" data-line-reveal>{!! $slide['pod_title'] !!} </div>
                  <div class="slider-info-card__description-sm" data-line-reveal> {!! $slide['pod_title2'] !!} </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        <div class="slider-info__actions">
          <div class="slider-counter slider-counter--custom-adaptive slider-info__slider-counter">
            <span class="slider-counter__current">1</span>
            <span class="slider-counter__divider">/ </span>
            <span class="slider-counter__total">{{ count($metaItem['slider']) }}</span>
          </div>
          <div class="slider-btn-list">
            <button type="button" class="slider-btn slider-btn--md-custom slider-info__slider-prev">
              <svg class="slider-btn__icon" aria-hidden="true">
                <use href="../icons/sprite.svg?v=#chevron-left"></use>
              </svg>
            </button>
            <button type="button" class="slider-btn slider-btn--md-custom slider-info__slider-next">
              <svg class="slider-btn__icon" aria-hidden="true">
                <use href="../icons/sprite.svg?v=#chevron-left"></use>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>