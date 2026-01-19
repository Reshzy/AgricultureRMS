<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }

        .content {
            background: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 0 0 8px 8px;
        }

        .field {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
            color: #059669;
            display: block;
            margin-bottom: 5px;
        }

        .value {
            background: white;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #e0e0e0;
        }

        .message-content {
            min-height: 100px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            background: #e5e7eb;
            border-radius: 4px;
            font-size: 12px;
            color: #6b7280;
        }

        .btn {
            display: inline-block;
            background: #10b981;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>New Contact Message</h1>
        <p>Agriculture RMS - Department of Agriculture Claveria</p>
    </div>

    <div class="content">
        <div class="field">
            <span class="label">From:</span>
            <div class="value">{{ $contactMessage->name }}</div>
        </div>

        <div class="field">
            <span class="label">Email:</span>
            <div class="value">{{ $contactMessage->email }}</div>
        </div>

        <div class="field">
            <span class="label">Subject:</span>
            <div class="value">{{ $contactMessage->subject }}</div>
        </div>

        <div class="field">
            <span class="label">Message:</span>
            <div class="value message-content">{{ nl2br(e($contactMessage->message)) }}</div>
        </div>

        <div class="field">
            <span class="label">Received:</span>
            <div class="value">{{ $contactMessage->created_at->format('F j, Y \a\t g:i A') }}</div>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('admin.emails.show', $contactMessage) }}" class="btn">
                View in Admin Panel
            </a>
        </div>
    </div>

    <div class="footer">
        <p>This is an automated notification from the Agriculture RMS contact form.</p>
        <p>Please do not reply to this email directly.</p>
    </div>
</body>

</html>