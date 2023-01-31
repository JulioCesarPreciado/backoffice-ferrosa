<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Perspective Global de México">
    <meta name="description" content="Reservaciones de Rush Sport Bar">
    <meta name="keywords" content="reservaciones,rush,sport,bar">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $setting = App\Models\Config::first();
    @endphp

    <title>{{ $setting->name }} - Error: @yield('title')</title>

    @if (isset($setting->icon))
        <link rel="icon" href="{{ asset('upload/site_setting/' . $setting->icon) }}">
    @endif
    {{-- CSS --}}
    @include('errors.css')
</head>

<body>
    <section class="page_404">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="col-sm-10 col-sm-offset-1  text-center">
                        <div class="four_zero_four_bg">
                            <h1 class="text-center ">@yield('title')</h1>
                        </div>

                        <div class="contant_box_404">
                            <h3 class="h2">
                                @yield('title-error')
                            </h3>

                            <p>@yield('description')</p>

                            <a href="{{ route('dashboard') }}" class="link_404">{{ __('Go to Home') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
