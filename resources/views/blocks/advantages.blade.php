    <section class="advantages">
      <div class="advantages__container container mx-auto">
        <div class="advantages__header">
          <h4 class="advantages__header-title"> {{ $metaItem['title'] }} </h4>
          <div class="advantages__header-description" data-line-reveal> {!! $metaItem['content'] !!}</div>
        </div>
        <div class="advantages__block">
          <h3 class="advantages__block-title">{{ $metaItem['title2'] }}</h3>
          <div class="advantages__grid" data-card-reveal-group>
            @foreach ($metaItem['blocks'] as $item)
                <div class="advantages__item" data-card-reveal-item data-card-reveal-delay="0.{{ $loop->index+1 }}">
                    @if($item['number'])
                     <h4 class="advantages__item-title advantages__item-title--lg">
                        <span class="sr-only">{{ isset($item['prefix']) ? $item['prefix'] : '' }} {{ $item['title'] }}</span>
                        <span class="digit-roll" data-digit-roll data-value="{{ $item['title'] }}" aria-hidden="true">
                        @if($item['prefix'])
                        <span class="digit-roll__prefix">{{ $item['prefix'] }}</span>
                        @endif
                        <span class="digit-roll__value" data-digit-roll-value>0</span>
                        </span>
                    </h4>
                    @else

                    <h4 class="advantages__item-title">{{ $item['title'] }}</h4>
                    @endif
                    @if($item['file'])
                    <button class="btn btn--tertiary  btn--sm advantages__item-btn">
                        <svg class="btn__icon" aria-hidden="true">
                        <use href="../icons/sprite.svg?v=#doc-list"></use>
                        </svg>
                        <div class="btn__label"> Смотреть сертификат </div>
                    </button>
                    @endif
                    @if($item['text'])
                        <div class="advantages__item-description" data-line-reveal> {!! $item['text'] !!} </div>
                    @endif
                </div>
            @endforeach
 
  
          </div>
        </div>
      </div>
    </section>