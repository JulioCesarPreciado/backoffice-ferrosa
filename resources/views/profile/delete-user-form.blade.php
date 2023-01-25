<div class="flex flex-wrap">
    <div class="w-full px-4">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-slate-100 border-0">
            <div class="rounded-t bg-white mb-0 px-6 py-6">
                <div class="text-center flex justify-between">
                    <h6 class="text-slate-700 text-xl font-bold">
                        {{ __('Delete Account') }}
                    </h6>
                </div>
            </div>
            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                <form method="POST" action="{{ route('user.delete') }}" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    @method('POST')
                    <div class="flex flex-wrap mt-6">
                        <div class="w-full px-4 mb-4">
                            @include('layouts.alert')
                        </div>
                        <div class="w-full px-4 mb-4">
                            <p> {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}</p>
                        </div>
                        <div class="w-full px-4">
                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-slate-600 text-xs font-bold mb-2" htmlFor="password-delete">
                                    {{ __('Password') }}
                                </label>
                                <input id="password-delete" name="current_password" type="password"
                                    class="border-0 px-3 py-3 placeholder-slate-300 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                    placeholder="************************" required />
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap mt-6">
                        <div class="w-full px-4">
                            <button type="submit"
                                class="w-full bg-red-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150">
                                {{ __('Delete Account') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
