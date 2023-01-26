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
    <select name="product_id" class="js-example-basic-single w-full" required>
        @foreach ($productos as $producto)
            @if($product_discount->producto->id == $producto->id)
                <option value="{{ $producto->id }}" selected>{{ $producto->name }}</option>
            @else
                <option value="{{ $producto->id }}">{{ $producto->name }}</option>
            @endif
        @endforeach
    </select>
@endsection
