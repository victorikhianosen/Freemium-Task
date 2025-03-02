<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: #007bff;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            font-size: 20px;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .otp {
            font-size: 22px;
            font-weight: bold;
            color: #007bff;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Welcome to Our Platform
        </div>
        <div class="content">
            <p>Hi <strong>{{ $first_name }}</strong>,</p>
            <p>Thank you for registering with us! Your OTP is:</p>
            <p class="otp">{{ $otp }}</p>
            <p>This OTP will expire in 10 minutes.</p>
            <p>If you didn't request this, please ignore this email.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Our Platform. All rights reserved.
        </div>
    </div>
</body>
</html>
