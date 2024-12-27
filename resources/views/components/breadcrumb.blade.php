<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="color: #696f89">
        @foreach($items as $item)
            <li class="breadcrumb-item">
                @if($loop->last)
                    {{ $item['name'] }}
                @else
                    <a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
                @endif
            </li>

            @unless($loop->last)
                {{-- <x-svg.breadcrumb-divider />   --}}
                <div class=" pb-0">
                    <i class="fa-solid fa-angles-right fa-xs px-1" style="padding-top: 11px"></i>
                </div>
            @endunless
        @endforeach
    </ol>
</nav>