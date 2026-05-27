        <div class="container  mx-auto"> 
            <div class="vacancies__message " data-card-reveal-item>
            <div class="vacancies__message-icon">
                <svg class="vacancies__message-icon-svg" aria-hidden="true">
                <use href="../icons/sprite.svg?v=1.0.0#exclamation"></use>
                </svg>
            </div>
            <div class="vacancies__message-content">
                <div class="vacancies__message-title">{{ $metaItem['title'] }}</div>
                {!!  $metaItem['content'] !!}
            </div>
            </div>
        </div>