<nav class="page-trail">
    @foreach($items as $item)
        @if(isset($item['route']) && Route::has($item['route']))
            <a href="{{ route($item['route']) }}" class="page-trail-link">
                @if(!empty($item['icon']))
                    <i class="{{ $item['icon'] }}"></i>
                @endif
                {{ $item['label'] }}
            </a>
        @else
            <span class="page-trail-current">{{ $item['label'] }}</span>
        @endif

        @if(!$loop->last)
            <i class="bi bi-chevron-right page-trail-separator"></i>
        @endif
    @endforeach
</nav>