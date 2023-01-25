@push('js')
    {{-- Código para mostrar la imagen cargada --}}
    <script>
        $('#logo_path').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#logo').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

        $('#icon_path').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#icon').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

        $('#background_path').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#background').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

        // Cambiamos el atributo de color y tono para previsualizar antes de guardar cambios en ajax
        $('#color').change(function() {

            $('#banner_color').attr('class',
                'relative bg-' + $('#color').val() + '-' + $('#shade').val() + ' md:pt-32 pb-32 pt-12'
            );

            $('#text_color').attr('class',
                'text-xs uppercase py-3 font-bold block  text-' + $('#color').val() + '-' + $('#shade').val() +
                ' hover:text-' + $('#color').val() + '-300 '
            );

        })

        $('#shade').change(function() {

            $('#banner_color').attr('class',
                'relative bg-' + $('#color').val() + '-' + $('#shade').val() + ' md:pt-32 pb-32 pt-12'
            );

            $('#text_color').attr('class',
                'text-xs uppercase py-3 font-bold block  text-' + $('#color').val() + '-' + $('#shade').val() +
                ' hover:text-' + $('#color').val() + '-300 '
            );


        })
    </script>
@endpush
