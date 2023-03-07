<li class="items-center text-gray-600 hover:text-gray-300">
    <a href="{{ route($href) }}"
        class="text-xs uppercase py-3 font-bold block
        @if ($route == $href) text-{{ $setting->color }}-700 hover:text-{{ $setting->color }}-300 @endif">
        <i
            class="{{ $icon }} mr-2 text-sm
        @if ($route == $href) text--{{ $setting->color }}-700 @endif
        "></i>
        {{ __($title) }} {{ $count ? '(' . $count . ')' : null }}
    </a>
</li>
