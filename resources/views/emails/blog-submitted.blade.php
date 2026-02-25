<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
<tr>
<td align="center">

<table width="600" cellpadding="0" cellspacing="0"
       style="background:#ffffff;border-radius:10px;padding:30px;">

<tr>
<td align="center">
    <h2 style="margin:0;color:#198754;">
        Blog Submitted Successfully
    </h2>
</td>
</tr>

<tr>
<td style="padding-top:20px;font-size:15px;color:#333;">
    Hello {{ $blog->user->name }},
</td>
</tr>

<tr>
<td style="padding-top:15px;font-size:15px;color:#555;">
    Your blog titled:
    <strong>"{{ $blog->title }}"</strong>
    has been successfully submitted.
</td>
</tr>

@if($blog->cover_image)
<tr>
<td style="padding-top:20px;text-align:center;">
    <img src="{{ $blog->cover_image }}"
         style="width:100%;max-height:250px;object-fit:cover;border-radius:8px;">
</td>
</tr>
@endif

<tr>
<td style="padding-top:20px;font-size:15px;color:#555;">
    Our editorial team will review your submission and it will be approved
    within <strong>3 working days</strong>.
</td>
</tr>

<tr>
<td style="padding-top:25px;font-size:14px;color:#777;">
    You will receive another email once it is approved.
</td>
</tr>

<tr>
<td style="padding-top:30px;font-size:14px;color:#aaa;text-align:center;">
    — Editorial Team
</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>