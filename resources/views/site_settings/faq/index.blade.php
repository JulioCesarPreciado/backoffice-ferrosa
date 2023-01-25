@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('FAQ') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('FAQ') }}
@endsection
{{-- Contenido --}}
@section('content')
    <x-table.grid-js
        id="wrapper1"
        title="{{ __('FAQ') }}"
        icon="fas fa-images"
        url="faq"
        parameter="faq"
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
                id: 'validity',
                name: "{{ __('validity') }}",
                hidden: true
            },
            {
                id: 'question',
                name: "{{ __('Question') }}",
                formatter: (cell, row) => {
                    return cutPreviewText(cell, 200)
                }
            },
            {
                id: 'answer',
                name: "{{ __('Answer') }}",
                formatter: (cell, row) => {
                    return cutPreviewText(cell, 200)
                }
            },
            {
                id: 'updated_at',
                name: "{{ __('Last Update') }}",
                formatter: (cell, row) => {
                    return formatDate(cell)
                }
            },
        </x-slot>
    </x-table.grid-js>
@endsection
