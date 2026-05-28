<div class="article-detail__slider-wrapper">
              <div class="article-detail__slider-actions">
                <div class="slider-counter slider-counter--custom-adaptive article-detail__slider-counter">
                  <span class="slider-counter__current">1</span>
                  <span class="slider-counter__divider">/ </span>
                  <span class="slider-counter__total">{{ count($metaItem['slider']) }}</span>
                </div>
                <div class="slider-btn-list">
                  <button type="button" class="slider-btn slider-btn--md-custom article-detail__slider-prev">
                    <svg class="slider-btn__icon" aria-hidden="true">
                      <use href="../icons/sprite.svg?v=#chevron-left"></use>
                    </svg>
                  </button>
                  <button type="button" class="slider-btn slider-btn--md-custom article-detail__slider-next">
                    <svg class="slider-btn__icon" aria-hidden="true">
                      <use href="../icons/sprite.svg?v=#chevron-left"></use>
                    </svg>
                  </button>
                </div>
              </div>
              <div class="swiper article-detail__slider">
                <div class="swiper-wrapper">
                    @foreach ($metaItem['slider'] as $slide)
                        <div class="swiper-slide">
                            <img src="{{ $slide['image_id']['url'] }}" alt="{{ $slide['image_id']['alt'] ?? 'slide' }}">
                        </div>
                    @endforeach
 
                </div>
              </div>
            </div>