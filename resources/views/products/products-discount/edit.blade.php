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
<x-crud
title="{{ __('Edit')}} {{ __('Discount')}}"
icon="fas fa-user-tag"
route='product-discount.update'
form='products.products-discount.form'
:item='$product_discount'
:create='false'
:show='false'
:edit='true'>
</x-crud>
@endsection
