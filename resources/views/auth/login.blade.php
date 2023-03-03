<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @php
        $setting = App\Models\Config::first();
    @endphp

    <title>{{ $setting->name ?? '' }} - Login</title>

    @if (isset($setting->icon))
        <link rel="icon" href="{{ $setting->icon }}">
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}">
    @endif
</head>

<body>
    <div class="bg-no-repeat bg-cover bg-center relative "
        @if (isset($setting->background))
            style="background-image: url({{ $setting->background }})"
        @else
            style="background-image: url({{ asset('img/bg.jpeg') }})"
        @endif>
        <div
            @if (isset($setting->color))
                class="absolute bg-gradient-to-b from-{{ $setting->color }}-500 to-{{ $setting->color }}-400 opacity-75 inset-0 z-1  "
            @else
                class="absolute bg-gradient-to-b from-blue-500 to-blue-400 opacity-75 inset-0 z-1  "
            @endif>
        </div>
        <div class="min-h-screen flex m-auto  sm:flex-row  w-11/12   sm:justify-center z-30  ">
            <div class="   self-center p-0 sm:p-10 sm:max-w-5xl xl:max-w-2xl  z-10  ">
                <div class="self-start hidden lg:flex flex-col  text-white">
                    <img src="" class="mb-3">
                    <h1 class="mb-3 font-bold text-5xl">{{ __('Hi 👋 Welcome To ') }}
                        @if (isset($setting->name))
                            {{ $setting->name }}
                        @else
                            {{ __('Site') }}
                        @endif
                    </h1>
                    <p class="pr-3">Lorem ipsum is placeholder text commonly used in the graphic, print,
                        and publishing industries for previewing layouts and visual mockups</p>
                </div>
            </div>
            <div class="flex justify-center self-center  z-10">
                <div class="p-12 bg-white mx-auto rounded-2xl w-100 ">
                    <div class="mb-4">
                        <h3 class="font-semibold text-2xl text-gray-800">{{ __('Sign In') }} </h3>
                        <p class="text-gray-500">{{ __('Please sign in to your account') }}.</p>
                    </div>
                    @include('layouts.alert')
                    <form method="POST" action="{{ route('login') }}" autocomplete="on">
                        @csrf
                        <div class="space-y-5">
                            <div class="space-y-2">
                                <label
                                    class="text-sm font-medium text-gray-700 tracking-wide">{{ __('Email') }}</label>
                                <input id="email" name="email"
                                    @if (isset($setting->color))
                                        class="w-full text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-{{ $setting->color }}-400"
                                    @else
                                        class="w-full text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-blue-400"
                                    @endif
                                    type="email" placeholder="mail@gmail.com" value="{{ old('email') }}" autofocus
                                    required>
                            </div>
                            <div class="space-y-2">
                                <label class="mb-5 text-sm font-medium text-gray-700 tracking-wide">
                                    {{ __('Password') }}
                                </label>
                                <input id="password" name="password"
                                    @if (isset($setting->color))
                                        class="w-full content-center text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-{{ $setting->color }}-400"
                                    @else
                                        class="w-full content-center text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-blue-400"
                                    @endif
                                    type="password" placeholder="{{ __('Enter your password') }}" required>
                            </div>
                            <div>
                                <button type="submit"
                                    @if (isset($setting->color))
                                    class="w-full flex justify-center bg-{{ $setting->color }}-400  hover:bg-{{ $setting->color }}-500 text-gray-100 p-3  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500"
                                    @else
                                    class="w-full flex justify-center bg-blue-400  hover:bg-blue-500 text-gray-100 p-3  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500"
                                    @endif
                                    >
                                    {{ __('login in') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="pt-5 text-center text-gray-400 text-xs">
                        <span>
                            {{ $setting->name ?? '' }} V 0.1.0 © <span id="get-current-year"></span>
                            | Hecho con 💜 por <a href="https://www.perspective.com.mx" target="_blank"
                                class="text-purple-500 hover:underline">Perspective Global de México</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        (function() {
            if (document.getElementById("get-current-year")) {
                document.getElementById(
                    "get-current-year"
                ).innerHTML = new Date().getFullYear();
            }
        })();
    </script>
</body>

</html>
