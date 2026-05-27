   <section class="vacancies-info" data-card-reveal-group>
      <div class="vacancies-info__container container mx-auto">
        <div class="vacancies-info__card" data-card-reveal-item>
          <picture>
            <source media="(max-width: 768px)" srcset="{{ $metaItem['image_id']['url'] }}" type="image/jpg">
            <img src="{{ $metaItem['image_id']['url'] }}" alt="Vacancies Info" class="vacancies-info__card-bg" width="500" height="375">
          </picture>
          <div class="vacancies-info__card-content">
            <h4 class="vacancies-info__card-title"> {{ $metaItem['title'] }} </h4>
            <div class="vacancies-info__card-description" data-line-reveal>{!! $metaItem['content'] !!}</div>
            <a href="{{ $metaItem['href'] }}" class="btn btn--secondary  btn--md vacancies-info__card-btn">
              <div class="btn__label"> подробнее </div>
            </a>
          </div>
        </div>
      </div>
    </section>