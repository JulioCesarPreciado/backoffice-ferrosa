{{-- START form inputs --}}
<div class="flex flex-wrap mt-6">
    <div class="w-full px-4">
        {{-- START input question --}}
        <x-input.text-area
            id='question'
            name='question'
            title='Question'
            :value='($create)?null:$item->question'
            cols='4'
            rows='4'
            :required=true
            :create='$create'
            :show='$show'
            :edit='$edit'
            :maxlength=7000>
        </x-input.text-area>
        {{-- END input question --}}

        {{-- START input answer --}}
        <x-input.text-area
            id='answer'
            name='answer'
            title='Answer'
            :value='($create)?null:$item->answer'
            cols='4'
            rows='4'
            :required=true
            :create='$create'
            :show='$show'
            :edit='$edit'
            :maxlength=1000>
        </x-input.text-area>
        {{-- END input answer --}}
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
            href="{{ route('site_settings.faq.index') }}"
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
                href="{{ route('faq.edit', $item) }}"
                >
            </x-button-link>
            {{-- END button edit --}}
        </div>
    @endif
</div>
{{-- END buttons return, submit, edit --}}
