{{-- App js --}}
<script src="{{ asset('js/app.js') }}"></script>
{{-- Tailwind element js --}}
<script src="{{ asset('resources/js/app.js') }}"></script>
{{-- JQuery --}}
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
{{-- Datatable --}}
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
{{-- Poppers --}}
<script src="{{ asset('js/popper.js') }}"></script>
{{-- FontAwesome --}}
<script src="{{ asset('js/fontawesome.js') }}" crossorigin="anonymous"></script>
{{-- Chartjs --}}
<script src="{{ asset('js/Chart.min.js') }}" charset="utf-8"></script>
{{-- Sweetalert2 --}}
<script src="{{ asset('js/sweetalert2.js') }}"></script>
{{-- Toastr --}}
<script src="{{ asset('js/toastr.min.js') }}"></script>
<!--  Heatmap -->
<script src="{{ asset('js/heatmap.min.js')}}"></script>
{{-- leaflet --}}
<script src="{{ asset('js/leaflet.js') }}"></script>
{{-- GeoJson --}}
<script src="{{ asset('js/geojson.js') }}"></script>
<!-- MarkersCluster -->
<script src="{{ asset('js/leaflet.markercluster.js') }}"></script>
{{-- Mapa --}}
<script src="{{ asset('js/mapas.js') }}"></script>
<!--Leaflet Heatmap -->
<script src="https://cdn.rawgit.com/pa7/heatmap.js/develop/plugins/leaflet-heatmap/leaflet-heatmap.js"></script>
{{-- Datepicker --}}
<script src="{{ asset('js/datepicker.min.js') }}"></script>
{{-- JSGRID 1.53 --}}
<script src="{{ asset('js/jsgrid.min.js') }}"></script>
{{-- GRID JS --}}
<script src="{{ asset('js/gridjs.umd.js') }}"></script>
{{-- Preact --}}
<script src="{{ asset('js/preact.min.js') }}"></script>
{{-- gridjs --}}
<script src="{{ asset('js/gridjs.production.min.js') }}"></script>
{{-- Select2 --}}
<script src="{{ asset('js/select2.min.js') }}"></script>
{{-- flatpickr js --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
{{-- Scripts template --}}
<script type="text/javascript">
 var {
        h
    } = preact

/* Controlador de los modales del CRUD de GRID.JS  */
function modalHandler(val, nameModal) {
        /*
        val = Determina si se abrira o cerrar el modal.
        nameModal = Nombre del modal a interactuar.
        */
        let modal = document.getElementById(nameModal);

        if (val) {
            //Abrir el modal
            fadeIn(modal);
        } else {
            //Ocultar el modal
            fadeOut(modal);
        }
    }
    function fadeOut(el) {
        el.style.opacity = 1;
        (function fade() {
            if ((el.style.opacity -= 0.1) < 0) {
                el.style.display = "none";
            } else {
                requestAnimationFrame(fade);
            }
        })();
    }

    function fadeIn(el, display) {
        el.style.opacity = 0;
        el.style.display = display || "flex";
        (function fade() {
            let val = parseFloat(el.style.opacity);
            if (!((val += 0.2) > 1)) {
                el.style.opacity = val;
                requestAnimationFrame(fade);
            }
        })();
    }

    // Función para formatear el campo "Updated_at"  (dd/mm/yyyy hh:mm:ss)
    function formatDate(dateToFormat) {
        var dateStr = dateToFormat.substring(0, 10);
        var timeStr = dateToFormat.substring(11, 19);
        var dateTimeStr = dateStr + ' ' + timeStr;
        return dateTimeStr;
    }

    // Función para recortar el texto en una preview y agregar puntos suspensivos
    function cutPreviewText(text, char_qty) {
        if(text.length > char_qty) {
            text = text.substring(0, char_qty) + '...';
        }
        return text;
    }

    /* Make dynamic date appear */
    (function() {
        if (document.getElementById("get-current-year")) {
            document.getElementById(
                "get-current-year"
            ).innerHTML = new Date().getFullYear();
        }
    })();
    /* Sidebar - Side navigation menu on mobile/responsive mode */
    function toggleNavbar(collapseID) {
        document.getElementById(collapseID).classList.toggle("hidden");
        document.getElementById(collapseID).classList.toggle("bg-white");
        document.getElementById(collapseID).classList.toggle("m-2");
        document.getElementById(collapseID).classList.toggle("py-3");
        document.getElementById(collapseID).classList.toggle("px-6");
    }
    /* Function for dropdowns */
    function openDropdown(event, dropdownID) {
        let element = event.target;
        while (element.nodeName !== "A") {
            element = element.parentNode;
        }
        Popper.createPopper(element, document.getElementById(dropdownID), {
            placement: "bottom-start",
        });
        document.getElementById(dropdownID).classList.toggle("hidden");
        document.getElementById(dropdownID).classList.toggle("block");
    }
    /* Datepicker */
    $('[data-toggle="datepicker"]').datepicker();
     //Cargamos el select
     $(".select2").select2({
        theme: "bootstrap-5",
    })
</script>
{{-- Toasters Messages --}}
@if (Session::has('message'))
    <script>
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    </script>
@endif
