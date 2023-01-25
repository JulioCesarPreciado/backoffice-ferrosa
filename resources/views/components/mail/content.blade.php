<table class="col-600" width="700" border="0" align="center" cellpadding="0" cellspacing="0"
    style="margin-left:20px; margin-right:20px; border-left: 1px solid #dbd9d9; border-right: 1px solid #dbd9d9;">
    <tbody>
        <tr>
            <td height="35"></td>
        </tr>

        {{-- START CONTENT --}}
        @if ($type == 'image')
            <tr>
                <td style="text-align:center;">
                    <img src="{{ $content }}" width="700">
                </td>
            </tr>
        @endif
        {{-- END CONTENT --}}

        <tr>
            <td height="35"></td>
        </tr>
    </tbody>
</table>
