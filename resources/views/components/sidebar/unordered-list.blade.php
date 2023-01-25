
<ul class="md:flex-col md:min-w-full flex flex-col list-none text-slate-600">
    <li class="items-center collapse collapse-arrow " style="display:grid">
        <input type="checkbox" class="peer"
        {{-- Verifica si la ruta actual esta en las rutas definidas para el unordered-list y
            marca como activo el unordered list --}}
            @if (in_array($route, $routes))
                checked
            @endif

            />
        <div class="collapse-title text-xs uppercase font-bold
            {{-- Verifica si la ruta actual esta en las rutas definidas para el unordered-list y
            pinta el unordered list --}}
            @if (in_array($route, $routes))
                text-blue-500 hover:text-blue-600
            @endif"
            >
            <i class="mr-2 text-sm
                {{-- Verifica si la ruta actual esta en las rutas definidas para el unordered-list y
                pinta el icono de unordered list --}}
                @if (in_array($route, $routes))
                    text-blue-600
                @endif
                {{ $icon }}"></i>
            {{ __( $title) }}
        </div>

        <div class="collapse-content">
            <ul class="md:flex-col md:min-w-full flex flex-col list-none text-slate-600">
                {{-- Con esto se muestran todos los componentes list-item puestos en el slot--}}
                {{ $list_items }}
            </ul>
        </div>
    </li>
</ul>
