 @if($metaItem['items'])
    <section class="brand vertical-paginated-section">
      <div class="vertical-paginated-container container mx-auto" data-card-reveal-group>
        <div class="swiper vertical-paginated-slider" data-slider="brand" data-card-reveal-item>
          <div class="swiper-wrapper">
            @foreach ($metaItem['items'] as $item)
              <div class="swiper-slide" data-name="{{  $item['title'] }}">
                <div class="brand-card" data-card-reveal-item>
                  <img class="brand-card__bg" src="{{  $item['preview']['url'] }}" alt="{{  $item['title'] }}">
                  <div class="brand-card__content">
                    <h5 class="brand-card__title">{{  $item['title'] }}</h5>
                    <div class="brand-card__description" data-line-reveal>{!!  $item['excerpt'] !!} </div>
                  </div>
                </div>
              </div>
            @endforeach
            
          </div>
        </div>
        <div class="vertical-paginated-info" data-card-reveal-item>
          <h3 class="vertical-paginated-info__title"> {{ $metaItem['title'] ?? '' }} </h3>
          <p class="vertical-paginated-info__description" data-line-reveal> {{ $metaItem['pod_title'] ?? '' }} </p>
          <div class="vertical-paginated-pagination" data-pagination="brand">
          </div>
        </div>
      </div>
    </section>
 @endif