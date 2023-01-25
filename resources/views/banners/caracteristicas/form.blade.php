{{-- START form inputs --}}
<div class="flex flex-wrap mt-6">
    <div class="w-full px-4">
        {{-- Alertas --}}
        @include('layouts.alert')
        {{-- START input title --}}
        <x-input.text
            id='title'
            name='title'
            title='Title'
            :value='($create)?null:$item->title'
            :required=true
            :create='$create'
            :show='$show'
            :edit='$edit'>
        </x-input.text>
        {{-- END input title --}}

        {{-- START input subtitle --}}
        <x-input.text
            id='subtitle'
            name='subtitle'
            title='Subtitle'
            :value='($create)?null:$item->subtitle'
            :required=false
            :create='$create'
            :show='$show'
            :edit='$edit'>
        </x-input.text>
        {{-- END input subtitle --}}
    </div>

    <div class="w-full lg:w-12/12 px-4 mb-4">
        {{-- START input thumbnail --}}
        <x-input.image
            id='thumbnail'
            name='thumbnail'
            title='Thumbnail'
            :value='($create)?null:$item->thumbnail'
            :required=true
            :create='$create'
            :show='$show'
            :edit='$edit'>
        </x-input.image>
        {{-- END input thumbnail --}}
    </div>

    <div class="w-full px-4">
        <div class="relative w-full mb-3">
            {{-- START input url --}}
            <x-input.url
                id='url'
                name='url'
                title='url'
                :value='($create)?null:$item->url'
                :required=false
                :create='$create'
                :show='$show'
                :edit='$edit'>
            </x-input.url>
            {{-- END input url --}}
        </div>
    </div>

    <div class="w-full px-4">
        {{-- START input validity --}}
        <x-input.checkbox
            id='validity'
            name='validity'
            title='validity'
            :value='($create)?true:$item->validity'
            :required=true
            :create='$create'
            :show='$show'
            :edit='$edit'>
        </x-input.checkbox>
        {{-- END input validity --}}
    </div>
</div>
{{-- END form inputs --}}

    {{-- START show updated and created info --}}
@if ($show)
<div class="flex flex-wrap mt-6">
    <div class="w-full md:w-1/2 px-4">
        {{-- START input created by --}}
        <div class="relative w-full mb-3">
            <x-input.text
                title='Created by'
                :value='($create)?null:$item->created_by'
                :readonly=true
                :create='$create'
                :show='$show'
                :edit='$edit'>
            </x-input.text>
        </div>
        {{-- END input created by --}}

        {{-- START input updated by --}}
        <div class="relative w-full mb-3">
            <x-input.text
                title='Updated by'
                :value='($create)?null:$item->updated_by'
                :readonly=true
                :create='$create'
                :show='$show'
                :edit='$edit'>
            </x-input.text>
        </div>
        {{-- END input updated by --}}
    </div>

    <div class="w-full md:w-1/2 px-4">
        {{-- START input created at --}}
        <div class="relative w-full mb-3">
            <x-input.text
                title='Created at'
                :value='($create)?null:$item->created_at'
                :readonly=true
                :create='$create'
                :show='$show'
                :edit='$edit'>
            </x-input.text>
        </div>
        {{-- END input created at --}}

        {{-- START input updated at --}}
        <div class="relative w-full mb-3">
            <x-input.text
                title='Updated at'
                :value='($create)?null:$item->updated_at'
                :readonly=true
                :create='$create'
                :show='$show'
                :edit='$edit'>
            </x-input.text>
        </div>
        {{-- END input updated at --}}
    </div>
</div>
@endif
{{-- END show updated and created info --}}

{{-- START buttons return, submit, edit --}}
<div class="flex flex-wrap mt-6">
    <div class="w-full md:w-1/2 px-4">
        {{-- START button return --}}
        <x-button-link
            title="{{ __('Return') }}"
            color="blue-500"
            id="button_return"
            name="button_return"
            href="{{ route('banners', 'caracteristicas') }}"
            >
        </x-button-link>
        {{-- END button return --}}
    </div>

    @if (!$show)
        <div class="w-full md:w-1/2 px-4">
            {{-- START button submit --}}
            <x-button-submit
                title="{{ __('Save') }}"
                color="green"
                id="button_submit"
                name="button_submit"
                >
            </x-button-submit>
            {{-- END button submit --}}
        </div>
    @else
        <div class="w-full md:w-1/2 px-4">
            {{-- START button edit --}}
            <x-button-link
                title="{{ __('Edit') }}"
                color="pink-500"
                id="button_edit"
                name="button_edit"
                href="{{ route('banner.edit', $item) }}"
                >
            </x-button-link>
            {{-- END button edit --}}
        </div>
    @endif
</div>
{{-- END buttons return, submit, edit --}}
