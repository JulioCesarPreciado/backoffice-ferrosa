{{-- START form inputs --}}
<div class="flex flex-wrap mt-6">
    <div class="w-full px-4">
        {{-- START input meta_author --}}
        <x-input.text
            id='meta_author'
            name='meta_author'
            title='Meta author'
            :value='($create)?null:$item->meta_author'
            :required=true
            :create='$create'
            :show='$show'
            :edit='$edit'>
        </x-input.text>
        {{-- END input meta_author --}}

        {{-- START input meta_keyword --}}
        <x-input.text
            id='meta_keyword'
            name='meta_keyword'
            title='Meta Keyword'
            :value='($create)?null:$item->meta_keyword'
            :required=true
            :create='$create'
            :show='$show'
            :edit='$edit'>
        </x-input.text>
        {{-- END input meta_keyword --}}

        {{-- START input meta_description --}}
        <x-input.text-area
            id='meta_description'
            name='meta_description'
            title='Meta Description'
            :value='($create)?null:$item->meta_description'
            cols='4'
            rows='4'
            :required=true
            :create='$create'
            :show='$show'
            :edit='$edit'>
        </x-input.text-area>
        {{-- END input meta_description --}}

        {{-- START input google_analytics --}}
        <x-input.text-area
            id='google_analytics'
            name='google_analytics'
            title='Google Analytics'
            :value='($create)?null:$item->google_analytics'
            cols='4'
            rows='4'
            :required=false
            :create='$create'
            :show='$show'
            :edit='$edit'>
        </x-input.text-area>
        {{-- END input google_analytics --}}

    </div>

</div>
{{-- END form inputs --}}

{{-- START button submit --}}
<div class="flex flex-wrap mt-6">
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
</div>
{{-- END buttons return, submit, edit --}}
