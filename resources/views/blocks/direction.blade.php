    @if($metaItem['items'])
    <section class="direction">
      <div class="direction__container container mx-auto">
        <div class="direction__header section-header">
          <h3 class="section-title">{{ $metaItem['title'] }}</h3>
          <div class="slider-counter direction__slider-counter">
            <span class="slider-counter__current">1</span>
            <span class="slider-counter__divider">/ </span>
            <span class="slider-counter__total">{{ count($metaItem['items']) }}</span>
          </div>
        </div>
        <div class="direction__block">
          <div class="swiper direction__slider" data-card-reveal-group>
            <div class="swiper-wrapper">
              @foreach ($metaItem['items'] as $item)
              <div class="swiper-slide">
                <a href="{{ $item['slug'] }}" class="direction-card" data-card-reveal-item>
                  <img class="direction-card__bg" src="{{ $item['preview']['url'] }}" alt="{{ $item['title'] }}">
                  <div class="direction-card__content">
                    <h4 class="direction-card__title">{{ $item['title'] }}</h4>
                    <div class="direction-card__description" data-line-reveal>{!! $item['excerpt'] !!}</div>
                  </div>
                </a>
              </div>
                
              @endforeach
            </div>
          </div>
          <button type="button" class="direction__slider-btn-next">
            <svg class="direction__slider-btn-next-icon" aria-hidden="true">
              <use href="../icons/sprite.svg?v=1.0.0#chevron-left"></use>
            </svg>
          </button>
        </div>
      </div>
    </section>
  @endif