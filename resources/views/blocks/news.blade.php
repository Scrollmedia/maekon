     @if($metaItem['items'])
    <section class="article">
      <div class="article__container container mx-auto">
        <div class="section-header article__header">
          <h3 class="section-title">{{ $metaItem['title'] ?? '' }}</h3>
          <div class="section-header__actions">
            <a href="#" class="btn btn--secondary  btn--md section-header__btn-all">
              <div class="btn__label"> все новости </div>
            </a>
            <div class="slider-btn-list">
              <button type="button" class="slider-btn article__slider-prev">
                <svg class="slider-btn__icon" aria-hidden="true">
                  <use href="../icons/sprite.svg?v=#chevron-left"></use>
                </svg>
              </button>
              <button type="button" class="slider-btn article__slider-next">
                <svg class="slider-btn__icon" aria-hidden="true">
                  <use href="../icons/sprite.svg?v=#chevron-left"></use>
                </svg>
              </button>
            </div>
          </div>
          <div class="slider-counter article__slider-counter">
            <span class="slider-counter__current">1</span>
            <span class="slider-counter__divider">/ </span>
            <span class="slider-counter__total">{{ count($metaItem['items']) }}</span>
          </div>
        </div>
        <div class="swiper article__slider" data-card-reveal-group>
          <div class="swiper-wrapper">
              @foreach ($metaItem['items'] as $item)

            <div class="swiper-slide">
              <article class="article-card" data-card-reveal-item>
                <a class="article-card__link" href="#"></a>
                <div class="article-card__date">{{ date('d.m.Y', strtotime($item['created_at'])) }}</div>
                <div class="article-card__image-wrapper">
                  <img class="article-card__image" src="{{  $item['preview']['url'] }}" alt="{{  $item['title'] }}">
                </div>
                <div class="article-card__content">
                  <h3 class="article-card__title">{{  $item['title'] }}</h3>
                  <div class="article-card__description" data-line-reveal>{!!  $item['excerpt'] !!} </div>
                </div>
              </article>
            </div>
               @endforeach
 
          </div>
        </div>
        <div class="section-header__btn-all-wrapper">
          <a href="#" class="btn btn--secondary  btn--md section-header__btn-all">
            <div class="btn__label"> все новости </div>
          </a>
        </div>
      </div>
    </section>
    @endif