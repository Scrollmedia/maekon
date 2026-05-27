 
@if(!empty($blocks))
    @foreach ($blocks as $item)
 
        @if($item['type'])
                @includeIf('blocks.' . $item['type'], ['metaItem' => $item['data']])
        @endif
    @endforeach
@endif