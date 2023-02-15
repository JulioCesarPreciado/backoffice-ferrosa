<script>
    function actualizarProductos() {

        $('#button').attr('disabled', 'true')
        $('#button_container').hide()
        $('#loader').removeClass('hidden')
        $('#loader').show()

        $.ajax({
            url: "{{ route('store') }}",
            type: "GET",
            dataType: "json",
            async: true,
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(data) {
                toastr.success("{{ __('Updated products!') }}");
                $('#button').removeAttr('disabled')
                $('#button_container').show()
                $('#loader').hide()
            },
            error: function(data) {
                toastr.error("{{ __('An error occurred, try again!') }}");
            }
        });
    }
</script>
