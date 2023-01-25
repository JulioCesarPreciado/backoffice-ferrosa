<script>
    var json_reportes;
    initialLoadInfraccion()
    //funcion que ejecuta mis funciones
    function initialLoadInfraccion() {
        getDataSourceInfraccion()
        counter()


    }
    //consulta
    function getDataSourceInfraccion() {
        $.ajax({
            url: "{{ route('dashboards.index') }}",
            type: "GET",
            dataType: "json",
            async: false,
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(data) {
                json_reportes = data.reportes;
                var infracciones = document.getElementById('sale_day')
                infracciones.setAttribute('data-target', Math.round(data.daily * 100) / 100)
                var ordenes = document.getElementById('sale_month')
                ordenes.setAttribute('data-target', Math.round(data.monthly * 100) / 100 )
                var citatorios = document.getElementById('sale_year')
                citatorios.setAttribute('data-target',  Math.round(data.yearly * 100) / 100)
                var apercibimientos = document.getElementById('sale_pending')
                apercibimientos.setAttribute('data-target', data.pending)


            },


            error: function(data) {
                json_reportes = data.reportes;
            }

        });
    }
    //funcion contador para incremenatr en el dom
    function counter() {
        const counters = document.querySelectorAll('.counter');
        counters.forEach((counter) => {
            counter.innerText = '0';
            const updateCounter = () => {
                const target = +counter.getAttribute('data-target');
                const c = +counter.innerText;
                const increment = target / 100;
                if (c > target) {
                    counter.innerText = target
                }
                if (c < target) {
                    counter.innerText = `${Math.ceil(c + increment)}`
                    setTimeout(updateCounter, 1);
                }
            }
            //callback de la funcion para que actualice
            updateCounter();
        });

    }
</script>
