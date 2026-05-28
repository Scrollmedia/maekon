    <section class="hero-static {{ $model_type == "App\Models\Post" ? ' hero-static--white' : '' }}">
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
        @if($model_type == "App\Models\Post")
            <div class="hero-static__date">
            <span class="hero-static__date-day">{{ date('d', strtotime($page->created_at)) }}</span>
            <span class="hero-static__date-month">{{ Str::after(\Carbon\Carbon::parse($page->created_at)->locale('ru')->isoFormat('D MMMM YYYY'), ' ') }}</span>
            </div>
        @endif
      </div>
    </section>