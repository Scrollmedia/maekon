 
@if(!empty($blocks))
    @foreach ($blocks as $item)
 
        @if($item['type'])
                @if($model_type == "App\Models\Post" && $item['type']=='banner')
                    @includeIf('blocks.' . $item['type'], ['metaItem' => $item['data']])
                    @includeIf('blocks.news_solo', ['metaItem' => $item['data']])
                @else
                    @includeIf('blocks.' . $item['type'], ['metaItem' => $item['data']])
                @endif
        @endif
    @endforeach
    
    @if($model_type == "App\Models\Post")
                </div>
        </div>
    @endif
@endif