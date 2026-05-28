  <section class="article-detail">
      <div class="article-detail__container container mx-auto">
        <div class="article-detail__header">
          <a href="/{{ request()->segment(1, 'blog') }}" class="btn btn--secondary  btn--md article-detail__header-btn">
            <svg class="btn__icon" aria-hidden="true">
              <use href="../icons/sprite.svg?v=#chevron-left"></use>
            </svg>
            <div class="btn__label"> все новости </div>
        </a>
          <div class="article-detail__share">
            <button class="btn btn--primary  btn--md article-detail__share-btn article-detail__header-btn">
              <svg class="btn__icon btn__icon--right btn__icon--without-bg" aria-hidden="true">
                <use href="../icons/sprite.svg?v=#share"></use>
              </svg>
              <div class="btn__label"> поделиться </div>
            </button>
            <div class="article-detail__share-content">
              <a href="https://facebook.com/sharer.php?u={{ urlencode(request()->fullUrl()) }}" class="article-detail__share-link" target="_blank">
                <svg class="article-detail__share-icon" aria-hidden="true">
                  <use href="../icons/sprite.svg?v=1.0.0#facebook"></use>
                </svg>
              </a>
              <a href="#" onclick="navigator.clipboard.writeText(window.location.href); alert('Ссылка скопирована!'); return false;" class="article-detail__share-link" target="_blank">
                <svg class="article-detail__share-icon" aria-hidden="true">
                  <use href="../icons/sprite.svg?v=1.0.0#tiktok"></use>
                </svg>
              </a>
              <a href="#" onclick="navigator.clipboard.writeText(window.location.href); alert('Ссылка скопирована!'); return false;" class="article-detail__share-link" target="_blank" >
                <svg class="article-detail__share-icon" aria-hidden="true">
                  <use href="../icons/sprite.svg?v=1.0.0#instagram"></use>
                </svg>
              </a> 
              <a href="#" onclick="navigator.clipboard.writeText(window.location.href); alert('Ссылка скопирована!'); return false;" class="article-detail__share-link" target="_blank">
                <svg class="article-detail__share-icon" aria-hidden="true">
                  <use href="../icons/sprite.svg?v=1.0.0#you"></use>
                </svg>
              </a>
              <a href="https://t.me/share/url?url={{ urlencode(request()->fullUrl()) }}" class="article-detail__share-link" target="_blank">
                <svg class="article-detail__share-icon" aria-hidden="true">
                  <use href="../icons/sprite.svg?v=1.0.0#tg"></use>
                </svg>
              </a>
 
            </div>
          </div>
        </div>

        <div class="article-detail__content" style="gap:0px;display: block;">

  