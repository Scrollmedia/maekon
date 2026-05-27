    <section class="hero">
      <div class="swiper hero__slider">
        <div class="swiper-wrapper">
        @if($metaItem['slider'])
            @foreach ($metaItem['slider'] as $item)
                  <div class="swiper-slide">
                    <div class="hero-card">
                    <img class="hero-card__bg" src="{{ $item['image_id']['url'] ?? '../default.webp' }}" alt="{{ $item['title'] }}">
                    <div class="hero-card__container container mx-auto">
                        <div class="hero-card__content">
                        <h4 class="hero-card__title">{{ $item['title'] }}</h4>
                        <p class="hero-card__description" data-line-reveal>{{ $item['pod_title'] }}</p>
                        </div>
                    </div>
                    </div>
                </div>
            @endforeach

        @endif
 
        </div>
      </div>
      <div class="hero__slider-actions container mx-auto">
        <div class="hero__slider-pagination"></div>
        <div class="slider-btn-list">
          <button type="button" class="slider-btn hero__slider-prev">
            <svg class="slider-btn__icon" aria-hidden="true">
              <use href="../icons/sprite.svg?v=#chevron-left"></use>
            </svg>
          </button>
          <button type="button" class="slider-btn hero__slider-next">
            <svg class="slider-btn__icon" aria-hidden="true">
              <use href="../icons/sprite.svg?v=#chevron-left"></use>
            </svg>
          </button>
        </div>
      </div>
    </section>