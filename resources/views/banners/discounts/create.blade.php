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

    <x-crud
    title="{{ __('Create')}} {{ __('Banner')}}"
    icon="fas fa-images"
    route='banner_discount.store'
    form='banners.discounts.form'
    {{-- :item='' --}}
    :create='true'
    :show='false'
    :edit='false'
    :records="$records"
    >
    </x-crud>
@endsection
@push('js')
    <script>
        var products_discount = {{$records}}

        if(products_discount.length === 0){
            Swal.fire({
            title: `{{ __("You don't have discounted products, do you want to add one?") }}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ __('Yes, I want to add one!') }}",
            cancelButtonText: "{{ __('Cancel') }}"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "{{route('products.discount.index')}}"
            }else{
                window.location = "{{route('banners.discounts.index')}}"   
            }
        })
        }

    </script>
@endpush
