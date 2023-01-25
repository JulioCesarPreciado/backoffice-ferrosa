@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Banners') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Product feature') }}
@endsection
{{-- Contenido --}}
@section('content')
    <x-table.grid-js
        title="{{ __('Product feature') }}"
        icon="fas fa-images"
        url="banner"
        parameter="banner"
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
                id: 'thumbnail',
                name: "{{ __('Thumbnail') }}",
                formatter: (cell, row) => {
                    srcStr = row.cells[1].data;

                    var img = h('img', {
                        src: srcStr,
                        className: 'm-2 object-cover',
                        style: 'height: 77px;'
                    }, '');
                    return img;
                }
            },
            {
                id: 'title',
                name: "{{ __('Title') }}"
            },
            {
                id: 'status',
                name: "{{ __('Status') }}"
            },
            {
                id: 'updated_at',
                name: "{{ __('Last Update') }}",
                formatter: (cell, row) => {
                    return formatDate(cell)
                }
            },
            {
                id: 'validity',
                name: "{{ __('Validity') }}",
                hidden: true
            },
        </x-slot>
    </x-table.grid-js>
@endsection
