@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Seo') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Seo') }}
@endsection
{{-- Contenido --}}
@section('content')
    <x-crud
        title="{{ __('Edit')}} {{ __('SEO')}}"
        icon="fa fa-search"
        route='seo.update'
        form='site_settings.seo.form'
        :item='$seo'
        :create='false'
        :show='false'
        :edit='true'>
    </x-crud>
@endsection
