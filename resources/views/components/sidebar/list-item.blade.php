<li class="items-center">
    <a href="{{ route( $href ) }}"
        class="text-xs uppercase py-3 font-bold block
        @if ($route == $href)
        text-blue-500 hover:text-blue-600
        @else
        hover:text-gray-600
        @endif"
        >
        <i class="{{ $icon }} mr-2 text-sm
        @if ($route == $href)
            text-blue-600
        @else
            text-gray-600
        @endif
        "></i>
        {{ __($title) }} {{$count ? '(' . $count . ')' : null}}
    </a>
</li>
