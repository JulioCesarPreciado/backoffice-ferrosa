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
<x-table.grid-js
        title="{{ __('Discounts') }}"
        icon="fas fa-user-tag"
        url="product-discount"
        parameter="product_discount"
        :create="true"
        :show="true"
        :edit="true"
        :delete="true">

        {{-- Aquí se ponen las columnas GridJs --}}
        <x-slot name="columns">
            {
                id: 'id',
                name: "{{ __('ID') }}",
                hidden: true
            },
            {
                id: 'image',
                name: "{{ __('Product Image') }}",
                formatter: (cell, row) => {
                    srcStr = row.cells[1].data;

                    var img = h('img', {
                        src: "data:image/png;base64," +srcStr,
                        className: 'm-2 object-cover',
                        style: 'height: 77px;'
                    }, '');
                    return img;
                }

            },
            {
                id: 'discount_start_date',
                name: "{{ __('Start date') }}",
            },
            {
                id: 'discount_end_date',
                name: "{{ __('End date') }}",
            },
            {
                id: 'percentage',
                name: "{{ __('Percentage') }}",
            },
            {
                id: 'discount',
                name: "{{ __('Discount') }}",
            },
            {
                id: 'status',
                name: "{{ __('Status') }}",
            }
        </x-slot>
    </x-table.grid-js>
@endsection