<div class="relative w-full mb-3 mt-6">
    <label class="block uppercase text-slate-600 text-xs font-bold mb-2" htmlFor="{{ $name }}">
        {{ __($title) }}
    </label>
    <input id="{{ $id }}" name="{{ $name }}" type="text"
        placeholder="{{ __('Add ') }}{{ __( $title ) }}"
        @if (!$create)
        value="{{ old($name, $value) }}"
        @else
        value="{{ old($name) }}"
        @endif

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
        />
</div>
