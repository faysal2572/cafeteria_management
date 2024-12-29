<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.css')
    <style>
        .payment-container {
            max-width: 500px;
            margin: 100px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .payment-form {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .card-details {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 10px;
        }

        .submit-btn {
            background: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .submit-btn:hover {
            background: #0056b3;
        }

        .payment-header {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            padding: 20px;
            border-bottom: 2px solid #eee;
        }

        .payment-amount {
            font-size: 32px;
            color: #007bff;
            font-weight: bold;
            margin: 10px 0;
        }

        .payment-description {
            color: #666;
            font-size: 16px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="bg-dark">
    
    @include('home.navbar_header')

    <div class="payment-container">
        <div class="payment-header">
            <div class="payment-description">Total Amount to Pay</div>
            <div class="payment-amount">${{number_format($total_price, 2)}}</div>
            <div class="payment-description">Please enter your card details below</div>
        </div>

        <form action="{{ url('process_card_payment') }}" method="POST" class="payment-form">
            @csrf
            <input type="hidden" name="total_price" value="{{$total_price}}">
            
            <div class="form-group">
                <label>Card Holder Name</label>
                <input type="text" name="card_holder" required placeholder="John Doe">
            </div>

            <div class="form-group">
                <label>Card Number</label>
                <input type="text" name="card_number" maxlength="16" required placeholder="1234 5678 9012 3456">
            </div>

            <div class="card-details">
                <div class="form-group">
                    <label>Expiry Date</label>
                    <input type="text" name="expiry" placeholder="MM/YY" maxlength="5" required>
                </div>
                <div class="form-group">
                    <label>CVV</label>
                    <input type="password" name="cvv" maxlength="3" required placeholder="123">
                </div>
            </div>

            <button type="submit" class="submit-btn">Pay ${{number_format($total_price, 2)}}</button>
        </form>
    </div>

    <!-- core  -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>
</body>
</html>
