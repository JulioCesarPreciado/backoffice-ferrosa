<nav
    class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
    <div class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
        <a class="text-white text-sm uppercase hidden lg:inline-block font-semibold" href="#">@yield('header')</a>
        {{-- START user options --}}
        <ul class="flex-col md:flex-row list-none items-center hidden md:flex">
            <a class="text-blueGray-500 block" href="#" onclick="openDropdown(event,'user-dropdown')">
                <div class="items-center flex">
                    <span
                        class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full"><img
                            alt="..." class="w-full rounded-full align-middle border-none shadow-lg"
                            src="{{ Auth::user()->profile_photo_url ?? asset('public/img/user.png') }}" /></span>
                </div>
            </a>
            <div class="hidden bg-white text-base text-center z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                id="user-dropdown">
                <a href="{{ route('profile.show') }}"
                    class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:text-slate-500"><i
                        class="fas fa-user"></i> {{ __('Profile') }}</a>
                {{--<a href="{{ route('configs.index') }}"--}}
                <a href="{{ route('configs.index') }}"
                    class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:text-slate-500"><i
                        class="fas fa-tools"></i> {{ __('Settings') }}</a>
                <div class="h-0 my-2 border border-solid border-slate-100"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" @click.prevent="$root.submit();"
                        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:text-red-500">
                        <i class="fas fa-sign-out-alt"></i>{{ __('Sign Out') }}
                    </button>
                </form>
            </div>
        </ul>
        {{-- START user options --}}
    </div>
</nav>
