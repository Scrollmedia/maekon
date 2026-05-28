@if ($paginator->hasPages())
        <div class="pagination">
 

                   <div class="pagination__list">
                        @php
                        $lastPageShown = false;
                        $hasDots = false;
                    @endphp
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                        <span class="pagination__item pagination__item--dots">...</span>
                        @php $hasDots = true; @endphp
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                            @if ($page == $paginator->lastPage())
                                @php $lastPageShown = true; @endphp
                            @endif
                                @if ($page == $paginator->currentPage())
                                <a class="pagination__item active" href="#">{{ $page }}</a>
                                @else
                                {{-- Добавляем адаптивный класс max-md:hidden для страниц дальше второй --}}
                                <a class="pagination__item {{ $page > 2 && $page < $paginator->lastPage() - 1 ? 'max-md:hidden' : '' }}" href="{{ $url }}">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if (!$lastPageShown)
                        @if (!$hasDots && $paginator->currentPage() < $paginator->lastPage() - 1)
                            <span class="pagination__item pagination__item--dots">...</span>
                        @endif
                        
                        <a class="pagination__item" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
                    @endif
                </div>


                    <div class="pagination__actions">
                        @if ($paginator->onFirstPage())
                            <a href="#" class="pagination__actions-btn pagination__actions-btn--prev">
                                <svg class="pagination__actions-btn-icon" aria-hidden="true">
                                    <use href="../icons/sprite.svg?v=#chevron-left"></use>
                                </svg>
                            </a>
                        @else
                            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"  class="pagination__actions-btn pagination__actions-btn--prev">
                                <svg class="pagination__actions-btn-icon" aria-hidden="true">
                                    <use href="../icons/sprite.svg?v=#chevron-left"></use>
                                </svg>
                            </a>
                        @endif
                         @if ($paginator->hasMorePages())
                            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination__actions-btn pagination__actions-btn--next">
                                <svg class="pagination__actions-btn-icon" aria-hidden="true">
                                    <use href="../icons/sprite.svg?v=#chevron-left"></use>
                                </svg>
                            </a>
                        @else
                        <a href="#" class="pagination__actions-btn pagination__actions-btn--next">
                            <svg class="pagination__actions-btn-icon" aria-hidden="true">
                                <use href="../icons/sprite.svg?v=#chevron-left"></use>
                            </svg>
                        </a>
                        @endif
                    </div>

 
 
    </div>
@endif
