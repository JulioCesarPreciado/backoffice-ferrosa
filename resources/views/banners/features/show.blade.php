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
        title="{{ __('Show')}} {{ __('Banner')}}"
        icon="fas fa-images"
        {{-- route='' --}}
        form='banners.features.form'
        :item='$banner_featured'
        :create='false'
        :show='true'
        :edit='false'
        :records="$records"
        >
    </x-crud>
@endsection
