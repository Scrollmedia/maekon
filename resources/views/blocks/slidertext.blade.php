    <section class="text-slider">
      <div class="text-slider__container container mx-auto">
        <div class="card-text text-slider__text-top">
          <h4 class="card-text__title">{{ $metaItem['title'] }}</h4>
          <div class="card-text__description" data-line-reveal>{!! $metaItem['content'] !!}</div>
        </div>
      </div>
      <div class="slider-center">
        <div class="slider-counter slider-center__slider-counter">
          <span class="slider-counter__current">1</span>
          <span class="slider-counter__divider">/ </span>
          <span class="slider-counter__total">{{ count($metaItem['slider']) }}</span>
        </div>
        <button type="button" class="slider-center__slider-btn-prev slider-btn slider-btn--lg">
          <svg class="slider-center__slider-btn-prev-icon slider-btn__icon" aria-hidden="true">
            <use href="../icons/sprite.svg?v=1.0.0#chevron-left"></use>
          </svg>
        </button>
        <button type="button" class="slider-center__slider-btn-next slider-btn slider-btn--lg">
          <svg class="slider-center__slider-btn-next-icon slider-btn__icon" aria-hidden="true">
            <use href="../icons/sprite.svg?v=1.0.0#chevron-left"></use>
          </svg>
        </button>
        <div class="swiper slider-center__slider" data-card-reveal-group>
          <div class="swiper-wrapper">
            @foreach ($metaItem['slider'] as $slide)
                <div class="swiper-slide">
                    <div class="slider-center-card" data-card-reveal-item>
                        <img class="slider-center-card__bg" src="{{ $slide['image_id']['url'] }}" alt="{{ $slide['title'] }}" />
                        <div class="slider-center-card__content">
                        <h5 class="slider-center-card__title">{{ $slide['title'] }}</h5>
                        <p class="slider-center-card__description" data-line-reveal>{{ $slide['pod_title'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
 
          </div>
        </div>
      </div>
      <div class="text-slider__container container mx-auto">
        <div class="card-text text-slider__text-bottom">
          <h4 class="card-text__title">{{ $metaItem['title2'] }}</h4>
          <div class="card-text__description">
            {!! $metaItem['content2'] !!}
          </div>
 
        </div>
      </div>
    </section>