@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Banners') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Banners') }}
@endsection
{{-- Contenido --}}
@section('content')
    <select class="js-example-basic-single w-full">
        @foreach($productos as $producto)
            <option value="{{$producto->id}}">{{$producto->name}}</option>
        @endforeach
    </select>
    <div
        class="flex flex-wrap items-center border-none border-teal-500 w-full  md:w-32-6per pt-5 md:pt-0">

        <label for="vigencia_inicial"
            class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
            {{ __('Initial term') }}</label>
        <input name="vigencia_inicial" id="vigencia_inicial"
            value="{{ old('vigencia_inicial') }}"
            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
            placeholder="{{ __('Effective Date Initial') }}" required>
    </div>

    <div
        class="flex flex-wrap items-center border-none border-teal-500 w-full  md:w-32-6per pt-5 md:pt-0">

        <label for="vigencia_final"
            class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
            {{ __('Final term') }}</label>
        <input name="vigencia_final" id="vigencia_final"
            value="{{ old('vigencia_final') }}"
            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
            placeholder="{{ __('End Effective Date') }}" required>
    </div>
    <div>
        <input id="percentage" placeholder="Porcentaje" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
    </div>
    <div>
        <input placeholder="Discount">
    </div>
@endsection

@push('js')
    <script>   
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
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