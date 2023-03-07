<ul class="md:flex-col md:min-w-full flex flex-col list-none">
    <li class="items-center collapse collapse-arrow @if (in_array($route, $routes)) text-{{ $setting->color }}-700 hover:text-{{ $setting->color }}-300 @else text-gray-600 hover:text-gray-300 @endif"
        style="display:grid">
        <input type="checkbox" class="peer" @if (in_array($route, $routes)) checked @endif />
        <div class="collapse-title text-xs uppercase font-bold">
            <i
                class="mr-2 text-sm {{ $icon }}"></i>
            {{ __($title) }}
        </div>

        <div class="collapse-content">
            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                {{-- Con esto se muestran todos los componentes list-item puestos en el slot --}}
                {{ $list_items }}
            </ul>
        </div>
    </li>
</ul>
