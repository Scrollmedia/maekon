    <section class="contacts" data-card-reveal-group>
      <div class="contacts__container container mx-auto">
        <div class="contacts__grid">
          <div class="contacts__item contacts__item--map-sm" data-card-reveal-item>
            <div id="map1" data-coords="{{ $metaItem['coords'] }}" class="yamap"></div>
          </div>
          @foreach ($metaItem['blocks'] as $block)
            <div class="contacts__item" data-card-reveal-item>
                @if($block['title'])
                <h4 class="contacts__item-title">{{ $block['title'] }}</h4>
                @endif
                <div class="contacts__item-content">
                    @foreach ($block['ul'] as $ul)
                    <div class="contacts__item-block">
                            <h5 class="contacts__item-block-title">{{ $ul['title'] }}</h5>
                            <div class="contacts__item-block-content">
                                @foreach ($ul['li'] as $li)
                                    @if($li['type'] == 'text')
                                        <p class="contacts__item-address" data-line-reveal>{!! $li['title'] !!}</p>
                                    @elseif($li['type'] == 'phone')
                                        <a href="tel:{!! $li['title'] !!}" class="contacts__item-link" data-line-reveal>{!! $li['title'] !!}</a>
                                    @else
                                        <a href="mailto:{!! $li['title'] !!}" class="contacts__item-link" data-line-reveal>{!! $li['title'] !!}</a>
                                    @endif
                                @endforeach

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
          @endforeach
 
          <div class="contacts__item contacts__item--map" data-card-reveal-item>
            <h4 class="contacts__item-title">{{ $metaItem['coordsTitle'] }}</h4>
            <div class="contacts__item-content">
              <div class="contacts__item-map">
                <div id="map2" data-coords="{{ $metaItem['coords2'] }}" class="yamap"></div>
              </div>
            </div>
          </div>
          <div class="contacts__item contacts__item--requisites" data-card-reveal-item>
            <div class="contacts__requisites-grid">
              <div class="contacts__requisites-block">
                <h5 class="contacts__requisites-title">{{ $metaItem['requizitTitle'] }}</h5>
                <a href="{{ $metaItem['file']['url'] }}" class="btn btn--primary  btn--sm" download="">
                  <svg class="btn__icon" aria-hidden="true">
                    <use href="../icons/sprite.svg?v=#doc-list"></use>
                  </svg>
                  <div class="btn__label"> Скачать </div>
                </a>
              </div>
              <div class="contacts__requisites-list">
                @foreach ($metaItem['requizitblocks'] as $requizit)
                    
                <div class="contacts__requisites-list-item">
                  <div class="contacts__requisites-list-item-property" data-line-reveal>{{ $requizit['title'] }} </div>
                  <p class="contacts__requisites-list-item-value" data-line-reveal>{{ $requizit['content'] }} </p>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <style>
        .yamap>ymaps>ymaps {
            border-radius: 20px
        }
        .yamap>ymaps>ymaps>ymaps {
            border-radius: 20px
        }
        .yamap ymaps:after,.yamap ymaps:before {
            border-radius: 20px
        }
    </style>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
<script type="text/javascript">
	ymaps.ready(function () {
    // 1. Находим все элементы карт на странице
    var mapElements = document.querySelectorAll('.yamap');

    mapElements.forEach(function (element) {
        var mapId = element.id;
        var coordsRaw = element.getAttribute('data-coords');
        var title = element.getAttribute('data-title') || "ООО Маекон";

        if (!coordsRaw) return;

        var mapCoords = coordsRaw.split(',').map(function(item) {
            return parseFloat(item.trim());
        });

        if (mapCoords.length !== 2 || isNaN(mapCoords[0]) || isNaN(mapCoords[1])) return;

        var myMap = new ymaps.Map(mapId, {
            center: mapCoords,
            zoom: 17,
            controls: ["zoomControl"]
        }, {
            suppressMapOpenBlock: true
        });

        var placemark = new ymaps.Placemark(mapCoords, {
            hintContent: title,
            balloonContent: title
        });

        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            myMap.behaviors.disable('drag');
        }
        myMap.geoObjects.add(placemark);
    });
});
</script>