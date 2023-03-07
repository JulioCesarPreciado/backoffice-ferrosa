@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Update products') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Update products') }}
@endsection
{{-- Contenido --}}
@section('content')
    <x-card title="Update products" icon="fas fa-download">
        <div class="flex justify-center flex-col items-center mt-6 mb-6">
            <img src="{{ asset('img/product_import.svg') }}" class="shadow-lg rounded-lg" style="width:250px" alt="">
            <div id="loader" class="flex justify-center items-center hidden">
                <img src="{{ asset('img/Loader.gif') }}" style="width:75px" alt="">
                <p class="text-lg text-gray-500">{{ __('Updating products, please do not close the page.') }}</p>
            </div>
            <div class="text-2xl text-gray-500 mt-4">{{ __('Update your products brought from odoo') }}</div>
            <button id="button"
                class="bg-{{ $setting->color }}-700 text-white active:bg-{{ $setting->color }}-700 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 hover:bg-{{ $setting->color }}-3å00 mt-4"
                type="button" onclick="actualizarProductos()">
                {{ __('Update products') }}
            </button>
        </div>
    </x-card>
@endsection
@push('js')
    @include('products.odoo-products.scripts')
@endpush
