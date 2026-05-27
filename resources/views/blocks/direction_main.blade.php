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
                    <div class="direction2-card__description"  data-line-reveal>
                        {!! $item['excerpt'] !!}
                    </div>
                    <p class="direction2-card__description" data-line-reveal>Универсальное промышленное оборудование периодического действия, предназначенное для термической обработки (закалки, отжига, нормализации) материалов, где нагрев осуществляется в закрытой камере.</p>
                    <p class="direction2-card__description-small" data-line-reveal>Ключевые особенности включают равномерное распределение температуры, трехсторонний обогрев, высокоэффективную изоляцию и использование микропроцессорных контроллеров для точного управления процессом.</p>
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