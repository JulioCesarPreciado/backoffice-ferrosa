@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Discounts') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Discounts') }}
@endsection
{{-- Contenido --}}
@section('content')
    <div class="flex flex-wrap">
        <div class="w-full px-4">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-slate-100 border-0">
                <div class="rounded-t bg-white mb-0 px-6 py-6">
                    <div class="text-center flex justify-between">
                        <h6 class="text-slate-700 text-xl font-bold">
                            <div
                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-700">
                                <i class="fas fa-user-tag"></i>
                            </div>
                            {{ __('Discounts') }}
                        </h6>
                    </div>
                </div>
                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="flex justify-center">
                        <div
                            class="flex flex-wrap items-center border-none border-teal-500 w-full  md:w-32-6per pt-5 md:pt-0">
                            <div class="flex flex-col justify-around items-center w-full">
                                <img src="data:image/png;base64,{{ $product_discount->producto->thumbnail }}"
                                    class="m-2 object-cover rounded-full shadow-lg" style="height: 200px; width:200px;" />
                                <span class="mt-2">{{ $product_discount->producto->name }}</span>
                            </div>
                        </div>
                        <div
                            class="flex flex-wrap items-center border-none border-teal-500 md:w-32-6per pt-5 md:pt-0 p-4">

                            <label for="discount_start_date" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                {{ __('Discount start date') }}</label>
                            <input name="discount_start_date" id="discount_start_date"
                                value="{{ $product_discount->discount_start_date }}"
                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                placeholder="{{ __('Discount start date') }}" required disabled>
                        </div>

                        <div
                            class="flex flex-wrap items-center border-none border-teal-500 p-4 md:w-32-6per pt-5 md:pt-0">

                            <label for="discount_end_date" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                {{ __('Discount end date') }}</label>
                            <input name="discount_end_date" id="discount_end_date"
                                value="{{ $product_discount->discount_end_date }}"
                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                placeholder="{{ __('Discount end date') }}" required disabled>
                        </div>
                        </div>
                        <div
                            class="flex flex-wrap items-center border-none border-teal-500 w-full  md:w-32-6per pt-5 md:pt-0">
                            <label for="discount" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                {{ __('Product price') }}</label>
                            <input placeholder="{{ __('Product price') }}" name="product_price" value="$ {{ $product_discount->producto->price }}"
                                disabled
                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                        </div>
                        <div
                            class="flex flex-wrap items-center border-none border-teal-500 w-full md:w-32-6per pt-5 md:pt-0">
                            <label for="percentage" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                {{ __('Percentage') }}</label>
                            <input id="percentage" name="percentage" placeholder="{{ __('Percentage') }}"
                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                value="{{ $product_discount->percentage }} %"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                disabled>
                        </div>
                        <div
                            class="flex flex-wrap items-center border-none border-teal-500 w-full  md:w-32-6per pt-5 md:pt-0">
                            <label for="discount" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                {{ __('Discount') }}</label>
                            <input placeholder="{{ __('Discount') }}" name="discount" value="$ {{ $product_discount->discount }}"
                                disabled
                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                        </div>
                        <div class="flex flex-wrap mt-6">
                            <div class="w-full md:w-1/2 px-4">
                                <a href="{{ route('products.discount.index') }}" class="bg-blue-500 text-white active:bg-blue-500 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150" type="button">
                                    {{ __('Return') }}
                                </a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {

            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }
                var $state = $(
                    '<div class="flex justify-around items-center"><img src="data:image/png;base64,' + state
                    .title +
                    '" class="m-2 object-cover rounded-full shadow-lg" style="height: 77px; width:77px;" /><span class="ml-4">' +
                    state.text + '</span></div>'
                );
                return $state;
            };

            $('.js-example-basic-single').select2({
                templateResult: formatState,
            });

            /* Recuperando la instancia de flatpickr */
            flatpickr("#discount_start_date", {inline:true,allowInput: false});
            flatpickr("#discount_end_date", {inline:true, allowInput: false});
        });
    </script>
@endpush
