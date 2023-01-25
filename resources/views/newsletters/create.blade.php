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
        title="{{ __('Create')}} {{ __('Newsletter')}}"
        icon="far fa-newspaper"
        route='newsletter.store'
        form='newsletters.form'
        {{-- :item='' --}}
        :create='true'
        :show='false'
        :edit='false'>
    </x-crud>
@endsection
