          <div class="specs-info__block specs-info__container container mx-auto">
            <div class="section-header section-header--with-description">
              <h4 class="section-title">{!! $metaItem['title'] !!}</h4>
              <div class="section-description" data-line-reveal> {!! $metaItem['content'] !!} </div>
            </div>
              @if($metaItem['href'])
                <iframe class="specs-info__video" src="{{ $metaItem['href'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
              @else 
                    <video src="{{ $metaItem['file']['url'] }}" class="specs-info__video">

                    </video>
                @endif  
        </div>