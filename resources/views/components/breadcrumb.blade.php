<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="color: #696f89">
        @foreach($items as $item)
            <li class="breadcrumb-item" style="font-size: 0.9em">
                @if($loop->last)
                    {{ $item['name'] }}
                @else
                    <a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
                @endif
            </li>

            @unless($loop->last)
                <li class="d-flex align-items-center px-2" style="margin-top: 0.17rem">
                    <i class="fa-solid fa-angles-right" style="font-size: 0.6em"></i>
                </li>
            @endunless
        @endforeach
    </ol>
</nav>