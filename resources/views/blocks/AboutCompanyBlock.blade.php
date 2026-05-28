    <section class="about">
      <div class="container mx-auto">
        <div class="about__grid" data-card-reveal-group>
        @if($metaItem['blocks'])
            @foreach ($metaItem['blocks'] as $item)
                @if($item['number'] == true)
                    <div class="about__item" data-card-reveal-item data-card-reveal-delay="0.{{ $loop->index+1 }}">
                        <h4 class="about__item-title">
                        <span class="sr-only">{{ $item['prefix'] ? $item['prefix'] : '' }} {{ $item['title'] }}</span>
                        <span class="digit-roll" data-digit-roll data-value="{{ $item['title'] }}" aria-hidden="true">
                            @if ($item['prefix'])
                                <span class="digit-roll__prefix">{{ $item['prefix'] }}</span>                              
                            @endif
                                <span class="digit-roll__value" data-digit-roll-value>0</span>
                        </span>
                        </h4>
                        <p class="about__item-description" data-line-reveal> {{ $item['text'] }} </p>
                    </div>
                @else
                    <div class="about__item" data-card-reveal-item data-card-reveal-delay="0.{{ $loop->index+1 }}">
                        <h4 class="about__item-title {{ isset($item['little']) && $item['little'] ? 'about__item-title--small' : '' }}">{{ $item['title'] }}</h4>
                        <p class="about__item-description" data-line-reveal>{{ $item['text'] }}</p>
                    </div>
                    
                @endif
            @endforeach
        @endif
 
          <div class="about__item-main" data-card-reveal-item>
            <img class="about__item-main-bg" src="{{ $metaItem['image_id']['url'] }}" alt="About bg" />
            <div class="about__item-main-content">
              <h3 class="about__item-main-title">{{ $metaItem['title'] }}</h3>
              <div class="about__item-main-description" data-line-reveal> {!! $metaItem['pod_title'] !!} </div>
              <a href="/about" class="btn btn--secondary  btn--md about__item-main-btn">
                <div class="btn__label"> подробнее </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>