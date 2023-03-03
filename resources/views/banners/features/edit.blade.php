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
        title="{{ __('Edit')}} {{ __('Banner')}}"
        icon="fas fa-images"
        route='banner_featured.update'
        form='banners.features.form'
        :item='$banner_featured'
        :create='false'
        :show='false'
        :edit='true'
        :records="$records"
        >
    </x-crud>
@endsection
