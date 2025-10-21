<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment - TeeShop</title>
    <link rel="stylesheet" href="payment.css">
    <style>
        /* Optional: extra styling for buttons */
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

    /* Button styles */
button, .decline-btn {
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    transition: 0.3s;
    width: 100%; /* make buttons full width for alignment */
    box-sizing: border-box;
}

/* Pay Now button */
button[type="submit"] {
    background-color: #27ae60;
    color: white;
    margin-bottom: 10px; /* space between buttons */
}

button[type="submit"]:hover {
    background-color: #219150;
}

/* Decline Order button */
.decline-btn {
    background-color: #e74c3c;
    color: white;
    text-decoration: none;
    display: block; /* stack vertically */
    text-align: center;
}

.decline-btn:hover {
    background-color: #c0392b;
}

/* Button container (stacked layout) */
.btn-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 20px;
    width: 100%;
}

    </style>
</head>
<body>
    <header>
        <h1>Payment</h1>
    </header>

    <section class="payment-box">
        <h2>Complete Your Purchase</h2>
        <p id="productInfo"></p>

        <form action="payment_process.php" method="POST">
            <input type="hidden" name="product" id="productInput">
            <input type="hidden" name="price" id="priceInput">

            <label for="paymentMethod">Select Payment Method:</label><br>
            <select id="paymentMethod" name="paymentMethod" required>
                <option value="">-- Choose Payment Method --</option>
                <option value="card">Credit/Debit Card</option>
                <option value="gcash">GCash</option>
                <option value="paymaya">PayMaya</option>
            </select>
            <br><br>

            <!-- CARD PAYMENT FIELDS -->
            <div id="cardFields" class="payment-section" style="display: none;">
                <label for="cardName">Name on Card:</label><br>
                <input type="text" id="cardName" name="cardName"><br><br>

                <label for="cardNumber">Card Number:</label><br>
                <input type="text" id="cardNumber" name="cardNumber"><br><br>

                <label for="expDate">Expiry Date:</label><br>
                <input type="text" id="expDate" name="expDate" placeholder="MM/YY"><br><br>

                <label for="cvv">CVV:</label><br>
                <input type="text" id="cvv" name="cvv"><br><br>
            </div>

            <!-- GCASH PAYMENT FIELDS -->
            <div id="gcashFields" class="payment-section" style="display: none;">
                <label for="gcashNumber">GCash Mobile Number:</label><br>
                <input type="text" id="gcashNumber" name="gcashNumber" placeholder="09XXXXXXXXX"><br><br>
            </div>

            <!-- PAYMAYA PAYMENT FIELDS -->
            <div id="paymayaFields" class="payment-section" style="display: none;">
                <label for="paymayaNumber">PayMaya Mobile Number:</label><br>
                <input type="text" id="paymayaNumber" name="paymayaNumber" placeholder="09XXXXXXXXX"><br><br>
            </div>

            <!-- Button container -->
            <div class="btn-container">
                <button type="submit">Pay Now</button>
                <a href="index.html" class="decline-btn">Decline Order</a>
            </div>
        </form>
    </section>

    <script>
        // Get product and price from URL
        const params = new URLSearchParams(window.location.search);
        const product = params.get('product');
        const price = params.get('price');

        // Display product info
        document.getElementById('productInfo').innerText = `You are purchasing: ${product} - $${price}`;
        document.getElementById('productInput').value = product;
        document.getElementById('priceInput').value = price;

        // Payment method toggle logic
        const paymentMethod = document.getElementById('paymentMethod');
        const cardFields = document.getElementById('cardFields');
        const gcashFields = document.getElementById('gcashFields');
        const paymayaFields = document.getElementById('paymayaFields');

        paymentMethod.addEventListener('change', () => {
            // Hide all first
            cardFields.style.display = 'none';
            gcashFields.style.display = 'none';
            paymayaFields.style.display = 'none';

            // Show selected
            if (paymentMethod.value === 'card') {
                cardFields.style.display = 'block';
            } else if (paymentMethod.value === 'gcash') {
                gcashFields.style.display = 'block';
            } else if (paymentMethod.value === 'paymaya') {
                paymayaFields.style.display = 'block';
            }
        });
    </script>
</body>
</html>
