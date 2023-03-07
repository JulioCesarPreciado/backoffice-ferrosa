<a id="{{ $id }}" name="{{ $name }}" @if (!$disabled) href="{{ $href }}" @endif
    class="bg-{{ $color }} text-white active:bg-{{ $color }} font-bold uppercase text-xs
        px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1
        ease-linear transition-all duration-150 w-full text-center
        @if ($disabled) cursor-not-allowed opacity-50 @endif"
    type="button" style="margin: auto;">
    {{ $title }}
</a>
