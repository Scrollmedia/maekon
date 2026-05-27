    <section class="vacancies" data-card-reveal-group>
      <div class="vacancies__container container mx-auto">
        <div class="vacancies__header">
          <h2 class="vacancies__title">{{ $metaItem['title'] }}</h2>
          <div class="vacancies__description"> {!! $metaItem['content'] !!} </div>
        </div>
        <div class="vacancies__list">
          @foreach ($metaItem['blocks'] as $item)
                <div class="accordion" data-card-reveal-item>
                    <div class="accordion__header">
                    <div class="accordion__title">{{ $item['title'] }}</div>
                    <button class="accordion__toggle">
                        <svg class="accordion__toggle-icon" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect class="accordion__toggle-icon-hidding" x="18" width="6" height="6" rx="3" />
                        <rect x="18" y="18" width="6" height="6" rx="3" />
                        <rect class="accordion__toggle-icon-hidding" x="18" y="36" width="6" height="6" rx="3" />
                        <rect x="42" y="18" width="6" height="6" rx="3" transform="rotate(90 42 18)" />
                        <rect x="24" y="18" width="6" height="6" rx="3" transform="rotate(90 24 18)" />
                        <rect x="6" y="18" width="6" height="6" rx="3" transform="rotate(90 6 18)" />
                        </svg>
                    </button>
                    </div>
                    <div class="accordion__content">
                    <div class="accordion__content-inner">
                        <div class="vacancies__accordion-content">
                        <div class="vacancies__accordion-grid">
                            @foreach ($item['ul'] as $ul)
                                <div class="vacancies__accordion-block">
                                    <div class="vacancies__accordion-title">{{ $ul['title'] }}</div>
                                    <ul class="vacancies__accordion-list">
                                        @foreach ($ul['li'] as $li)
                                        <li class="vacancies__accordion-list-item"> {!!   $li['title'] !!} </li>
                                            
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                        <button class="btn btn--primary  btn--md vacancies__accordion-btn">
                            <div class="btn__label"> отправить резюме </div>
                        </button>
                        </div>
                    </div>
                    </div>
                </div>
          @endforeach
 
        </div>
 
      </div>
    </section>