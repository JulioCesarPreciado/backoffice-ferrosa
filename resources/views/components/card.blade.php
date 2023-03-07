<div class="w-full px-4">
    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-slate-100 border-0">
        <div class="rounded-t bg-white mb-0 px-6 py-6">
            <div class="text-center flex justify-between">
                <h6 class="text-base-content text-xl font-bold">
                    <div
                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-{{ $setting->color }}-700">
                        <i class="{{ $icon }}"></i>
                    </div>
                    {{ __($title) }}
                </h6>
            </div>
        </div>
        {{ $slot }}
    </div>
</div>
