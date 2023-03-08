<div class="flex flex-wrap items-center border-none border-teal-500 md:w-32-6per pt-5 md:pt-0">
    <label for="{{$id}}" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
        {{ __($title) }}</label>
    <input name="{{$name}}" id="{{$id}}"
        value="{{ old('$name', $item) }}"
        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
        placeholder="{{ __($title) }}" required>
</div>
