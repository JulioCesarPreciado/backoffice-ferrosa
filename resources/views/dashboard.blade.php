@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Dashboard') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Dashboard') }}
@endsection
{{-- Contenido --}}
@section('content')
    <div class="flex flex-wrap mt-4">
        {{-- START Venta del Dia --}}
        <x-indicator name="Daily Sales" id="sale_day" color="purple" icon="fas fa-dollar-sign">
            <x-slot name="sign">$</x-slot>
        </x-indicator>
        {{-- END  Venta del Dia --}}
        {{-- START Venta del Mes --}}
        <x-indicator name="Monthly Sales" id="sale_month" color="blue" icon="fas fa-dollar-sign">
            <x-slot name="sign">$</x-slot>
        </x-indicator>
        {{-- END Venta del Mes --}}
        {{-- START Venta Anual --}}
        <x-indicator name="Yearly Sales" id="sale_year" color="pink" icon="fas fa-dollar-sign">
            <x-slot name="sign">$</x-slot>
        </x-indicator>
        {{-- END Venta Anual --}}
        {{-- START PEDIDOS PENDIENTES --}}
        <x-indicator name="Pending Orders" id="sale_pending" color="orange" icon="fas fa-box"></x-indicator>
    </div>
    {{-- END PEDIDOS PENDIENTES --}}
    <div class="pt-5">
        <x-table.grid-js title="{{ __('Recent Orders') }}" icon="" url="dashboards" parameter="dashboard"
            :create="false" :show="false" :edit="false" :delete="false">

            {{-- Aquí se ponen las columnas GridJs --}}
            <x-slot name="columns">
                {
                id: 'id',
                name: "{{ __('ID') }}",
                hidden: true
                },
                {
                id: 'created_at',
                name: "{{ __('Date of Order') }}",
                formatter: (cell, row) => {
                return formatDate(cell)
                }
                },
                {
                id: 'shipping_method',
                name: "{{ __('Shipping Method') }}"
                },
                {
                id: 'payment_method',
                name: "{{ __('Payment Method') }}"
                },
                {
                id: 'total',
                name: "{{ __('Total') }}"
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
            </x-slot>
        </x-table.grid-js>
    </div>



    @push('js')
        @include('dashboard.dashboard-counters')
    @endpush
@endsection
