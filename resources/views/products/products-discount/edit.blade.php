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
                        
                    </div>
                    <div
                        class="flex flex-wrap items-center border-none border-teal-500 md:w-32-6per pt-5 md:pt-0">

                        <label for="vigencia_inicial" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                            {{ __('Initial term') }}</label>
                        <input name="discount_start_date" id="vigencia_inicial"
                            value="{{ $product_discount->discount_start_date }}"
                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                            placeholder="{{ __('Effective Date Initial') }}" required disabled>
                    </div>

                    <div
                        class="flex flex-wrap items-center border-none border-teal-500 md:w-32-6per pt-5 md:pt-0">

                        <label for="vigencia_final" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                            {{ __('Final term') }}</label>
                        <input name="discount_end_date" id="vigencia_final"
                            value="{{ $product_discount->discount_end_date }}"
                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                            placeholder="{{ __('End Effective Date') }}" required disabled>
                    </div>
                    <div
                        class="flex flex-wrap items-center border-none border-teal-500 w-full md:w-32-6per pt-5 md:pt-0">
                        <label for="percentage" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                            {{ __('Percentage') }}</label>
                        <input id="percentage" name="percentage" placeholder="Porcentaje"
                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                            value="{{ $product_discount->percentage }}"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                            disabled>
                    </div>
                    <div
                        class="flex flex-wrap items-center border-none border-teal-500 w-full  md:w-32-6per pt-5 md:pt-0">
                        <label for="discount" class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                            {{ __('Discount') }}</label>
                        <input placeholder="Discount" name="discount" value="{{ $product_discount->discount }}"
                            disabled
                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
