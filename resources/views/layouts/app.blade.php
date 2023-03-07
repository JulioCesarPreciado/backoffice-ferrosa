<!DOCTYPE html>
<html data-theme="cupcake" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.header.meta')

    <title>{{ $setting->name ?? '' }} Admin - @yield('title')</title>

    <link rel="icon" href="{{ $setting->icon }}">

    @include('layouts.styles')
</head>

<body class="text-base-content antialiased">
    <div id="root">
        <x-sidebar />
        {{-- END sidebar --}}
        <div class="relative md:ml-64">
            {{-- START header --}}
            @include('layouts.header')
            <div id="banner_color" class="bg-{{ $setting->color }}-{{ $setting->shade }} md:pt-32 pb-32  pt-12"></div>
            {{-- END header --}}
            <div class="px-4 md:px-10 mx-auto w-full -m-20 absolute">
                {{-- START main --}}
                <div class="mb-28">
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
