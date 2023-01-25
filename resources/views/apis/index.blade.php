@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Apis') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Apis') }}
@endsection
{{-- Contenido --}}
@section('content')
    <x-js-grid title="{{ __('Apis') }}" icon="fas fa-key" url="apis" parameter="api" edit="true" delete="true"
        create="true">
        {{-- Aquí se pone las columnas jsGrid --}}
        <x-slot name="columns">
            {
            name: "id",
            type: "number",
            width: 1
            },
            {
            title: "{{ __('Name') }}",
            name: "name",
            type: "text",
            validate: {
            message: "{{ __('Name is required') }}",
            validator: function(value) {
            return value != "";
            }
            },
            },
            {
            title: "{{ __('Email') }}",
            name: "email",
            type: "text",
            },
            {
            title: "{{ __('ID Platform') }}",
            name: "id_platform",
            type: "text",

            },
            {
            title: "{{ __('Token') }}",
            name: "token",
            type: "text",
            validate: {
            message: "{{ __('Token is required') }}",
            validator: function(value) {
            return value != "";
            }
            },
            },
            {
            title: "{{ __('Public Key') }}",
            name: "public_key",
            type: "text",
            editing: false,
            filtering: false,
            },

            {
            title: "{{ __('Private Key') }}",
            name: "private_key",
            type: "text",
            width: 150,
            editing: false,
            filtering: false,
            },


            {
            title: "{{ __('Validity') }}",
            name: "validity",
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
