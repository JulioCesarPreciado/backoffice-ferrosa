@php
    $config = App\Models\Config::select(
        'name',
    )->first();

@endphp

<table class="col-600" width="700" border="0" align="center" cellpadding="0" cellspacing="0"
    style="margin-left:20px; margin-right:20px;">
    <tbody>
        <tr>
            <td align="center" valign="top" style="background-image: url({{ asset('public/assets/img/bg-footer.png') }}"
                style="background-size:cover; background-position:top; height="400""="">
                <table class="col-600" width="700" border="0" align="center">
                    <tbody>
                        <tr>
                            <td style="text-align:center; padding:5px;">
                                <p style="font-size:12px; padding:5px; color:#fff;">
                                    &copy;
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script>
                                    @if (isset($config->name))
                                        {{ $config->name }}
                                    @else
                                        COMPANY NAME
                                    @endif
                                    . {{ __("All rights reserved.")}}
                                </p>

                                {{-- START links --}}
                                @if (env('URL_FRONT_OFFICE', null) )
                                <p style="font-size:12px; padding:5px; color:#fff;">
                                    <a target="_blank"
                                        style="font-size:12px; padding:5px; color:#f35627; text-decoration: none;"
                                        href="{{ env('URL_FRONT_OFFICE') }}/contact"
                                        >
                                        {{ __("Contact us")}}
                                    </a>
                                    |
                                    <a target="_blank"
                                        style="font-size:12px; padding:5px; color:#f35627; text-decoration: none;"3
                                        href="{{ env('URL_FRONT_OFFICE') }}/policies_privacy"
                                        >
                                        {{ __("Policies and privacy")}}
                                    </a>
                                    |
                                    <a target="_blank"
                                        style="font-size:12px; padding:5px; color:#f35627; text-decoration: none;"
                                        href="{{ env('URL_FRONT_OFFICE') }}/newsletter/unsubscribe/form"

                                        >
                                        {{ __("Unsubscribe")}}
                                    </a>
                                </p>
                                @endif
                                {{-- END links --}}

                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
