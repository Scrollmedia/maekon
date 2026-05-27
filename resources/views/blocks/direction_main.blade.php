    <section>
      <div class="container mx-auto">
        <div class="section-list" data-card-reveal-group>
        @foreach($metaItem['items'] as $item)
            <div class="direction2-card" data-card-reveal-item>
                <div class="direction2-card__image-wrapper">
                <img class="direction2-card__image" src="{{ $item['preview']['url'] }}" alt="{{ $item['title'] }}">
                </div>
                <div class="direction2-card__content">
                <div class="direction2-card__content-inner">
                    <h4 class="direction2-card__title">{{ $item['title'] }}</h4>
                    <div class="direction2-card__description-wrapper">
                        {!! $item['excerpt'] !!}
                    </div>
                </div>
                <a href="{{ $item['slug'] }}" class="btn btn--secondary  btn--md direction2-card__btn">
                    <div class="btn__label"> подробнее </div>
                </a>
                </div>
          </div>
        @endforeach
         
 
        </div>
      </div>
    </section>