{{-- Tailwind CSS --}}
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
{{-- Toastr --}}
<link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
{{-- Select2 --}}
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
{{-- Theme bootstrap 5 --}}
<link rel="stylesheet" href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}" />
{{-- Grid --}}
<link href="{{ asset('css/grid.css') }}" rel="stylesheet">
{{-- Datepicker --}}
<link href="{{ asset('css/datepicker.min.css') }}" rel="stylesheet">
{{-- 1.53 JSGRID CSS --}}
<link href="{{ asset('css/jsgrid.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/jsgrid-theme.min.css') }}" rel="stylesheet">
{{-- gridjs --}}
<link href="{{ asset('css/mermaid.min.css') }}" rel="stylesheet">
{{-- flatpickr --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

{{-- Datatable fix --}}
<style>
    .jsgrid-grid-header {
        border: 0;
    }

    .jsgrid-header-row {
        background-color: rgba(0, 0, 0, 0.1);
        color: rgba(100, 116, 139, var(--tw-text-opacity));
        --tw-border-opacity: 1;
        border-color: rgba(241, 245, 249, var(--tw-border-opacity));
        --tw-bg-opacity: 1;
        background-color: rgba(248, 250, 252, var(--tw-bg-opacity));
        font-size: .75rem;
        line-height: 1rem;
        font-weight: 100;
        text-transform: uppercase;
    }

    .jsgrid-grid-body {
        border: none;
        margin-bottom: 0px;
    }

    .jsgrid-table {
        border: 0px;
        font-size: .75rem;
        line-height: 1rem;
        padding: 0%;
        margin-bottom: 0px;
    }

    ,
    table.gridjs-table tr:nth-child(odd) td {
        background-color: rgb(241, 245, 249);
    }

    table.gridjs-table tr:nth-child(even) td {
        background-color: rgb(248, 250, 252);
    }

    /* Código CSS para agregar hover a gridjs */
    table.gridjs-table tr:hover td {
        background-color: rgb(59 130 245 / .40);
    }

    .collapse-title,
    .collapse>input[type="checkbox"] {
        width: 100%;
        padding: 0rem;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        min-height: 0rem;
        transition: background-color 0.2s ease-in-out;
    }
    .collapse-arrow .collapse-title:after {

        top: 0.8rem;
        left: 12rem;

    }
</style>
