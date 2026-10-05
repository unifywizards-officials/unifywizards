<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Contact Form Submission</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f9;padding:30px 0;">
        <tr>
            <td align="center">

                <table width="650" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 2px 10px rgba(0,0,0,.08);">

                    <!-- Header -->
                    <tr>
                        <td style="background:#2d3a80;padding:25px;text-align:center;">
                            <h1 style="margin:0;color:#ffffff;font-size:24px;">
                                New Contact Form Submission
                            </h1>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:30px;">

                            <p style="font-size:16px;color:#555;">
                                A new enquiry has been submitted through the website contact form.
                            </p>

                            <table width="100%" cellpadding="12" cellspacing="0"
                                style="border-collapse:collapse;border:1px solid #e5e7eb;">

                                @foreach ($data as $key => $value)
                                    <tr>
                                        <td width="180"
                                            style="background:#f8fafc;border:1px solid #e5e7eb;font-weight:bold;color:#333;">
                                            {{ ucfirst(str_replace('_', ' ', $key)) }}
                                        </td>

                                        <td style="border:1px solid #e5e7eb;color:#555;">
                                            {{ $value }}
                                        </td>
                                    </tr>
                                @endforeach

                            </table>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f8fafc;padding:20px;text-align:center;">
                            <p style="margin:0;color:#777;font-size:13px;">
                                This email was generated automatically from your website contact form.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
