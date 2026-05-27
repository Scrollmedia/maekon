    <section class="hero-static">
      <img class="hero-static__bg" src="{{ $metaItem['image_id']['url'] ?? '../default.webp' }}" alt="о компании">
      <div class="hero-static__container container mx-auto">
        @if(!empty($breadcrumbs))
            <ul class="breadcrumbs">
                @foreach($breadcrumbs as $crumb)
                    @if($crumb['url'])
                            <a class="breadcrumbs__item" href="{{ $crumb['url'] }}">
                                {{ $crumb['label'] }}
                            </a>
                    @else
                            <span class="breadcrumbs__item">
                                {{ $crumb['label'] }}
                            </span>
                    @endif
                @endforeach
            </ul>
        @endif
        <h1 class="hero-static__title">{{ $metaItem['title'] ?? $page->title }}</h1>
      </div>
    </section>