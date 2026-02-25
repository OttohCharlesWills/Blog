<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Blog Revoked</title>
</head>
<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0"
                       style="background:#ffffff;border-radius:10px;padding:40px;">

                    <tr>
                        <td style="text-align:center;">
                            <h2 style="margin:0;color:#dc3545;">
                                Blog Revoked
                            </h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-top:25px;font-size:16px;color:#333;">
                            Hello {{ $blog->user->name }},
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-top:15px;font-size:15px;color:#555;">
                            Your blog titled:
                            <strong>"{{ $blog->title }}"</strong>
                            has been revoked by the admin.
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-top:20px;">
                            <div style="background:#fff3cd;padding:15px;border-radius:6px;color:#856404;">
                                <strong>Reason:</strong><br>
                                {{ $reason }}
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-top:30px;font-size:14px;color:#777;">
                            If you believe this was a mistake, you may contact support.
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-top:30px;font-size:14px;color:#aaa;text-align:center;">
                            — Admin Team
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>