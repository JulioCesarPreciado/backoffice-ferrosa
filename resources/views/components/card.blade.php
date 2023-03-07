<div class="w-full px-4">
    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-slate-100 border-0">
        <div class="rounded-t bg-white mb-0 px-6 py-6">
            <div class="text-center flex justify-between">
                <h6 class="text-base-content text-xl font-bold">
                    <div
                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-{{$setting->color}}-700">
                        <i class="fas fa-download"></i>
                    </div>
                    {{ __('Update products') }}
                </h6>
            </div>
            <div class="flex justify-center flex-col items-center">
                <img src="{{ asset('img/product_import.svg') }}" class="shadow-lg rounded-lg" style="width:250px" alt="">
                <div class="text-2xl text-gray-500 mt-4">{{ __('Update your products brought from odoo') }}</div>
            </div>
            <div id="button_container" class="flex justify-center mt-6 mb-6">
                <button id="button"
                    class="bg-blue-500 text-white active:bg-green-700 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 hover:bg-green-700"
                    type="button" onclick="actualizarProductos()">
                    {{ __('Update products') }}
                </button>
            </div>
            <div id="loader" class="flex justify-center items-center hidden">
                <img src="{{ asset('img/Loader.gif') }}" style="width:75px" alt="">
                <p class="text-lg text-gray-500">{{ __('Updating products, please do not close the page.') }}</p>
            </div>
        </div>
    </div>
</div>
