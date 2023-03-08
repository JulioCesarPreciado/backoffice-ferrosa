<div class="w-full px-4">
    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-slate-100 border-0">
        <form method="POST" action="{{ route('update.contact') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="rounded-t bg-white mb-0 px-6 py-6">
                <div class="text-center flex justify-between">
                    <h6 class="text-slate-700 text-xl font-bold">
                        <div
                            class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-{{ $setting->color }}-700">
                            <i class="fas fa-building"></i>
                        </div>
                        {{ __('Company Data') }}
                    </h6>
                    <div class="flex justify-end">
                        <button
                            class="bg-{{ $setting->color }}-700 text-white active:bg-{{ $setting->color }}-700 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md hover:bg-{{ $setting->color }}-300 outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 w-full"
                            type="submit">
                            {{ __('Update') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                @include('layouts.alert')
                <div class=" mt-6 grid">
                    <div class="relative w-full mb-3">
                        <label class="block uppercase text-slate-600 text-xs font-bold mb-2  " htmlFor="grid-password">
                            {{ __('Company Name') }}
                        </label>
                        <input id="company_name" name="company_name" type="text"
                            class="caret-pink-4500  border-0  py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                            placeholder="{{ __('Company Name') }}" required value="{{ $contact->company_name }}" />
                    </div>
                    <div class="relative w-full mb-3">
                        <label class="block uppercase text-slate-600 text-xs font-bold mb-2" htmlFor="grid-password">
                            {{ __('Company Address') }}
                        </label>
                        <input id="address" name="address" type="text"
                            class="caret-pink-4500  border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                            required value="{{ $contact->address }}" placeholder="{{ __('Company Address') }}" />
                    </div>
                    <div class="relative w-full mb-3">
                        <label class="block uppercase text-slate-600 text-xs font-bold mb-2" htmlFor="grid-password">
                            {{ __('Phone') }}
                        </label>
                        <input id="phone" name="phone" type="text"
                            class="caret-pink-4500  border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                            required value="{{ $contact->phone }}" placeholder="{{ __('Phone') }}" />
                    </div>
                    <div class="relative w-full mb-3">
                        <label class="block uppercase text-slate-600 text-xs font-bold mb-2" htmlFor="grid-password">
                            {{ __('Email Address') }}
                        </label>
                        <input id="email" name="email" type="text"
                            class="caret-pink-4500  border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                            required value="{{ $contact->email }}" placeholder="{{ __('Email Adress') }}" />
                    </div>
                    <div class="relative w-full mb-3">
                        <label class="block uppercase text-slate-600 text-xs font-bold mb-2" htmlFor="grid-password">
                            {{ __('Working hours') }}
                        </label>
                        <input id="working_hours" name="working_hours" type="text"
                            class="caret-pink-4500  border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                            value="{{ $contact->working_hours }}" placeholder="{{ __('Working hours') }}" />
                    </div>
                    <div class="relative w-full mb-3">
                        <label class="block uppercase text-slate-600 text-xs font-bold mb-2" htmlFor="grid-password">
                            {{ __('Facebook') }}
                        </label>
                        <input id="face" name="facebook" type="text"
                            class="caret-pink-4500  border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                            value="{{ $contact->facebook }}" placeholder="{{ __('Facebook') }}" />
                    </div>
                    <div class="relative w-full mb-3">
                        <label class="block uppercase text-slate-600 text-xs font-bold mb-2" htmlFor="grid-password">
                            {{ __('Twitter') }}
                        </label>
                        <input id="twitter" name="twitter" type="text"
                            class="caret-pink-4500  border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                            value="{{ $contact->twitter }}" placeholder="{{ __('Twitter') }}" />
                    </div>
                    <div class="relative w-full mb-3">
                        <label class="block uppercase text-slate-600 text-xs font-bold mb-2" htmlFor="grid-password">
                            {{ __('Linkedin') }}
                        </label>
                        <input id="linkedin" name="linkedin" type="text"
                            class="caret-pink-4500  border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                            value="{{ $contact->linkedin }}" placeholder="{{ __('Linkedin') }}" />
                    </div>
                    <div class="relative w-full mb-3">
                        <label class="block uppercase text-slate-600 text-xs font-bold mb-2" htmlFor="grid-password">
                            {{ __('Youtube') }}
                        </label>
                        <input id="youtube" name="youtube" type="text"
                            class="caret-pink-4500  border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                            value="{{ $contact->youtube }}" placeholder="{{ __('Youtube') }}" />
                    </div>
                    <div class="relative w-full mb-3">
                        <label class="block uppercase text-slate-600 text-xs font-bold mb-2" htmlFor="grid-password">
                            {{ __('Instagram') }}
                        </label>
                        <input id="instagram" name="instagram" type="text"
                            class="caret-pink-4500  border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                            value="{{ $contact->instagram }}" placeholder="{{ __('Instagram') }}" />
                    </div>
                    <div class="relative w-full mb-3">
                        <label class="block uppercase text-slate-600 text-xs font-bold mb-2" htmlFor="grid-password">
                            {{ __('Pinterest') }}
                        </label>
                        <input id="Pinterest" name="pinterest" type="text"
                            class="caret-pink-4500  border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                            value="{{ $contact->pinterest }}" placeholder="{{ __('Pinterest') }}" />
                    </div>
                    <div class="relative w-full mb-3">
                        <label class="block uppercase text-slate-600 text-xs font-bold mb-2" htmlFor="grid-password">
                            {{ __('Tiktok') }}
                        </label>
                        <input id="tiktok" name="tiktok" type="text"
                            class="caret-pink-4500  border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                            value="{{ $contact->tiktok }}" placeholder="{{ __('Tiktok') }}" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
