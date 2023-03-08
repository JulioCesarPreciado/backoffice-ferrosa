{{-- START form inputs --}}
<div class="flex flex-wrap mt-6">
    <div class="w-full px-4">
        {{-- Alertas --}}
        @include('layouts.alert')
        {{-- Product Select --}}
        <x-input.select2 id="product_id" name="product_id" title="Product" class="producto-select" />
        {{-- Fechas del descuento --}}
        <x-input.date id="discount_start_date" name="discount_start_date" title="Discount start date" :item="$item->discount_start_date" />
        <x-input.date id="discount_end_date" name="discount_end_date" title="Discount end date" :item="$item->discount_end_date" />
        {{-- Precio original del producto --}}
        <x-input.text id="product_price" name="product_price" title="Product price" show />
        <div class="flex flex-wrap items-center border-none border-teal-500 w-full md:w-32-6per pt-5 md:pt-0">
            <label for="percentage" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                {{ __('Percentage') }}</label>
            <input id="percentage" name="percentage" id="percentage" placeholder="{{ __('Percentage') }}"
                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                value="{{ old('', $item->percentage) }}"
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
        </div>
        <div class="flex flex-wrap items-center border-none border-teal-500 w-full  md:w-32-6per pt-5 md:pt-0">
            <label for="discount" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                {{ __('Discount') }}</label>
            <input placeholder="{{ __('Discount') }}" id="discount" name="discount"
                value="{{ old('discount', $item->discount) }}" readonly
                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
        </div>
        <div class="w-full px-4 mt-4">
            <input type="checkbox" id="status" @if ($item->status == 'ACTIVO') checked @endif name="status"
                value="{{ old('status', $item->status) }}"
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
        <x-button-link title="{{ __('Return') }}" color="blue-500" id="button_return" name="button_return"
            href="{{ route('products.discount.index') }}">
        </x-button-link>
        {{-- END button return --}}
    </div>
    @if (!$show)
        <div class="w-full md:w-1/2 px-4">
            {{-- START button submit --}}
            <x-button-submit title="{{ __('Save') }}" color="green" id="button_submit" name="button_submit">
            </x-button-submit>
            {{-- END button submit --}}
        </div>
    @else
        <div class="w-full md:w-1/2 px-4">
            {{-- START button edit --}}
            <x-button-link title="{{ __('Edit') }}" color="pink-500" id="button_edit" name="button_edit"
                href="{{ route('product-discount.edit', $item) }}">
            </x-button-link>
            {{-- END button edit --}}
        </div>
    @endif
</div>
{{-- END buttons return, submit, edit --}}
@push('js')
    <script>
        $(document).ready(function() {

            var product_price = null

            let id = "{{ old('product_id', $item->product_id) }}"
            getProduct(id)

            function formatState(state) {
                if (state.loading)
                    return '<span class="text-sm text-gray-500 p-2 ml-2">{{ __('Loading...') }}</span>';
                if (!state.id) {
                    return state.text;
                }
                var $state = $(
                    '<div class="flex justify-around items-center"><img src="data:image/png;base64,' + state
                    .thumbnail +
                    '" class="m-2 object-cover rounded-full shadow-lg" style="height: 77px; width:77px;" /><span class="ml-4">' +
                    state.text + '</span></div>'
                );
                return $state;
            };

            $('.producto-select').select2({
                templateResult: formatState,
                "language": {
                    "noResults": function() {
                        return "{{ __('Product was not found') }}";
                    },
                    "inputTooShort": function() {
                        return "{{ __('You must write at least 2 characters') }}";
                    }
                },
                escapeMarkup: function(markup) {
                    return markup;
                },
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route('products.search') }}',
                    dataType: "json",
                    type: 'GET',
                    delay: 250,
                },
                cache: true
            });

            /* Recuperando la instancia de flatpickr */
            flatpickr("#discount_start_date", {
                minDate: Date.now()
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
            //cada que cambia el select ejecuto la función getProduct para que me traiga información del producto
            $("#product_id").change(function() {
                getProduct($("#product_id option:selected").val())
            });

            function getProduct(id) {
                var url = "{{ route('products.price', ['product_id' => 'value']) }}";
                url = url.replace('value', id);
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(data) {
                        //en el edit siempre cargara el producto, al entrar o al fallar la validación, entonces siempre se tendrá que añadir un option
                        $("#product_id").append(`<option id="${data.id}">${data.name}</option>`);

                        product_price = data.price

                        $('#product_price').val(`$ ${data.price}`)
                        if ($('#percentage').val() != "" && $('#percentage').val() > 0 && $(
                                '#percentage').val() < 100) {
                            var discount = (product_price * ($('#percentage').val() / 100))
                            discount = Math.round(discount * 100) / 100
                            var r = product_price - discount
                            r = Math.round(r * 100) / 100
                            $('#discount').val(r)
                        }
                    },
                    error: function(data) {
                        toastr.error(data);
                    }
                });
            }

        });
    </script>
@endpush
