<div class="w-full px-4">
    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-slate-100 border-0">
        <form method="POST" action="{{ route('configs.update.site_settings') }}" enctype="multipart/form-data"
            autocomplete="off">
            @csrf

            <div class="rounded-t bg-white mb-0 px-2 py-6">
                <div class="text-center flex justify-between">
                    <h6 class="text-slate-700 text-xl font-bold">
                        <div
                            class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-700">
                            <i class="fas fa-tools"></i>
                        </div>
                        {{ __('Site settings') }}
                    </h6>
                    <button
                        class="bg-green-500 text-white active:bg-green-800 hover:bg-green-600 hover:shadow-xl font-bold uppercase text-xs px-4 py-2 rounded shadow outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                        type="submit">
                        {{ __('Update') }}
                    </button>
                </div>
            </div>

            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">

                <div class="flex flex-wrap mt-6">

                    <div class="w-full px-4 mb-4">
                        <div class="relative w-full mb-3">
                            <label class="block uppercase text-slate-600 text-xs font-bold mb-2"
                                htmlFor="grid-password">
                                {{ __('Name of site') }}
                            </label>
                            <input id="name" name="name" type="text"
                                class="caret-pink-4500  border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                required value="{{ $configs->name }}" placeholder="{{ __('Name of site') }}" />
                        </div>
                    </div>

                    <div class="w-full lg:w-4/12 px-4 mb-4">
                        <div class="relative w-full mb-3">
                            <label class="block uppercase text-slate-600 text-xs font-bold mb-2"
                                htmlFor="grid-password">
                                {{ __('Site logo') }}
                            </label>
                            <img id="logo" name="logo" style="height: 100px;" class="mb-2 object-cover"
                                @if (!$configs->logo) src="{{ asset('img/no_image.jpg') }}"
                                @else
                                src="{{ $configs->logo }}" @endif>

                            <input type="file" id="logo_path" name="logo_path" onchange="showMyImage(this,'logo')"
                                class="border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                        </div>
                    </div>

                    <div class="w-full lg:w-4/12 px-4 mb-4">
                        <div class="relative w-full mb-3">
                            <label class="block uppercase text-slate-600 text-xs font-bold mb-2"
                                htmlFor="grid-password">
                                {{ __('Site icon') }}
                            </label>
                            <img id="icon" name="icon" style="height: 32px;" class="mb-2"
                                @if (!$configs->icon) src="{{ asset('img/no_image.jpg') }}"
                                @else
                                src="{{ $configs->icon }}" @endif>
                            <input type="file" id="icon_path" name="icon_path" onchange="showMyImage(this,'icon')"
                                class="border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                        </div>
                    </div>

                    <div class="w-full lg:w-4/12 px-4 mb-4">
                        <div class="relative w-full mb-3">
                            <label class="block uppercase text-slate-600 text-xs font-bold mb-2"
                                htmlFor="grid-password">
                                {{ __('Site background') }}
                            </label>
                            <img id="background" name="background" style="height: 100px;" class="mb-2"
                                @if (!$configs->background) src="{{ asset('img/no_image.jpg') }}"
                                @else
                                src=" {{ $configs->background }}" @endif>
                            <input type="file" id="background_path" name="background_path"
                                onchange="showMyImage(this,'background')"
                                class="border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                        </div>
                    </div>


                    <div class="w-full lg:w-4/12 px-4 mb-4">
                        <div class="relative w-full mb-3">

                            {{ __('Color') }}
                            <div class="flex justify-center">
                                <div class="mb-3 w-full">
                                    <select
                                        class="form-select appearance-none
                                  block
                                  w-full
                                  px-3
                                  py-1.5
                                  text-base
                                  font-normal
                                  text-gray-700
                                  bg-white bg-clip-padding bg-no-repeat
                                  border border-solid border-gray-300
                                  rounded
                                  transition
                                  ease-in-out
                                  m-0
                                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        aria-label="Default select example" id="color" name="color">

                                        <!--  <option selected> </option> -->

                                        @php
                                            $colores = ['red', 'blue', 'green', 'pink', 'purple', 'gray', 'yellow'];
                                        @endphp

                                        @foreach ($colores as $items)
                                            @if ($configs->color == $items)
                                                <option selected value='{{ $items }}'>{{ __($items) }}
                                                </option>
                                            @else
                                                <option value='{{ $items }}'>{{ __($items) }}</option>
                                            @endif
                                        @endforeach



                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full lg:w-4/12 px-4 mb-4">
                        <div class="relative w-full mb-3">

                            {{ __('Shades') }}
                            <div class="flex justify-center">
                                <div class="mb-3 w-full">
                                    <select
                                        class="form-select appearance-none
                                  block
                                  w-full
                                  px-3
                                  py-1.5
                                  text-base
                                  font-normal
                                  text-gray-700
                                  bg-white bg-clip-padding bg-no-repeat
                                  border border-solid border-gray-300
                                  rounded
                                  transition
                                  ease-in-out
                                  m-0
                                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        aria-label="Default select example" id="shade" name="shade">

                                        @php
                                            $tonos = ['100', '300', '500', '700', '900'];
                                        @endphp

                                        @foreach ($tonos as $items)
                                            @if ($configs->shade == $items)
                                                <option selected value='{{ $items }}'>{{ $items }}
                                                </option>
                                            @else
                                                <option value='{{ $items }}'>{{ $items }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
