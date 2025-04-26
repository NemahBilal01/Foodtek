<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <!-- Bootstrap CSS (used inline for better compatibility in emails) -->
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 6px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            color: #ffffff;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .footer {
            margin-top: 20px;
            font-size: 13px;
            color: #6c757d;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="text-center">Reset Your Password</h2>
        <p>Hello,</p>
        <p>We received a request to reset your password. Click the button below to proceed:</p>
        
        <p style="text-align: center;">
            <a href="{{ url('reset-password/' . $token) }}" class="btn-primary">Reset Password</a>
        </p>

        <p>If you did not request a password reset, no further action is required.</p>

        <div class="footer">
            &copy; {{ date('Y') }} Foodtek. All rights reserved.
        </div>
    </div>

</body>
</html>
