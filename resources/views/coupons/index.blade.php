@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Coupons') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Coupons') }}
@endsection
{{-- Contenido --}}
@section('content')
    @include('layouts.alert')
    <x-js-grid title="{{ __('Coupons') }}" icon="fas fa-tag" url="coupons" parameter="coupon" edit="true" delete="true"
        create="true">
        {{-- Aquí se pone las columnas jsGrid --}}
        <x-slot name="columns">
            {
            name: "id",
            type: "number",
            hidden: true,
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
            title: "{{ __('Discount') }}",
            name: "discount",
            type: "text",
            validate: {
                validator: function(value) {
                    return value >= 0 && value <=100 &&  value !=="";
                },
                message: "{{ __('The value of the discount must be between 0 to 100') }}",
            }
            },
            {
            title: "{{ __('Qty') }}",
            name: "qty",
            type: "text",
            validate: {
                validator: function(value) {
                    return value > 0 && value !=="";
                },
                message: "{{ __('The value of the quantity must be greater than 0') }}",
            }
            },
            {
            title: "{{ __('Initial date') }}",
            name: "initial_date",
            type: "myDateField",
            validate: {
            message: "{{ __('Initial date is required') }}",
            validator: function(value) {
            return value != "";
            },
            itemTemplate: function(value) {
            return formatDate(value);
            },

            },
            },
            {
            title: "{{ __('Final date') }}",
            name: "final_date",
            type: "myDateField",
            validate: {
            message: "{{ __('Final date is required') }}",
            validator: function(value) {
            return value != "";
            },
            itemTemplate: function(value) {
            return formatDate(value);
            },
            },
            },
            {
            title: "{{ __('Status') }}",
            name: "status",
            type: "select",
            width: 60,
            filtering: true,
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
            title: "{{ __('Active') }}",
            value: "ACTIVO",
            id: 0
            },
            {
            title: "{{ __('Inactive') }}",
            value: "INACTIVO",
            id: 1
            }
            ];
            var MyDateField = function(config) {
            jsGrid.Field.call(this, config);
            };
            MyDateField.prototype = new jsGrid.Field({
            sorter: function(date1, date2) {
            return new Date(date1) - new Date(date2);
            },
            insertTemplate: function(value) {
            return this._insertPicker = $("<input>").datepicker({ defaultDate: new Date() });
            },

            editTemplate: function(value) {
            return this._editPicker = $("<input>").datepicker().datepicker("setDate", new Date(value));
            },

            insertValue: function() {
                var date = this._insertPicker.datepicker("getDate").toISOString();
                return formatDate(date);
            },

            editValue: function() {
            var date = this._editPicker.datepicker("getDate").toISOString();
            return formatDate(date);
            },
            });
            jsGrid.fields.myDateField = MyDateField;

        </x-slot>
    </x-js-grid>
@endsection
