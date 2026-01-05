<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Lead Created</title>
</head>
<body style="font-family: Arial; background:#f5f5f5; padding:20px">

<div style="max-width:600px; background:#ffffff; padding:20px; margin:auto">

    <!-- Header -->
    <h2 style="color:#333;">LeadBridge</h2>

    <!-- Content -->
    <p>Hello {{ $lead->name }},</p>

    <p>A new lead has been created with the following details:</p>

    <ul>
        <li><strong>Name:</strong> {{ $lead->name }}</li>
        <li><strong>Email:</strong> {{ $lead->email }}</li>
        <li><strong>Source:</strong> {{ $lead->source }}</li>
    </ul>

    <p>Please login to LeadBridge to follow up on this lead.</p>

    <!-- Footer -->
    <hr>
    <p style="font-size:12px; color:#999;">
        © {{ date('Y') }} LeadBridge SaaS. All rights reserved.
    </p>

</div>

</body>
</html>
