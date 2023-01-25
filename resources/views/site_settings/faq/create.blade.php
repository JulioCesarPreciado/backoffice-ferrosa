@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('FAQ') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('FAQ') }}
@endsection
{{-- Contenido --}}
@section('content')
    <x-crud
        title="{{ __('Create')}} {{ __('FAQ')}}"
        icon="fas fa-images"
        route='faq.store'
        form='site_settings.faq.form'
        {{-- :item='' --}}
        :create='true'
        :show='false'
        :edit='false'>
    </x-crud>
@endsection
