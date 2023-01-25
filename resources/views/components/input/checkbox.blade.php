<input type="checkbox" id="{{ $id }}" name="{{ $name }}"
    class="
    @if ($show) disabled:opacity-50 bg-slate-300 @endif
    border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring ease-linear transition-all duration-150 hover:bg-slate-300"
    @if ($value == 'ACTIVO') checked @endif @if ($show) disabled @endif>

<label for="{{ $id }}" class=" uppercase text-slate-600 text-xs font-bold mb-2">
    {{ $title }}
</label>
