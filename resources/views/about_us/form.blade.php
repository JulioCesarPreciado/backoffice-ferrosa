{{-- START form inputs --}}
<div class="flex flex-wrap mt-6">
    <div class="w-full px-4">
        {{-- START input TITLE --}}
        <x-input.text id='title' name='title' title='Title' :value='$create ? null : $item->title' :required=true :create='$create'
            :show='$show' :edit='$edit'>
        </x-input.text>
        {{-- END input TITLE --}}

        {{-- START input HISTORY --}}
        <x-input.text-area id='history' name='history' title='History' :value='$create ? null : $item->history' cols='4' rows='4'
            :required=true :create='$create' :show='$show' :edit='$edit' :maxlength=300>
        </x-input.text-area>
        {{-- END input HISTORY --}}
        {{-- START input thumbnail --}}
        <x-input.image id='image' name='image' title='Image' :value='$create ? null : $item->image' :required=false
            :create='$create' :show='$show' :edit='$edit'>
        </x-input.image>
        {{-- END input thumbnail --}}
        {{-- START input SLOGAN --}}
        <x-input.text id='slogan' name='slogan' title='Slogan' :value='$create ? null : $item->slogan' :required=false :create='$create'
            :show='$show' :edit='$edit'>
        </x-input.text>
        {{-- END input SLOGAN --}}
        {{-- START input CEO --}}
        <x-input.text id='ceo' name='ceo' title='Ceo' :value='$create ? null : $item->ceo' cols='4' rows='4'
            :required=false :create='$create' :show='$show' :edit='$edit'>
        </x-input.text>
        {{-- END input CEO --}}
        {{-- START input MISSION --}}
        <x-input.text id='mission' name='mission' title='Mission' :value='$create ? null : $item->mission' cols='4' rows='4'
            :required=false :create='$create' :show='$show' :edit='$edit'>
        </x-input.text>
        {{-- END input CEO --}} {{-- START input VISION --}}
        <x-input.text id='vision' name='vision' title='Vision' :value='$create ? null : $item->vision' cols='4' rows='4'
            :required=false :create='$create' :show='$show' :edit='$edit'>
        </x-input.text>
        {{-- END input CEO --}}
        {{-- START input YOUTUBE --}}
        <x-input.text id='link_video' name='link_video' title='video' :value='$create ? null : $item->link_video' cols='4' rows='4'
            :required=false :create='$create' :show='$show' :edit='$edit'>
        </x-input.text>
        {{-- END input YOUTUBE --}}
    </div>

</div>
{{-- END form inputs --}}

{{-- START button submit --}}
<div class="flex flex-wrap mt-6">
    <div class="w-full md:w-1/2 px-4">
        {{-- START button submit --}}
        <x-button-submit title="{{ __('Save') }}" color="green" id="button_submit" name="button_submit">
        </x-button-submit>
        {{-- END button submit --}}
    </div>
</div>
{{-- END buttons return, submit, edit --}}
