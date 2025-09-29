<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Notification' }}</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f9fafb;
            margin: 0; padding: 0;
            color: #374151;
        }
        .container {
            max-width: 600px;
            margin: 2rem auto;
            background: #fff;
            padding: 1.5rem 2rem;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
        }
        h2 {
            color: #111827;
        }
        p {
            line-height: 1.5;
            margin: 1rem 0;
        }
        .button {
            display: inline-block;
            background-color: #6366f1;
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 1.5rem;
        }
        .footer {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 2rem;
            border-top: 1px solid #e5e7eb;
            padding-top: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hello {{ $order->user->name }},</h2>

        <p>Your order for <strong>{{ $order->product->name }}</strong> has been placed successfully.</p>

        <p><strong>Amount:</strong> ${{ number_format($order->amount_usd, 2) }} (or)  ₹{{ number_format($order->amount_inr) }} </p>
        
        <p>You can pay in INR or USDT Crypto, please visit the order page to complete the payment and download the file <a href="{{ url('/p2p/order/details/' . $order->id) }}">Open Order</a> </p>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} CK Softwares. All rights reserved.
    </div>
</body>
</html>
