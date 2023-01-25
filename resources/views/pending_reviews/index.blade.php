@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Pending Reviews') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Pending Reviews') }}
@endsection
{{-- Contenido --}}
@section('content')
    <x-js-grid title="{{ __('Pending Reviews') }}" icon="fas fa-map-signs" url="pendingreviews" parameter="pendingreview"
         :create="false" :edit="true" :delete="true">
        {{-- Aquí se pone las columnas jsGrid --}}
        <x-slot name="columns">
            {
            name: "id",
            type: "number",
            width: 1
            },
            {
            title: "{{ __('Title') }}",
            name: "title",
            type: "text",
            editing: false,
            },
            {
            title: "{{ __('Review') }}",
            name: "message",
            type: "text",
            width: 150,
            editing: false,
            },
            {
            title: "{{ __('Product') }}",
            name: "products_name",
            editing: false,
            },
            {
            title: "{{ __('User') }}",
            name: "reviews_name",
            editing: false,
            },
            {
            title: "{{ __('Last Update') }}",
            name: "updated_at",
            editing: false,
            readonly: true,
            width: 100,
            itemTemplate: function(value) {
            return formatDate(value);
            },
            },
            {
            title: "{{ __('Status') }}",
            name: "validity",
            type: "select",
            width: 60,
            filtering: false,
            items: db.status,
            selectedIndex: 0,
            valueField: "value",
            textField: "title",
            validate: {
            message: "{{ __('Status is required') }}",
            validator: function(value) {
            return value != "";
            }
            },
            },
        </x-slot>
        {{-- Aquí se pone algún código extra que necesite el jsGrid --}}
        <x-slot name="extras">
            db.status = [{
            title: "{{ __('PENDING') }}",
            value: "PENDING",
            id: 0
            },
            {
            title: "{{ __('APPROVED') }}",
            value: "APPROVED",
            id: 1
            }
            ];
        </x-slot>
    </x-js-grid>
@endsection
