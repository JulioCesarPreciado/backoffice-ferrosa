<div class="w-full px-4">
    <div class="relative flex flex-col min-w-0 break-words w-full mb-0 shadow-lg rounded-lg bg-slate-100 border-0">
        <div class="rounded-t bg-white mb-0 px-2 py-6">
            <div class="text-center flex  justify-between">
                <h6 class="text-slate-700 text-xl font-bold">
                    <div
                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-{{ $setting->color }}-700">
                        <i class="{{ $icon }}"></i>
                    </div>
                    {{ $title }}
                </h6>
            </div>
        </div>
        <div id="jsGrid" class="m-0"></div>
    </div>
</div>
@push('js')
    <script>
        /* Cargamos las funciones */
        loadDataSource();
        reloadGrid();
        /* Esta fucnción tiene la logica que carga la info de la tabla ademas de las acciones y filtros.  */
        function loadDataSource() {
            db = {
                //Llamado en la carga de datos
                loadData: function(filter) {
                    var d = $.Deferred();
                    // server-side filtering
                    $.ajax({
                        type: "POST",
                        url: "{{ route($url . '.filter') }}",
                        data: {
                            "_token": $('meta[name="csrf-token"]').attr('content'),
                            filter: filter
                        },
                        dataType: "json"
                    }).done(function(data) {
                        d.resolve(data);
                    })
                    return d.promise();
                },
                @if ($create)
                    //Llamado en la inserción de gravedad
                    insertItem: function(insertingClient) {
                        return $.ajax({
                            url: "{{ route($url . '.store') }}",
                            type: 'POST',
                            dataType: "JSON",
                            data: {
                                "_token": $('meta[name="csrf-token"]').attr('content'),
                                obj: insertingClient
                            },
                            success: function(data) {
                                toastr.success("{{ __('Record created!') }}");
                            },
                            error: function(data) {
                                if (data.status === 400) {
                                    Object.entries(data.responseJSON.mensaje)
                                    .map(([, fieldErrors]) =>
                                        fieldErrors.map(fieldError =>   toastr.error(fieldError))
                                    )
                                }
                                if (data.status === 500) {
                                    toastr.error(data.responseJSON.mensaje);
                                }
                            }
                        });
                    },
                @endif
                //Proceso de actualización
                @if ($edit)
                    updateItem: function(updatingClient) {
                        var url = "{{ route($url . '.update', [$parameter => 'value']) }}";
                        url = url.replace('value', updatingClient["id"]);
                        return $.ajax({
                            url: url,
                            type: 'PUT',
                            dataType: "json",
                            data: {
                                "_token": $('meta[name="csrf-token"]').attr('content'),
                                obj: updatingClient
                            },
                            success: function(data) {
                                toastr.success("{{ __('Register Updated!') }}");
                            },
                            error: function(data) {
                                if (data.status === 400) {
                                    Object.entries(data.responseJSON.mensaje)
                                    .map(([, fieldErrors]) =>
                                        fieldErrors.map(fieldError =>   toastr.error(fieldError))
                                    )
                                }
                                if (data.status === 500) {
                                    toastr.error(data.responseJSON.mensaje);
                                }
                            }
                        });

                    },
                @endif
                //Proceso de eliminación
                @if ($delete)
                    deleteItem: function(deletingClient) {
                        var url = "{{ route($url . '.destroy', [$parameter => 'value']) }}";
                        url = url.replace('value', deletingClient["id"]);
                        return $.ajax({
                            url: url,
                            type: 'DELETE',
                            dataType: "json",
                            data: {
                                "_token": $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                toastr.warning("{{ __('Log off!') }}");
                            },
                            error: function(data) {
                                if (data.status === 400) {
                                    Object.entries(data.responseJSON.mensaje)
                                    .map(([, fieldErrors]) =>
                                        fieldErrors.map(fieldError =>   toastr.error(fieldError))
                                    )
                                }
                                if (data.status === 500) {
                                    toastr.error(data.responseJSON.mensaje);
                                }
                            }
                        });
                    }
                @endif
            };
        }
        //Elementos extras
        {{ $extras }}
        /* Esta función genera la tabla (columnas y configuraciones) */
        function reloadGrid() {
            $(function() {
                $("#jsGrid").jsGrid({
                    height: "auto",
                    width: "100%",
                    filtering: true,
                    @if ($edit)
                        editing: true,
                    @else
                        editing: false,
                    @endif
                    @if ($create)
                        inserting: true,
                    @else
                        inserting: false,
                    @endif
                    sorting: true,
                    paging: true,
                    autoload: true,
                    pageSize: 10,
                    pageButtonCount: 5,
                    invalidMessage: "¡Se ingresaron datos no válidos!",
                    invalidNotify: function(args) {
                        var messages = $.map(args.errors, function(error) {
                            return "\r  <br /> *" + error.message;
                        });
                        toastr.warning("{{ __('Invalid data entered! ') }}" + "\n" + messages);
                    },
                    noDataContent: "No se encontro ningun dato",
                    pagerFormat: "Paginas: {first} {prev} {pages} {next} {last}  {pageIndex} de {pageCount}",
                    pagePrevText: "Anterior",
                    pageNextText: "Siguiente",
                    pageFirstText: "Primera",
                    pageLastText: "Ultima",
                    pageNavigatorNextText: "...",
                    pageNavigatorPrevText: "...",
                    loadIndication: true,
                    loadIndicationDelay: 500,
                    loadMessage: "Espere por favor...",
                    loadShading: true,
                    @if ($delete)
                        confirmDeleting: false,
                        onItemDeleting: function(args) {
                            if (!args.item.deleteConfirmed) { // custom property for confirmation
                                args.cancel = true; // cancel deleting
                                Swal.fire({
                                    title: "{{ __('Do you want to reject?') }}",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: "{{ __('Yes, reject it!') }}",
                                    cancelButtonText: "{{ __('Cancel') }}"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        args.item.deleteConfirmed = true;
                                        $("#jsGrid").jsGrid("deleteItem", args.item);
                                    }
                                })
                            }
                        },
                    @else
                        deleting: false,
                    @endif
                    controller: db,
                    fields: [
                        {{ $columns }} {
                            type: "control",
                            @if (!$edit)
                                editButton: false,
                            @endif
                            @if (!$delete)
                                deleteButton: false,
                            @endif
                        }
                    ]
                });
                //Ocultamos el la columan del id  de los registros.
                $("#jsGrid").jsGrid("fieldOption", "id", "visible", false);
                //Ordenamos los datos por la fecha de actualizacion
                $("#jsGrid").jsGrid("sort", {
                    field: "updated_at",
                    order: "desc"
                });
            });
        }
    </script>
@endpush
