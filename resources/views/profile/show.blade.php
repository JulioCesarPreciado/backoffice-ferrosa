@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Profile') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Profile') }}
@endsection
{{-- Contenido --}}
@section('content')
    {{-- START Profile information --}}
    @include('profile.update-profile-information-form')
    {{-- END Profile information --}}
    {{-- START Update password --}}
    @include('profile.update-password-form')
    {{-- END Update password --}}
    {{-- START Delete --}}
    @include('profile.delete-user-form')
    {{-- END Delete --}}
@endsection
{{--  --}}
