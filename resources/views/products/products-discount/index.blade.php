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
                name: "{{ __('Product description') }}",
                formatter: (cell, row) => {
                    srcStr = row.cells[1].data;
                    var img_src = "data:image/png;base64," +srcStr
                    value_cell = gridjs.html(
                        `<div class="flex justify-around items-center">
                            <img src=${img_src} class="m-2 object-cover rounded-full shadow-lg" style="height: 77px; width:77px;">   
                            <span class="ml-4">${row.cells[2].data}</span> 
                        </div>`
                    )
                    return value_cell;
                }

            },
            {
                id: 'product_name',
                name: "{{ __('Product name') }}",
                hidden: true
            },
            {
                id: 'discount_end_date',
                name: "{{ __('Discount end date') }}",
            },
            {
                id: 'percentage',
                name: "{{ __('Percentage') }}",
                formatter: (cell, row) => {
                    return cell + " %"
                }
            },
            {
                id: 'status',
                name: "{{ __('Status') }}",
            }
        </x-slot>
    </x-table.grid-js>
@endsection