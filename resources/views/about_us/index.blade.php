@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('About Us') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('About Us') }}
@endsection
{{-- Contenido --}}
@section('content')
    <x-crud
        title="{{ __('Edit')}} {{ __('About Us')}}"
        icon="fas fa-address-card"
        route='about.update'
        form='about_us.form'
        :item='$data'
        :create='false'
        :show='false'
        :edit='true'>
    </x-crud>
@endsection
