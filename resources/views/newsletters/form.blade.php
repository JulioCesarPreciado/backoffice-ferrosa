@include('layouts.alert')
{{-- START form inputs --}}
<div class="flex flex-wrap mt-6">
    <div class="w-full px-4">
        {{-- START input title --}}
        <x-input.text
            id='title'
            name='title'
            title='Title'
            :value='($create)?null:$item->title'
            :required=true
            :create='$create'
            :show='$show'
            :edit='$edit'
        />
        {{-- END input title --}}
    </div>

    <div class="w-full lg:w-12/12 px-4 mb-4">
        {{-- START input content --}}
        <x-input.file
            id='content'
            name='content'
            title='Content'
            :value='($create)?null:$item->content'
            :required=true
            accept='.jpg, .jpeg, .png'
            :create='$create'
            :show='$show'
            :edit='$edit'
        />
        {{-- END input content --}}
    </div>

    <div class="w-full px-4">
        {{-- START input validity --}}
        <x-input.checkbox
            id='validity'
            name='validity'
            title='{{ __("Validity") }}'
            :value='($create)?true:$item->validity'
            :required=true
            :create='$create'
            :show='$show'
            :edit='$edit'
        />
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
                :edit='$edit'
            />
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
                :edit='$edit'
            />
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
                :edit='$edit'
            />
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
                :edit='$edit'
            />
        </div>
        {{-- END input updated at --}}
    </div>
</div>
@endif
{{-- END show updated and created info --}}

{{-- START section send mail --}}
@if ($show)
<div class="flex flex-wrap mt-6">
    <div class="w-full md:w-1/2 px-4">
        {{-- div empty --}}
    </div>

    <div class="w-full md:w-1/2 px-4">
        {{-- START button send newsletter --}}
        <x-button-link
            title="{{ __('Send email') }}"
            color="yellow-500"
            id="button_send_email"
            name="button_send_email"
            href="{{ route('newsletter.send', $item->id) }}"
            :disabled='($item->status == "ENVIADO")?true:false'
        />
        {{-- END button send newsletter --}}
    </div>
</div>
@endif
{{-- END section send mail --}}

{{-- START buttons return, submit, edit --}}
<div class="flex flex-wrap mt-6">
    <div class="w-full md:w-1/2 px-4 py-4">
        {{-- START button return --}}
        <x-button-link
            title="{{ __('Return') }}"
            color="blue-500"
            id="button_return"
            name="button_return"
            href="{{ route('newsletters.index') }}"
        />
        {{-- END button return --}}
    </div>

    @if (!$show)
        <div class="w-full md:w-1/2 px-4 py-4">
            {{-- START button submit --}}
            <x-button-submit
                title="{{ __('Save') }}"
                color="green"
                id="button_submit"
                name="button_submit"
            />
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
                href="{{ route('newsletter.edit', $item) }}"
            />
            {{-- END button edit --}}
        </div>
    @endif
</div>
{{-- END buttons return, submit, edit --}}
