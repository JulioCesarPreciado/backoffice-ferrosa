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
        title="{{ __('Show')}} {{ __('FAQ')}}"
        icon="fas fa-images"
        {{-- route='' --}}
        form='site_settings.faq.form'
        :item='$faq'
        :create='false'
        :show='true'
        :edit='false'>
    </x-crud>
@endsection
