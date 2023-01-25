<!DOCTYPE html>
<html data-theme="cupcake" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.header.meta')

    @php
        $setting = App\Models\Config::first();
    @endphp

    <title>{{ $setting->name ?? '' }} Admin - @yield('title')</title>

    @if (!isset($setting->icon))
        <link rel="icon" href="{{ $setting->icon }}">

    @endif

    @include('layouts.styles')
</head>

<body class="text-slate-700 antialiased">
    <div id="root">
        {{-- START sidebar --}}

        @if (isset($setting))
            @include('layouts.sidebar', $setting)
        @else
            @include('layouts.sidebar')
        @endif

        {{-- END sidebar --}}
        <div class="relative md:ml-64   bg-slate-50">
            {{-- START header --}}
            @include('layouts.header')


            <div id="banner_color"
                @if (isset($setting))
                    class=" bg-{{ $setting->color }}-{{ $setting->shade }} md:pt-32 pb-32  pt-12"
                @else
                    class=" bg-blue-500 md:pt-32 pb-32  pt-12"
                @endif
            >

                <div class="px-4 md:px-10 mx-auto w-full ">
                </div>
            </div>
            {{-- END header --}}
            <div class="px-4 md:px-10  mx-auto w-full -m-20 absolute">
                {{-- START main --}}
                <div class="mb-28   ">
                    @yield('content')
                </div>
                    </div>
                    {{-- END main --}}
                {{-- START footer --}}
            @include('layouts.footer')
            {{-- END footer --}}
        </div>
    </div>
    {{-- START scripts --}}
    @include('layouts.scripts')
    @stack('js')
    {{-- END scripts --}}
</body>

</html>
