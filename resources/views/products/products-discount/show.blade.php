@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Discounts') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Discounts') }}
@endsection
{{-- Contenido --}}
@section('content')
    {{$product_discount}}
    <select name="product_id" class="w-full">
            <option value="{{ $product_discount->producto->id }}" selected>{{ $product_discount->producto->name }}</option>
    </select>
@endsection
