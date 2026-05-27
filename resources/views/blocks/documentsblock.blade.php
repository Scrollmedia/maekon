          <div class="specs-info__block specs-info__container container mx-auto">
            <div class="section-header section-header--with-description">
              <h4 class="section-title">{!! $metaItem['title'] !!} </h4>
              <div class="section-description" data-line-reveal> {!! $metaItem['pod_title'] !!} </div>
            </div>
            <div class="doc-list" data-card-reveal-group>
            @foreach ($metaItem['blocks'] as $item)
                <div class="doc-card" data-card-reveal-item>
                    <div class="doc-card__icon-wrapper">
                    <svg class="doc-card__icon" aria-hidden="true">
                        <use href="../icons/sprite.svg?v=#doc"></use>
                    </svg>
                    </div>
                    <div class="doc-card__title">{{ $item['title'] ?? $item['file']['name'] }}</div>
                    <div class="doc-card__right">
                    <div class="doc-card__info">
                        <div class="doc-card__info-item">{{ $item['file']['extension'] }}</div>
                        <div class="doc-card__info-item">{{ $item['file']['size'] }}</div>
                    </div>
                    <a href="{{ $item['file']['url'] }}" class="doc-card__download" download="">
                        <svg class="doc-card__download-icon" aria-hidden="true">
                        <use href="../icons/sprite.svg?v=#chevron-down-line"></use>
                        </svg>
                    </a>
                    </div>
              </div>
            @endforeach
 
            </div>
          </div>