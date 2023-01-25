<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tbody>
        <!-- START HEADER -->
        <tr align="center" class="col-600" width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
            <td>
                <x-mail.header
                    :title="$title ?? 'A title'"
                />
            </td>
        </tr>
        <!-- END HEADER -->

        <!-- START CONTENT -->
        <tr>
            <td align="center">
                <x-mail.content
                    :content="$content"
                />
            </td>
        </tr>
        <!-- END CONTENT -->

        <!-- START FOOTER -->
        <tr>
            <td align="center">
                <x-mail.footer
                    :email="$email"
                />
            </td>
        </tr>
        <!-- END FOOTER -->
    </tbody>
</table>
