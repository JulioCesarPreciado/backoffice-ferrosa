@php
    $route = Route::current()->getName();
    $review = App\Models\Reviews::where('validity', 'PENDING')->count();
    $imgs = App\Models\Config::first();
@endphp
{{-- Estilo de Nav/Colapse para que se ajuste sin necesidad de cambiar el App --}}
<style>
    .collapse-title,
    .collapse>input[type="checkbox"] {
        width: 100%;
        padding: 0rem;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        min-height: 0rem;
        transition: background-color 0.2s ease-in-out;
    }


    .collapse-arrow .collapse-title:after {

        top: 0.8rem;
        left: 12rem;

    }
</style>
{{-- Estilo de Nav/Colapse para que se ajuste sin necesidad de cambiar el App --}}
<nav
    class=" bg-white md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
    <div
        class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
        <button
            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
            type="button" onclick="toggleNavbar('example-collapse-sidebar')">
            <i class="fas fa-bars"></i>
        </button>
        <a href="{{ route('dashboard') }}" class="m-auto" aria-label="Dashboard">
            @if (isset($imgs->logo))
                <img src="{{ $imgs->logo }}" alt="img" style="height: 70px;">
            @endif
        </a>
        {{-- START header en moviles --}}
        <ul class="md:hidden items-center flex flex-wrap list-none">
            <li class="inline-block relative">
                <a class="text-gray-600 block" href="#" onclick="openDropdown(event,'user-responsive-dropdown')">
                    <div class="items-center flex">
                        <span
                            class="w-12 h-12 text-sm text-slate-700 bg-slate-400 inline-flex items-center justify-center rounded-full">
                            <img alt="profile picture" class="w-full rounded-full align-middle border-none shadow-lg"
                                src="{{ Auth::user()->profile_photo_url ?? asset('img/user.png') }}" />
                        </span>
                    </div>
                </a>
                <div class="hidden bg-white text-base text-center z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                    id="user-responsive-dropdown">
                    <a href="{{ route('profile.show') }}"
                        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:text-gray-600"><i
                            class="fas fa-user"></i> {{ __('Profile') }}</a>
                    <a href="#"
                        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:text-gray-600"><i
                            class="fas fa-tools"></i> {{ __('Settings') }}</a>
                    <div class="h-0 my-2 border border-solid border-slate-100"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type=" submit" @click.prevent="$root.submit();"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:text-red-500">
                            <i class="fas fa-sign-out-alt"></i>{{ __('Sign Out') }}
                        </button>
                    </form>
                </div>
            </li>
        </ul>
        {{-- END header en moviles --}}
        {{-- START Navigation --}}
        <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-1 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden"
            id="example-collapse-sidebar">
            {{-- START Navigation header --}}
            <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-slate-200">
                <div class="flex flex-wrap">
                    <div class="w-6/12">
                        <a class="md:block text-left md:pb-2 text-slate-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                            href="{{ route('dashboard') }}">
                            @if (isset($setting->logo))
                                <img class="h-10" src="{{ asset('storage/upload/site_setting/' . $setting->logo) }}">
                            @else
                                <img class="h-10" src="{{ asset('img/no_image.jpg') }}">
                            @endif
                        </a>
                    </div>
                    <div class="w-6/12 flex justify-end">
                        <button type="button"
                            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                            onclick="toggleNavbar('example-collapse-sidebar')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            {{-- END Navigation header --}}
            {{-- Divider --}}
            <hr class="my-4 md:min-w-full " />
            {{-- START Dashboard --}}
            <ul class="md:flex-col md:min-w-full flex flex-col list-none text-gray-700">
                <li class="items-center">
                    <x-sidebar.list-item title='Dashboard' icon='fas fa-tv' :route='$route' href='dashboard'>
                    </x-sidebar.list-item>
                </li>
            </ul>
            {{-- END Dashboard --}}
            {{-- Divider --}}<div class="hrs">
                <hr class="my-4 md:min-w-full " />
            </div>
            {{-- Heading --}}
            {{-- START PENDING REVIEWS --}}
            <ul>
                <x-sidebar.list-item title='Pending Reviews' icon='fas fa-map-signs' :route='$route'
                    href='pending_reviews' :count='$review'>
                </x-sidebar.list-item>
            </ul>
            {{-- END PENDING REVIEWS --}}

            {{-- Cupones --}}
            <ul>
                <x-sidebar.list-item title='Coupons' icon='fas fa-tag' :route='$route' href='coupons.index'>
                </x-sidebar.list-item>
            </ul>
            {{-- End cupones-- }}

            {{-- START Banners --}}
            <x-sidebar.unordered-list
                title='Banners'
                icon='fa fa-cog'
                :route='$route'
                :routes="['banners.sliders.index']">
                {{-- Aquí se ponen los datos de los listitem que irian dentro del unordered-list --}}
                <x-slot name="list_items">

                    {{-- START Slider --}}
                    <x-sidebar.list-item title='Collections' icon='fa fa-images' :route='$route'
                        href='banners.sliders.index'>
                    </x-sidebar.list-item>
                    {{-- END Slider --}}

                    {{-- START Slider --}}
                       <x-sidebar.list-item title='Product discounts' icon='fa fa-images' :route='$route'
                       href='banners.sliders.index'>
                   </x-sidebar.list-item>
                   {{-- END Slider --}}

                      {{-- START Slider --}}
                      <x-sidebar.list-item title='Product feature' icon='fa fa-images' :route='$route'
                      href='banners.sliders.index'>
                  </x-sidebar.list-item>
                  {{-- END Slider --}}

                </x-slot>
            </x-sidebar.unordered-list>
            {{-- END Banners --}}

            {{-- START Emails --}}
            <x-sidebar.unordered-list
                title='Emails'
                icon='fa fa-envelope'
                :route='$route'
                :routes="['newsletters.index']">
                {{-- Aquí se ponen los datos de los listitem que irian dentro del unordered-list --}}
                <x-slot name="list_items">

                    {{-- START Newsletter --}}
                    <x-sidebar.list-item
                        title='Newsletter'
                        icon='far fa-newspaper'
                        :route='$route'
                        href='newsletters.index'>
                    </x-sidebar.list-item>
                    {{-- END Newsletter --}}

                </x-slot>
            </x-sidebar.unordered-list>
            {{-- END Emails --}}

            {{-- START Site Settings --}}
            <x-sidebar.unordered-list title='Site Settings' icon='fa fa-cog' :route='$route' :routes="['configs.index', 'site_settings.faq.index', 'seo.index', 'about.index', 'apis.index']">
                {{-- Aquí se ponen los datos de los listitem que irian dentro del unordered-list --}}
                <x-slot name="list_items">
                    {{-- START SEO --}}
                    <x-sidebar.list-item title='SEO' icon='fa fa-search' :route='$route' href='seo.index'>
                    </x-sidebar.list-item>
                    {{-- START END --}}

                    {{-- START FAQ --}}
                    <x-sidebar.list-item title='FAQ' icon='fas fa-question-circle' :route='$route'
                        href='site_settings.faq.index'>
                    </x-sidebar.list-item>
                    {{-- START FAQ --}}

                    {{-- START About US --}}
                    <x-sidebar.list-item title='About Us' icon='fas fa-address-card' :route='$route'
                        href='about.index'>
                    </x-sidebar.list-item>
                    {{-- END About Us --}}

                    {{-- START API --}}
                    <x-sidebar.list-item title='Apis' icon='fas fa-key' :route='$route' href='apis.index'>
                    </x-sidebar.list-item>
                    {{-- END API --}}

                    {{-- START Settings --}}
                    <x-sidebar.list-item title='Settings' icon='fas fa-tools' :route='$route' href='configs.index'>
                    </x-sidebar.list-item>
                    {{-- END Settings --}}

                </x-slot>
            </x-sidebar.unordered-list>
            {{-- END Site Settings --}}

        </div>
        {{-- END Navigation --}}
    </div>
</nav>
