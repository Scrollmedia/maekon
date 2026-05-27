    <section>
      <div class="container mx-auto">
        <div class="section-list" data-card-reveal-group>
         @foreach($metaItem['items'] as $item)
          <a href="{{ $item['slug'] }}" class="direction-card" data-card-reveal-item>
            <img class="direction-card__bg" src="{{ $item['preview']['url'] }}" alt="{{ $item['title'] }}">
            <div class="direction-card__content">
              <h4 class="direction-card__title">{{ $item['title'] }}</h4>
              <div  class="direction-card__description" data-line-reveal>{!! $item['excerpt'] !!}</div>
            </div>
          </a>
          @endforeach
        </div>
      </div>
    </section>
