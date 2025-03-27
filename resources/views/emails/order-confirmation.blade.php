<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Order #{{ $order->id }}</title>
    <style>
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

        td,
        th {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        .items-table th {
            background-color: #f1f3f5;
            font-weight: bold;
            text-align: left;
        }

        .total-row td {
            font-weight: bold;
            background-color: #e9ecef;
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

        .admin-section {
            border: 2px dashed #FF4444;
            background-color: #FFECEC;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Order Confirmation #{{ $order->id }}</h1>
            <p>Thank you for your order!</p>
        </div>

        <div class="content">
            <div class="greeting">
                <p>Dear {{ $isAdmin ? 'Admin' : ($customer->name ?? 'Valued Customer') }},</p>
                <p>{{ $isAdmin ? 'A new order has been placed. Review the details below:' : 'We’ve received your order and it’s being processed.' }}
                </p>
            </div>

            <div class="section">
                <div class="section-title">Order Summary</div>
                <table class="items-table">
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                    @foreach($order->order_items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="3">Grand Total</td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <div class="section-title">Customer Details</div>
                <table>
                    <tr>
                        <td><b>Name:</b></td>
                        <td>{{ $customer->name ?? 'Not provided' }}</td>
                    </tr>
                    <tr>
                        <td><b>Email:</b></td>
                        <td>{{ $customer->email ?? 'Not provided' }}</td>
                    </tr>
                    <tr>
                        <td><b>Order Date:</b></td>
                        <td>{{ $order->created_at->format('F j, Y') }}</td>
                    </tr>
                    @if($order->customer->address)
                        <tr>
                            <td><b>Address:</b></td>
                            <td>{{ $order->customer->address->first()->city ?? 'Not provided' }}</td>
                        </tr>
                    @endif
                </table>
            </div>

            @if($isAdmin)
                <div class="admin-section">
                    <div class="section-title">Admin Notes</div>
                    <table>
                        <tr>
                            <td><b>Order Status:</b></td>
                            <td>{{ $order->status }}</td>
                        </tr>
                        <tr>
                            <td><b>Payment Method:</b></td>
                            <td>{{ $order->payment->payment_method ?? 'Not specified' }}</td>
                        </tr>
                    </table>
                </div>
            @endif

            @if(!$isAdmin)
                <div class="button-container">
                    <a href="{{ url('/checkout-confimation') }}" class="button">View Order</a>
                </div>
            @endif
        </div>

        <div class="footer">
            <p>Thanks for {{ $isAdmin ? 'managing' : 'ordering with' }} us!</p>
            <p>© {{ now()->year }} Your Company. All rights reserved.</p>
            <p>Need help? Contact us at <a href="mailto:support@yourcompany.com"
                    style="color: #007bff;">support@yourcompany.com</a></p>
        </div>
    </div>
</body>

</html>