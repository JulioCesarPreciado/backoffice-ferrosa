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
                                <i class="fas fa-image"></i>
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

                            <label for="vigencia_inicial" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                {{ __('Initial term') }}</label>
                            <select name="product_id"
                                class="js-example-basic-single border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                required>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div
                            class="flex flex-wrap items-center border-none border-teal-500 w-full  md:w-32-6per pt-5 md:pt-0">

                            <label for="vigencia_inicial" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                {{ __('Initial term') }}</label>
                            <input name="discount_start_date" id="vigencia_inicial" value="{{ old('discount_start_date') }}"
                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                placeholder="{{ __('Effective Date Initial') }}" required>
                        </div>

                        <div
                            class="flex flex-wrap items-center border-none border-teal-500 w-full  md:w-32-6per pt-5 md:pt-0">

                            <label for="vigencia_final" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                {{ __('Final term') }}</label>
                            <input name="discount_end_date" id="vigencia_final" value="{{ old('discount_end_date') }}"
                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                placeholder="{{ __('End Effective Date') }}" required>
                        </div>
                        <div>
                            <input id="percentage" name="percentage" placeholder="Porcentaje"
                                value="{{ old('percentage') }}"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                        <div>
                            <input placeholder="Discount" name="discount" value="{{ old('discount') }}">
                        </div>
                        <button type="submit" class="bg-blue-600 p-4 rounded-lg shadow-lg">Enviar</button>
                    </form>
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
                var baseUrl = "/user/pages/images/flags";
                var $state = $(
                    '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() +
                    '.png" class="img-flag" /> ' + state.text + '</span>'
                );
                return $state;
            };
            
            $('.js-example-basic-single').select2({
                templateResult: formatState
            });
        });



        /* Recuperando la instancia de flatpickr */
        flatpickr("#vigencia_inicial", {});
        flatpickr("#vigencia_final", {});
        flatpickr("#vigencia_inicial_edit", {});
        flatpickr("#vigencia_final_edit", {});

        /* VALIDACION ENTRE LAS FECHAS DE VIGENCIA */

        /* CREATE */
        const vigencia_inicial = document.getElementById('vigencia_inicial');
        const vigencia_final = document.getElementById('vigencia_final');
        if (vigencia_inicial) {
            vigencia_inicial.addEventListener("change", (e) => {
                if (vigencia_inicial != "") {
                    vigencia_final.disabled = false
                    $("#vigencia_final").val("")
                }
                flatpickr(vigencia_final, {
                    minDate: e.target.value,
                });
            })
        };

        /* EDIT */
        const vigencia_inicial_edit = document.getElementById('vigencia_inicial_edit');
        const vigencia_final_edit = document.getElementById('vigencia_final_edit');
        if (vigencia_inicial_edit) {
            vigencia_inicial_edit.addEventListener("change", (e) => {
                if (vigencia_inicial_edit != "") {
                    vigencia_final_edit.disabled = false
                    $("#vigencia_final_edit").val("")
                }
                flatpickr(vigencia_final_edit, {
                    minDate: e.target.value,
                });
            })
        };

        document.getElementById("percentage").onkeyup = function() {
            var input = parseInt(this.value);
            if (input < 0 || input > 100)
                alert("Value should be between 0 - 100");
            return;
        }
    </script>
@endpush
