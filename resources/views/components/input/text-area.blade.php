<div class="relative w-full mb-3">
    <label class="block uppercase text-slate-600 text-xs font-bold mb-2" htmlFor="{{ $name }}">
        {{ __($title) }}
        <span id="{{ $id }}-length" name="{{ $id }}-length" class="text-slate-400">({{ $maxlength }}/{{ $maxlength }})</span>
    </label>
    <textarea id="{{ $id }}" name="{{ $name }}"
        placeholder="{{ __('Add ') }}{{ __( $title ) }}"

        class="
        @if ($show)
        disabled:opacity-50
        @endif
        @if ($readonly)
        read-only:bg-green-500
        @endif
        border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150
        "

        @if ($show)
            disabled
        @endif

        @if ($required)
            required
        @endif

        @if ($readonly)
            readonly
        @endif

        cols="{{ $cols }}" rows="{{ $rows }}"

        maxlength="{{ $maxlength }}"
        >@if (!$create){{ old($name, $value) }}@else{{ old($name) }}@endif</textarea>
</div>


@push('js')
<script>
    $(document).ready(function() {
        $("textarea").each(function () {
            this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
        }).on("input", function () {
            this.style.height = 0;
            this.style.height = (this.scrollHeight) + "px";
        });

        // Saca el numero de chars de lo que hay
        let charQty = $('#{{$id}}').val().length;
        $("#{{ $id }}-length").text("(" + charQty + "/" + {{ $maxlength }} + ")")

        // Actualiza el numero de chars cada que escribe
        $('#{{$id}}').on('input', function(event) {
            let charQty = $('#{{$id}}').val().length;
            // alert('Changed!' + charQty);
            $("#{{ $id }}-length").text("(" + charQty + "/" + {{ $maxlength }} + ")")
        });
    });
</script>
@endpush
