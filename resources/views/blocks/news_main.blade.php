    <section class="article-page" data-card-reveal-group>
      <div class="article-page__container container mx-auto">
        @foreach ($metaItem['items'] as $item)
            @if ($loop->index == 1)
                @break
            @endif
            <article class="article-card article-card--row" data-card-reveal-item>
                <a class="article-card__link" href="{{ $item['slug'] }}"></a>
                <div class="article-card__date">{{ date('d.m.Y', strtotime($item['created_at'])) }}</div>
                <div class="article-card__image-wrapper">
                    <img class="article-card__image" src="{{  $item['preview']['url'] }}" alt="{{  $item['title'] }}">
                </div>
                <div class="article-card__content">
                    <h3 class="article-card__title">{{  $item['title'] }}</h3>
                    <div class="article-card__description" data-line-reveal>{!!  $item['excerpt'] !!} </div>
                </div>
            </article>    
 
        @endforeach
 
        <div class="article-page__list">
        @foreach ($metaItem['items'] as $item)
 
           @if ($loop->index == 0)
                @continue
            @endif
            <article class="article-card" data-card-reveal-item>
                <a class="article-card__link" href="{{ $item['slug'] }}"></a>
                <div class="article-card__date">{{ date('d.m.Y', strtotime($item['created_at'])) }}</div>
                <div class="article-card__image-wrapper">
                <img class="article-card__image" src="{{  $item['preview']['url'] }}" alt="{{  $item['title'] }}">
                </div>
                <div class="article-card__content">
                <h3 class="article-card__title">{{  $item['title'] }}</h3>
                <div class="article-card__description" data-line-reveal>{!!  $item['excerpt'] !!}</div>
                </div>
            </article>   
 
        @endforeach
        </div>
        {{ $metaItem['links']->links() }}
 
      </div>
    </section>