<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($items as $item)
            <li class="breadcrumb-item">
                @if($loop->last)
                    {{ $item['name'] }}
                @else
                    <a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
                @endif
            </li>

            @unless($loop->last)
                <x-svg.breadcrumb-divider />
            @endunless
        @endforeach
    </ol>
</nav>