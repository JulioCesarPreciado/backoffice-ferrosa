@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Newsletter') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Newsletter') }}
@endsection
{{-- Contenido --}}
@section('content')
    <x-crud
        title="{{ __('Edit')}} {{ __('Newsletter')}}"
        icon="far fa-newspaper"
        route='newsletter.update'
        form='newsletters.form'
        :item='$newsletter'
        :create='false'
        :show='false'
        :edit='true'>
    </x-crud>
@endsection
