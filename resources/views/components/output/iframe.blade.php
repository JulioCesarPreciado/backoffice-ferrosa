<label class="block uppercase text-slate-600 text-xs font-bold mb-2"
htmlFor="iframe_{{ $name }}">
{{ __($title) }}
</label>
<iframe
    id="iframe_{{ $id }}"
    name="iframe_{{ $name }}"
    title="{{$title}}"
    width="100%"
    height="600"

    @if (!$value)
        src="{{ asset('img/no_image.jpg') }}"
    @else
        src="{{ $value }}"
    @endif
    >
</iframe>
