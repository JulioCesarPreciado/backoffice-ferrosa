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
        title="{{ __('Show')}} {{ __('Newsletter')}}"
        icon="far fa-newspaper"
        {{-- route='' --}}
        form='newsletters.form'
        :item='$newsletter'
        :create='false'
        :show='true'
        :edit='false'>
    </x-crud>
@endsection
