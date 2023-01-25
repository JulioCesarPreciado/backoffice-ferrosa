@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Newsletter') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Newsletter') }}
@endsection
{{-- Contenido --}}
@section('content')
    <x-table.grid-js
        id="wrapper_newsletter"
        title="{{ __('Newsletter') }}"
        icon="far fa-newspaper"
        url="newsletter"
        parameter="newsletter"
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
                id: 'content',
                name: "{{ __('Content') }}",
                formatter: (cell, row) => {
                    srcStr = row.cells[2].data;

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
                name: "{{ __('Title') }}",
            },
            {
                id: 'status',
                name: "{{ __('Status') }}",
            },
            {
                id: 'sent',
                name: "{{ __('Sent') }}",
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
