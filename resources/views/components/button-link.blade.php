<a id="{{ $id }}" name="{{ $name }}" href="{{ $href }}"
    class="bg-{{ $color }} text-white active:bg-{{ $color }} font-bold uppercase text-xs px-4 py-4 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
<a id="{{ $id }}"
    name="{{ $name }}"

    @if (!$disabled)
        href="{{ $href }}"
    @endif

    class="bg-{{ $color }} text-white active:bg-{{ $color }} font-bold uppercase text-xs
        px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1
        ease-linear transition-all duration-150
        @if ($disabled)
            cursor-not-allowed opacity-50
        @endif"

    type="button"
    >
    {{ $title }}
</a>
