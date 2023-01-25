@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Settings') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Settings') }}
@endsection
{{-- Contenido --}}
@section('content')
    <div class="flex flex-wrap">
        {{-- CARD CONFIG PAGE --}}
        @include('site_settings.config.page')
        {{-- END CARD CONFIG PAGE --}}

        {{-- CARD CONFIG COMPANY --}}
        @include('site_settings.config.contact')
        {{-- END CARD CONFIG COMPANY --}}

        @include('site_settings.config.scripts')
    </div>
@endsection
