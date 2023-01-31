
<label class="block uppercase text-slate-600 text-xs font-bold mb-2"
    htmlFor="{{ $name }}">
    {{ __($title) }}
</label>
<img id="preview_{{ $name }}" name="preview_{{ $name }}" style="height: 200px;" class="mb-2 object-cover"
    @if (!$value) src="{{ asset('public/img/no_image.jpg') }}"
    @else
    src="{{ asset($value) }}"
    @endif
>

@if (!$show)
<input type="file" id="{{ $id }}" name="{{ $name }}"
 {{-- onchange="showMyImage(this,'logo')"  preguntar esto para que es?--}}
    class="mb-4 border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
    accept=".jpg, .jpeg, .png"
    @if ($create && $required)
        required
    @endif
>
@endif

{{-- JQuery --}}
<script src="{{ asset('public/js/jquery-3.6.0.min.js') }}"></script>

{{-- Código para la vista previa de la imagen al crear --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#{{ $id }}').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_{{ $name }}').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

