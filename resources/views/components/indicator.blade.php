<div class="w-full lg:w-1/4 xl:w-1/4  px-4">
    <div class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
        <div class="flex-auto p-4">
            <div class="flex flex-wrap">
                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                    <h5 class="text-slate-400 uppercase font-bold text-xs">
                        {{ __($name) }}
                    </h5>
                    {{ $sign ?? '' }}
                    <span class="counter" id="{{ $id }}">0</span>
                </div>
                <div
                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-{{ $color }}-500">
                    <i class="{{ $icon }}"></i>
                </div>
            </div>
        </div>
    </div>
</div>
