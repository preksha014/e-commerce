<!-- resources/views/emails/welcome.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Community</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #f8f8f8;
            padding: 40px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: #4B0082;
            padding: 20px;
            text-align: center;
            color: #ffffff;
            border-radius: 10px 10px 0 0;
        }

        .header h1 {
            color:white;
            font-size: 24px;
            font-weight: bold;
        }

        .content {
            padding: 30px;
        }

        .greeting {
            margin-bottom: 20px;
            font-size: 16px;
        }

        .section {
            margin: 25px 0;
            padding: 20px;
            border-radius: 8px;
            background-color: #fafafa;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #4B0082;
            margin-bottom: 10px;
            border-bottom: 2px solid #4B0082;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        td, th {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        .button-container {
            text-align: center;
            margin: 30px 0;
        }

        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #4B0082;
            color: #ffffff;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            font-size: 16px;
            transition: 0.3s;
        }

        .button:hover {
            background: #38006b;
        }

        .footer {
            text-align: center;
            padding: 25px;
            background-color: #f8f9fa;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Welcome, {{ $customer->name ?? 'Valued Customer' }}!</h1>
            <p>We're thrilled to have you join our community</p>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="greeting">
                <p>Dear {{ $customer->name ?? '' }},</p>
                <p>Thank you for joining us! We’re excited to have you on board. Below are your account details:</p>
            </div>

            <div class="section">
                <div class="section-title">Your Account Details</div>
                <table>
                    <tr>
                        <td><b>Full Name:</b></td>
                        <td>{{ $customer->name ?? 'Not provided' }}</td>
                    </tr>
                    <tr>
                        <td><b>Email:</b></td>
                        <td>{{ $customer->email ?? 'Not provided' }}</td>
                    </tr>
                    <tr>
                        <td><b>Join Date:</b></td>
                        <td>{{ now()->format('F j, Y') }}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <div class="section-title">Get Started</div>
                <p>Here’s what you can do next:</p>
                <ul>
                    <li>Update your profile information</li>
                    <li>Explore our services</li>
                    <li>Contact support if you need help</li>
                </ul>
            </div>

            <div class="button-container">
                <a href="{{ url('/') }}" class="button">Go to Dashboard</a>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thanks for being part of our community!</p>
            <p>© {{ now()->year }} Your Company. All rights reserved.</p>
            <p>Need help? Contact us at <a href="mailto:support@yourcompany.com" style="color: #007bff;">support@yourcompany.com</a></p>
        </div>
    </div>
</body>
</html>