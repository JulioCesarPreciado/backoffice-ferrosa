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
    <x-crud title="{{ __('Edit') }} {{ __('Discount') }}" icon="fas fa-user-tag" route='product-discount.update'
        form='products.products-discount.form' :item='$product_discount' :create='false' :show='false' :edit='true'>
    </x-crud>
    @push('js')
        <script>
            $(document).ready(function() {

                var product_price = null

                let id = "{{ old('product_id', $product_discount->product_id) }}"
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
@endsection
