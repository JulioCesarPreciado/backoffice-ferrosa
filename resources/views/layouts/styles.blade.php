    {{-- Tailwind CSS --}}
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    {{-- Datatable --}}
    <link rel="stylesheet" href="{{ asset('public/css/jquery.dataTables.min.css') }}">
    {{-- Toastr --}}
    <link href="{{ asset('public/css/toastr.min.css') }}" rel="stylesheet">
    {{-- Select2 --}}
    <link href="{{ asset('public/css/select2.min.css') }}" rel="stylesheet">
     {{-- Theme bootstrap 5 --}}
 <link rel="stylesheet" href="{{ asset('public/css/select2-bootstrap-5-theme.min.css') }}" />
    {{-- Grid--}}
    <link href="{{ asset('public/css/grid.css') }}" rel="stylesheet">


    {{-- leaflet --}}
    <link rel="stylesheet" href="{{ asset('public/css/leaflet.css') }}" />
    {{-- Datepicker --}}
    <link  href="{{ asset('public/css/datepicker.min.css') }}" rel="stylesheet">
    {{-- 1.53 JSGRID CSS --}}
    <link  href="{{ asset('public/css/jsgrid.min.css') }}" rel="stylesheet">
    <link  href="{{ asset('public/css/jsgrid-theme.min.css') }}" rel="stylesheet">
    <!-- MarkerCluster -->
    <link rel="stylesheet" href="{{ asset('public/css/MarkerCluster.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/css/MarkerCluster.Default.css') }}" />
    <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
    {{-- gridjs --}}
    <link  href="{{ asset('public/css/mermaid.min.css') }}" rel="stylesheet">
    {{-- flatpickr--}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                            {{-- Datatable fix --}}
    <style>
        .dataTables_filter {
            margin-bottom: 0px;
        }

        .dataTables_wrapper .dataTables_length select {
            background: none;
        }


    .jsgrid-grid-header{
        border: 0;
    }


    .jsgrid-header-row{
                background-color: rgba(0, 0, 0, 0.1);
                color: rgba(100,116,139,var(--tw-text-opacity));
                --tw-border-opacity: 1;
                border-color: rgba(241,245,249,var(--tw-border-opacity));
                --tw-bg-opacity: 1;
                background-color: rgba(248,250,252,var(--tw-bg-opacity));
                font-size: .75rem;
                line-height: 1rem;
                font-weight:100;
                text-transform : uppercase;
    }

    .jsgrid-grid-body{
        border: none;
        margin-bottom:0px;
    }

    .jsgrid-table{
                border: 0px;
                font-size: .75rem;
                line-height: 1rem;
                padding: 0%;
                margin-bottom:0px;
    },
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

  </style>



