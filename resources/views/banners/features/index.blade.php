@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Featured Product Banners') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Featured Product Banners') }}
@endsection
{{-- Contenido --}}
@section('content')
    <x-table.grid-js
        title="{{ __('Featured Product Banners') }}"
        icon="fas fa-images"
        url="banner_featured"
        parameter="banner_featured"
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
                        src: "data:image/png;base64," +srcStr,
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
