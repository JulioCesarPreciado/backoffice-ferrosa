@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Update products') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Update products') }}
@endsection
{{-- Contenido --}}
@section('content')
   <x-card>
   </x-card>
@endsection
@push('js')
    @include('products.odoo-products.scripts')
@endpush
