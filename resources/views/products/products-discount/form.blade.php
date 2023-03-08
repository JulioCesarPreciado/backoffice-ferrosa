{{-- START form inputs --}}
<div class="flex flex-wrap mt-6">
    <div class="w-full px-4">
        {{-- Alertas --}}
        @include('layouts.alert')
        {{-- Product Select --}}
        <x-input.select2 id="product_id" name="product_id" title="Product" class="producto-select" />
        {{-- Fechas del descuento --}}
        <x-input.date id="discount_start_date" name="discount_start_date" title="Discount start date" :item="$item->discount_start_date ?? null" />
        <x-input.date id="discount_end_date" name="discount_end_date" title="Discount end date" :item="$item->discount_end_date ?? null" />
        {{-- Precio original del producto --}}
        <x-input.text id="product_price" name="product_price" title="Product price" show />
        <div class="flex flex-wrap items-center border-none border-teal-500 w-full md:w-32-6per pt-5 md:pt-0">
            <label for="percentage" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                {{ __('Percentage') }}</label>
            <input id="percentage" name="percentage" id="percentage" placeholder="{{ __('Percentage') }}"
                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                value="{{ old('', $item->percentage ?? null) }}"
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
        </div>
        <div class="flex flex-wrap items-center border-none border-teal-500 w-full  md:w-32-6per pt-5 md:pt-0">
            <label for="discount" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                {{ __('Discount') }}</label>
            <input placeholder="{{ __('Discount') }}" id="discount" name="discount"
                value="{{ old('discount', $item->discount ?? null) }}" readonly
                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
        </div>
        <div class="w-full px-4 mt-4">
            <input type="checkbox" id="status" @if ($item->status ?? 'ACTIVO' == 'ACTIVO') checked @endif name="status"
                value="{{ old('status', $item->status ?? 'ACTIVO') }}"
                class="border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring ease-linear transition-all duration-150 hover:bg-slate-300">
            <label for="status" class=" uppercase text-slate-600 text-xs font-bold mb-2 ml-2">
                {{ __('Active') }}
            </label>
        </div>
    </div>
</div>
{{-- END form inputs --}}

{{-- START show updated and created info --}}
@if ($show)
    <div class="flex flex-wrap mt-6">
        <div class="w-full md:w-1/2 px-4">
            {{-- START input created by --}}
            <div class="relative w-full mb-3">
                <x-input.text title='Created by' :value='$create ? null : $item->created_by' :readonly=true :create='$create' :show='$show'
                    :edit='$edit'>
                </x-input.text>
            </div>
            {{-- END input created by --}}

            {{-- START input updated by --}}
            <div class="relative w-full mb-3">
                <x-input.text title='Updated by' :value='$create ? null : $item->updated_by' :readonly=true :create='$create' :show='$show'
                    :edit='$edit'>
                </x-input.text>
            </div>
            {{-- END input updated by --}}
        </div>

        <div class="w-full md:w-1/2 px-4">
            {{-- START input created at --}}
            <div class="relative w-full mb-3">
                <x-input.text title='Created at' :value='$create ? null : $item->created_at' :readonly=true :create='$create' :show='$show'
                    :edit='$edit'>
                </x-input.text>
            </div>
            {{-- END input created at --}}

            {{-- START input updated at --}}
            <div class="relative w-full mb-3">
                <x-input.text title='Updated at' :value='$create ? null : $item->updated_at' :readonly=true :create='$create' :show='$show'
                    :edit='$edit'>
                </x-input.text>
            </div>
            {{-- END input updated at --}}
        </div>
    </div>
@endif
{{-- END show updated and created info --}}

{{-- START buttons return, submit, edit --}}
<div class="flex flex-wrap mt-6">
    <div class="w-full md:w-1/2 px-4">
        {{-- START button return --}}
        <x-button-link title="{{ __('Return') }}" color="blue-500" id="button_return"
            href="{{ route('products.discount.index') }}" />
        {{-- END button return --}}
    </div>
    @if (!$show)
        <div class="w-full md:w-1/2 px-4">
            {{-- START button submit --}}
            <x-button-submit title="{{ __('Save') }}" color="green" id="button_submit" />
            {{-- END button submit --}}
        </div>
    @else
        <div class="w-full md:w-1/2 px-4">
            {{-- START button edit --}}
            <x-button-link title="{{ __('Edit') }}" color="pink-500" id="button_edit"
                href="{{ route('product-discount.edit', $item) }}" />
            {{-- END button edit --}}
        </div>
    @endif
</div>
{{-- END buttons return, submit, edit --}}
