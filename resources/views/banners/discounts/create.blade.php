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
