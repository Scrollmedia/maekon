    <section class="quality vertical-paginated-section">
      <div class="vertical-paginated-container container mx-auto" data-card-reveal-group>
        <div class="vertical-paginated-info" data-card-reveal-item>
          <h3 class="vertical-paginated-info__title">{!! $metaItem['title'] !!} </h3>
          <div class="vertical-paginated-pagination" data-pagination="quality">
          </div>
        </div>
        <div class="swiper vertical-paginated-slider" data-slider="quality" data-card-reveal-item>
          <div class="swiper-wrapper">
            @if ($metaItem['blocks'])
                @foreach ($metaItem['blocks'] as $item)
                    <div class="swiper-slide" data-name="{{ $item['title'] }}">
                        <div class="quality-card">
                            <img class="quality-card__bg" src="{{ $item['image_id']['url'] }}" alt="{{ $item['title'] }}">
                            <div class="quality-card__content">
                            <h5 class="quality-card__title">{{ $item['title'] }}</h5>
                            <div class="quality-card__description" data-line-reveal>{!! $item['text'] !!}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
 
          </div>
        </div>
      </div>
    </section>