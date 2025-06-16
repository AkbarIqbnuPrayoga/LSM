<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesan Kontak Baru</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            padding: 30px;
            margin: 0;
        }

        .email-container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 30px;
            color: #333333;
        }

        .header {
            border-bottom: 2px solid #4A90E2;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .header h2 {
            margin: 0;
            color: #4A90E2;
        }

        .info-block {
            margin-bottom: 20px;
        }

        .info-block strong {
            display: inline-block;
            width: 100px;
            color: #222222;
        }

        .message-content {
            background-color: #f9f9f9;
            padding: 15px;
            border-left: 4px solid #4A90E2;
            border-radius: 5px;
            white-space: pre-line;
        }

        .footer {
            margin-top: 30px;
            font-size: 0.9em;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>Pesan Baru dari Kontak Website</h2>
        </div>

        <div class="info-block">
            <p><strong>Nama:</strong> {{ $name }}</p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Subjek:</strong> {{ $subject }}</p>
        </div>

        <div>
            <p><strong>Pesan:</strong></p>
            <div class="message-content">
                {{ $messageContent }}
            </div>
        </div>

        <div class="footer">
            Email ini dikirim secara otomatis melalui formulir kontak situs web Anda.
        </div>
    </div>
</body>
</html>
