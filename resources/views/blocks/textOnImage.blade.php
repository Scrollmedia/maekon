    <section class="about-page__address" data-card-reveal-group>
      <div class="about-page__address-container container mx-auto">
        <div class="slider-center-card" data-card-reveal-item>
          <img class="slider-center-card__bg" src="{{ $metaItem['image_id']['url'] }}" alt="{{ $metaItem['title'] }}" />
          <div class="slider-center-card__content">
            <h5 class="slider-center-card__title">{{ $metaItem['title'] }}</h5>
            <p class="slider-center-card__description" data-line-reveal>{!! $metaItem['content'] !!}</p>
          </div>
        </div>
      </div>
    </section>