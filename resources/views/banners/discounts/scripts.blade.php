<script>
    // Variable con los registros
    var json_banners;
    //Cargamos
    initialLoad()
    //Función que carga todo
    function initialLoad() {
        getDataSource();
    }
    /* Cambia el status a inactivo del registro selecionado  */
    function deletethisplease(id) {
        var url = "{{ route('banner.destroy', ['banner' => 'value']) }}";
        url = url.replace('value', id);
        $.ajax({
            url: url,
            type: "delete",
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(data) {
                Swal.fire(
                    'Desactivado!',
                    'El registro ha sido desactivado.',
                    'success'
                ).then((result) => {
                    location.reload();
                })
            },
            error: function() {
                toastr.error(data);
            }
        });
    }
    /* Confirmamos si desea desactivar el registro  */
    function myConfirm(id) {
        Swal.fire({
            title: 'Desea desactivar al registro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Desactivar registro!'
        }).then((result) => {
            if (result.isConfirmed) {
                deletethisplease(id)
            }
        })
    }
    /* Muestra los datos del campo selecionado  */
    function showData(id) {
        var url = "{{ route('banner.edit', ['banner' => 'value']) }}";
        url = url.replace('value', id);
        var action = "{{ route('banner.update', 'id') }}"
        action = action.replace('id', id);
        $.ajax({
            url: url,
            type: "GET",
            success: function(data) {
                /* Muestra los datos y desabilita las funciones  */
                $("#name_edit").prop('disabled', false);
                $("#lastnamep_edit").prop('disabled', false);
                $("#lastnamem_edit").prop('disabled', false);
                $("#status").prop('disabled', false);
                document.getElementById("ocultarenshow").style.display = "block";
                /* Mostrara los datos del controller al model   */
                $("#id_agent_edit").val(data.id)
                $("#name_edit").val(data.name)
                $("#lastnamep_edit").val(data.lastname_p)
                $("#lastnamem_edit").val(data.lastname_m)
                $('#banners_edit').attr('action', action);
                document.getElementById('status').value = data.status;
                modalHandler(true, 'editmodel', id);
            },
            error: function() {
                toastr.warning('{{ __('Something went wrong!') }}');
            }
        });
    }
    /* Muestra los datos del campo selecionado  */
    function onlyshowdata(id) {

        var url = "{{ route('banner.show', ['banner' => 'value']) }}";
        url = url.replace('value', id);
        $.ajax({
            url: url,
            type: "GET",
            success: function(data) {
                /* Oculta los datos y desabilita las funciones  */
                $("#name_edit").prop('disabled', true);
                $("#email_edit").prop('disabled', true);
                $("#lastnamem_edit").prop('disabled', true);
                $("#status").prop('disabled', true);
                document.getElementById("ocultarenshow").style.display = "none";
                /* Mostrara los datos del controller al model   */
                $("#name_edit").val(data.name)
                $("#email_edit").val(data.email)
                $("#lastnamem_edit").val(data.lastname_m)
                document.getElementById('status').value = data.status;
                modalHandler(true, 'editmodel', id);
            },
            error: function() {
                toastr.warning('{{ __('Something went wrong!') }}');
            }
        });
    }
    /* Traduce el status de ingles a español  */
    function traductorjson_status(archivojson, palabrabuscar, palabratraducir) {
        for (var i = 0; i < archivojson.length; ++i) {
            if (archivojson[i].status === palabrabuscar) {
                archivojson[i].status = palabratraducir;
            }
        }
    }
    /* Se obtienen los Json de registros que es la fuente de datos del gridjs */
    function getDataSource() {
        $.ajax({
            url: "{{ route('banner.index') }}",
            type: "GET",
            dataType: "json",
            async: false,
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(data) {
                traductorjson_status(data.banners, "INACTIVE", "INACTIVO")
                traductorjson_status(data.banners, "ACTIVE", "ACTIVO")
                json_banners = data.banners;
            },
            error: function() {
                toastr.warning("{{ __('Looks like something went wrong!') }}");
            }
        });
    }
    $("div#wrapper").Grid({
        columns: [{
                id: 'id',
                name: "{{ __('ID') }}",
                hidden: true
            },
            {
                id: 'thumbnail',
                name: "{{ __('Thumbnail') }}",
                formatter: (cell, row) => {
                    console.log(row.cells[1].data);
                    var srcStr = "{{ asset('public/storage/upload/banner/value') }}";
                    srcStr = srcStr.replace('value', row.cells[1].data);

                    var img = h('img', {
                        src: srcStr,
                        className: 'mb-2 object-cover'
                    }, '');
                    return [img];
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
                name: "{{ __('Last update') }}"
            },
            {
                id: 'accion',
                name: "{{ __('') }}",
                sort: false,
                formatter: (cell, row) => {
                    var urlShow = "{{ route('banner.show', ['banner' => 'value']) }}";
                    urlShow = urlShow.replace('value', row.cells[0].data);

                    var show = h('a', {
                        href: urlShow,
                        className: 'fas fa-eye p-4  mr-1 text-white p-3 text-center inline-flex items-center justify-center w-10 h-10 shadow-lg rounded-full bg-yellow-500',
                    }, '');

                    var urlEdit = "{{ route('banner.edit', ['banner' => 'value']) }}";
                    urlEdit = urlEdit.replace('value', row.cells[0].data);

                    var edit = h('a', {
                        href: urlEdit,
                        className: 'fas fa-edit p-4  mr-1 text-white p-3 text-center inline-flex items-center justify-center w-10 h-10 shadow-lg rounded-full bg-blue-500',
                    }, '');


                    var deletethis = h('button', {
                        className: 'fas fa-trash p-4  text-white p-3 text-center inline-flex items-center justify-center w-10 h-10 shadow-lg rounded-full bg-red-500',
                        onClick: () => myConfirm(row.cells[0].data),

                    }, '');
                    return [show, edit, deletethis];
                }
            },
        ],
        search: true,
        pagination: true,
        sort: true,
        data: json_banners,
        language: {
            search: {
                placeholder: "🔍 Busqueda..."
            },
            sort: {
                sortAsc: "Ordenar la columna en orden ascendente",
                sortDesc: "Ordenar la columna en orden descendente"
            },
            pagination: {
                previous: "Anterior",
                next: "Siguiente",
                navigate: function(e, r) {
                    return "Página " + e + " de " + r
                },
                page: function(e) {
                    return "Página " + e
                },
                showing: "Mostrando los resultados",
                of: "de un total de",
                to: "-",
                results: "registros"
            },
            loading: "Cargando...",
            noRecordsFound: "Nigún resultado encontrado",
            error: "Se produjo un error al recuperar datos"
        },
        style: {
            th: {
                'background-color': 'rgba(0, 0, 0, 0.1)',
                color: 'rgba(100,116,139,var(--tw-text-opacity))',
                '--tw-border-opacity': '1',
                'border-color': 'rgba(241,245,249,var(--tw-border-opacity))',
                '--tw-bg-opacity': '1',
                'background-color': 'rgba(248,250,252,var(--tw-bg-opacity))',
                'font-size': '.75rem',
                'line-height': '1rem',
                'font-weight': '600',
                'text-transform': 'uppercase',

            },
            td: {
                'padding': '1px 4px',
                'border': '0px',
                'font-size': '.75rem',
                'line-height': '1rem',



            },
        },
        className: {
            table: 'w-full'
        }

    });
    /* Controlador del modal  */
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
</script>

<style>
    td.gridjs-td:last-child {
        text-align: center;
    }
</style>
