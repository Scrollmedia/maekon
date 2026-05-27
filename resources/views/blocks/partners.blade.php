@if($metaItem['visible'])   
    @if($globalSettings['partners'])
        <section class="partner">
        <div class="partner__container container mx-auto">
            <div class="section-header partner__header">
            <h3 class="section-title">партнеры</h3>
            <div class="section-header__actions">
                <a href="#" class="btn btn--secondary  btn--md section-header__btn-all">
                <div class="btn__label"> все партнеры </div>
                </a>
                <div class="slider-btn-list">
                <button type="button" class="slider-btn partner__slider-prev">
                    <svg class="slider-btn__icon" aria-hidden="true">
                    <use href="../icons/sprite.svg?v=#chevron-left"></use>
                    </svg>
                </button>
                <button type="button" class="slider-btn partner__slider-next">
                    <svg class="slider-btn__icon" aria-hidden="true">
                    <use href="../icons/sprite.svg?v=#chevron-left"></use>
                    </svg>
                </button>
                </div>
            </div>
            <div class="slider-counter partner__slider-counter">
                <span class="slider-counter__current">1</span>
                <span class="slider-counter__divider">/ </span>
                <span class="slider-counter__total">{{ count($globalSettings['partners']) }}</span>
            </div>
            </div>
            <div class="swiper partner__slider" data-card-reveal-group>
            <div class="swiper-wrapper">
                @foreach ($globalSettings['partners'] as $partner)
                <div class="swiper-slide" data-card-reveal-item data-card-reveal-delay="0.{{ $loop->index+1 }}">
                <a href="{{ $partner['url'] }}" class="partner-card">
                    <img class="partner-card__image" src="{{ $partner['image_id']['url'] }}" alt="Партнеры">
                </a>
                </div>
                    
                @endforeach
            </div>
            </div>
            <div class="section-header__btn-all-wrapper">
            <a href="#" class="btn btn--secondary  btn--md section-header__btn-all">
                <div class="btn__label"> все партнеры </div>
            </a>
            </div>
        </div>
        </section>
    @endif
@endif