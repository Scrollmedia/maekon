          <div class="specs-info__block">
            <div class="section-header section-header--with-description">
              <h4 class="section-title">{{ $metaItem['title'] }}</h4>
              <div class="section-description" data-line-reveal> {!! $metaItem['pod_title'] !!}</div>
            </div>
            <div class="specification-list" data-card-reveal-group>
               
                @foreach ($metaItem['blocks'] as $block)
                <div data-card-reveal-item data-card-reveal-delay="0.{{ $loop->index + 1 }}">
                    <div class="specification-card">

                      
                    @if($block['number'] == true)
                    <h4 class="specification-card__title">
                        <span class="sr-only">{{ $block['prefix'] ? $block['prefix'] : '' }} {{ $block['title'] }}</span>
                            <span class="digit-roll" data-digit-roll data-value="{{ $block['title'] }}" aria-hidden="true">
                                @if ($block['prefix'])
                                    <span class="digit-roll__prefix">{{ $block['prefix'] }}</span>                              
                                @endif
                                    <span class="digit-roll__value" data-digit-roll-value>0</span>
                            </span>
                        </span>
                    </h4>
                    @else

                    @endif
                    <div class="specification-card__description" data-line-reveal>{!! $block['text'] !!}</div>
                    </div>
                </div>
                @endforeach
 
            </div>
          </div>