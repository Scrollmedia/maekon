          <div class="specs-info__block specs-info__container container mx-auto">
            <div class="section-header section-header--with-description">
              <h4 class="section-title">{{ $metaItem['title'] }} </h4>
            </div>
            
            <div class="tech-specs" data-card-reveal-group>
                 @if(!empty($metaItem['table_headers']))
                  <div class="tech-specs__row tech-specs__row--th" data-card-reveal-item> 
                    @foreach($metaItem['table_headers'] as $header)
                    <div class="tech-specs__th">
                        {{ $header['col_title'] ?? '' }}
                    </div>
                    @endforeach
                 </div>
                @endif
 
                 @if(!empty($metaItem['table_rows']) && !empty($metaItem['table_headers']))
                    @foreach($metaItem['table_rows'] as $row)
                        <div class="tech-specs__row" data-card-reveal-item>
                            
                            @foreach($metaItem['table_headers'] as $key => $header)
                                <div class="tech-specs__td">
                                    <div class="tech-specs__td-title">
                                        {{ $header['col_title'] ?? '' }}
                                    </div>
                                    
                                    <p class="tech-specs__td-value">
                                        {{ $row['cell_' . $loop->index] ?? '—' }}
                                    </p>
                                </div>
                            @endforeach
                            
                        </div>
                    @endforeach
                @endif
                
            </div>
          </div>
