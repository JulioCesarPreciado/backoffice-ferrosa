@php
    $config = App\Models\Config::select(
        'logo',
    )->first();
@endphp

<table class="col-600" width="700" border="0" align="center" cellpadding="0" cellspacing="0"
    style="margin-left:20px; margin-right:20px;">
    <tbody>
        <tr>
            <td align="center" valign="top" style="background-image: url({{ asset('public/assets/img/bg-footer.png') }}"
                style="background-size:cover; background-position:top; height=400">
                <table class="col-600" width="700" border="0" align="center" >
                    <tbody>
                        <tr>
                            <td align="left" style="line-height: 0px; padding:5px;" width="70">
                                <a target="_blank"
                                    @if (env('URL_FRONT_OFFICE', null) )
                                        href="{{ env('URL_FRONT_OFFICE') }}"
                                    @endif>
                                    <img style="border-radius: 4px;"
                                        @if ( isset($config->logo) )
                                            src="{{ asset($config->logo ) }}"
                                        @else
                                            src="{{ asset('public/img/no_image.jpg') }}"
                                        @endif
                                        width="70" alt="logo">
                                </a>
                            </td>

                            <td align="center"
                                style="font-family: 'Raleway', sans-serif; font-size:27px; color:#ffffff; line-height:24px; font-weight: bold; letter-spacing: 7px;">
                                {{ $title }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
