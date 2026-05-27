          <div class="specs-info__block specs-info__container container mx-auto">
            <div class="section-header section-header--with-description">
              <h4 class="section-title">галерея Видео </h4>
              <div class="section-header__actions">
                <div class="slider-counter gallery-video-slider__counter">
                  <span class="slider-counter__current">1</span>
                  <span class="slider-counter__divider">/ </span>
                  <span class="slider-counter__total">{{ count($metaItem['blocks']) }}</span>
                </div>
                <div class="slider-btn-list">
                  <button type="button" class="slider-btn gallery-video-slider__prev">
                    <svg class="slider-btn__icon" aria-hidden="true">
                      <use href="../icons/sprite.svg?v=#chevron-left"></use>
                    </svg>
                  </button>
                  <button type="button" class="slider-btn gallery-video-slider__next">
                    <svg class="slider-btn__icon" aria-hidden="true">
                      <use href="../icons/sprite.svg?v=#chevron-left"></use>
                    </svg>
                  </button>
                </div>
              </div>
              <div class="slider-counter gallery-video-slider__counter">
                <span class="slider-counter__current">1</span>
                <span class="slider-counter__divider">/ </span>
                <span class="slider-counter__total">{{ count($metaItem['blocks']) }}</span>
              </div>
            </div>
            <div class="swiper gallery-video-slider" data-card-reveal-group>
              <div class="swiper-wrapper">
                @foreach ($metaItem['blocks'] as $block)
                    <div class="swiper-slide" data-card-reveal-item>
                        <div class="gallery-video-card">
                            <div class="gallery-video-card__media">
                            @if($block['href'])
                            <iframe class="gallery-video-card__video" src="{{ $block['href'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            @else 
                                <video src="{{ $metaItem['file']['url'] }}" class="gallery-video-card__video">

                                </video>
                            @endif
                            <div class="gallery-video-card__edge gallery-video-card__edge--left" aria-hidden="true"></div>
                            <div class="gallery-video-card__edge gallery-video-card__edge--right" aria-hidden="true"></div>
                            </div>
                            <div class="gallery-video-card__content">
                            <h6 class="gallery-video-card__title">{{ $block['title'] }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
                 
 
              </div>
            </div>
          </div>