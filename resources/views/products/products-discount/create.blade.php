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
                    @include('layouts.alert')
                    <form method="POST" action="{{ route('product-discount.store') }}" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        <div
                            class="flex flex-wrap items-center border-none border-teal-500 w-full  md:w-32-6per pt-5 md:pt-0">

                            <label for="product_id" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                {{ __('Product') }}</label>
                            <select name="product_id" id="product_id" class="producto-select w-full" required>
                                @foreach ($productos as $producto)
                                    <option title="{{ $producto->thumbnail }}" value="{{ $producto->id }}"
                                        {{ collect(old('product_id'))->contains($producto->id) ? 'selected' : '' }}>
                                        {{ $producto->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div
                            class="flex flex-wrap items-center border-none border-teal-500 w-full  md:w-32-6per pt-5 md:pt-0">

                            <label for="discount_start_date"
                                class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                {{ __('Discount start date') }}</label>
                            <input name="discount_start_date" id="discount_start_date"
                                value="{{ old('discount_start_date') }}"
                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                placeholder="{{ __('Discount start date') }}" required>
                        </div>

                        <div
                            class="flex flex-wrap items-center border-none border-teal-500 w-full  md:w-32-6per pt-5 md:pt-0">

                            <label for="discount_end_date" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                {{ __('Discount end date') }}</label>
                            <input name="discount_end_date" id="discount_end_date" value="{{ old('discount_end_date') }}"
                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                placeholder="{{ __('Discount end date') }}" required>
                        </div>
                        <div
                            class="flex flex-wrap items-center border-none border-teal-500 w-full  md:w-32-6per pt-5 md:pt-0">
                            <label for="product_price" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                {{ __('Product price') }}</label>
                            <input placeholder="{{ __('Product price') }}" value="" id="product_price"
                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                disabled>
                        </div>
                        <div
                            class="flex flex-wrap items-center border-none border-teal-500 w-full  md:w-32-6per pt-5 md:pt-0">
                            <label for="percentage" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                {{ __('Percentage') }}</label>
                            <input id="percentage" name="percentage" placeholder="{{ __('Percentage') }}"
                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                value="{{ old('percentage') }}"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                        <div
                            class="flex flex-wrap items-center border-none border-teal-500 w-full  md:w-32-6per pt-5 md:pt-0">
                            <label for="discount" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                {{ __('Discount price') }}</label>
                            <input placeholder="{{ __('Discount price') }}" id="discount" name="discount"
                                value="{{ old('discount') }}"
                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 mb-12"
                                readonly>
                        </div>
                        <div class="flex flex-wrap mt-6">
                            <div class="w-full md:w-1/2 px-4">
                                <a href="{{ route('products.discount.index') }}" class="bg-blue-500 text-white active:bg-blue-500 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150" type="button">
                                    {{ __('Return') }}
                                </a>
                            </div>
                            <div class="w-full md:w-1/2 px-4">
                                <button type="submit" id="validar"
                                    class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md hover:bg-green-400 outline-none focus:outline-none mr-1 ease-linear transition-all duration-150">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {

            var products = {!! $productos->toJson() !!};
            var product_price = null

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

            $('.producto-select').select2({
                templateResult: formatState,
                "language": {
                    "noResults": function() {
                        return "No se encontró el producto";
                    }
                },
                escapeMarkup: function(markup) {
                    return markup;
                }
            });

            //setea los valores por primera vez
            $('#product_price').val(`$ ${$("#product_id option:selected").val()}`)
            product_price = $("#product_id option:selected").val()

            /* Recuperando la instancia de flatpickr */
            flatpickr("#discount_start_date", {
                minDate: new Date()
            });
            flatpickr("#discount_end_date", {});

            /* VALIDACION ENTRE LAS FECHAS DE VIGENCIA */

            /* CREATE */
            const discount_start_date = document.getElementById('discount_start_date');
            const discount_end_date = document.getElementById('discount_end_date');
            if (discount_start_date) {
                discount_start_date.addEventListener("change", (e) => {
                    if (discount_start_date != "") {
                        discount_end_date.disabled = false
                        $("#discount_end_date").val("")
                    }
                    flatpickr(discount_end_date, {
                        minDate: e.target.value,
                    });
                })
            };

            document.getElementById("percentage").onkeyup = function() {
                var input = parseInt(this.value);
                if (input > 0 && input < 100) {
                    var discount = (product_price * (input / 100))
                    discount = Math.round(discount * 100) / 100
                    var r = product_price - discount
                    r = Math.round(r * 100) / 100
                    $('#discount').val(r)
                    $('#validar').removeAttr('disabled')
                    $('#validar').removeClass('cursor-not-allowed')
                } else {
                    $('#discount').val(0.0)
                    $('#validar').attr('disabled', 'true')
                    $('#validar').addClass('cursor-not-allowed')
                }
            }


            $("#product_id").change(function() {
                var product = products.find(element => element.id == $("#product_id option:selected").val())
                product_price = product.price
                $('#product_price').val(`$ ${product.price}`)

                if ($('#percentage').val() != "" && $('#percentage').val() > 0 && $('#percentage').val() <
                    100) {
                    var discount = (product_price * ($('#percentage').val() / 100))
                    discount = Math.round(discount * 100) / 100
                    var r = product_price - discount
                    r = Math.round(r * 100) / 100
                    $('#discount').val(r)
                }
            });

        });
    </script>
@endpush