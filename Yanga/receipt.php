<?php
session_start();
include 'db_connect.php';
if (!isset($_SESSION['receipt'])) {
    echo "No payment details found.";
    exit();
}

$receipt = $_SESSION['receipt'];

$sql = "INSERT INTO payments (transactionId, product, price, paymentMethod, status, date)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdsss", 
    $receipt['transactionId'],
    $receipt['product'],
    $receipt['price'],
    $receipt['paymentMethod'],
    $receipt['status'],
    $receipt['date']
);
$stmt->execute();
$stmt->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Receipt - TeeShop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .receipt-box {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 1000px;
            text-align: center;
        }
        h2 {
            color: #27ae60;
        }
        p {
            margin: 6px 0;
        }
        .btn {
            margin-top: 20px;
            background: #27ae60;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn:hover {
            background: #219150;
        }
    </style>
</head>
<body>
    <div class="receipt-box">
        <h2>Payment Receipt</h2>
        <p><strong>Transaction ID:</strong> <?= $receipt['transactionId'] ?></p>
        <p><strong>Product:</strong> <?= htmlspecialchars($receipt['product']) ?></p>
        <p><strong>Price:</strong> $<?= htmlspecialchars($receipt['price']) ?></p>
        <p><strong>Payment Method:</strong> <?= htmlspecialchars($receipt['paymentMethod']) ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($receipt['status']) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($receipt['date']) ?></p>
        <hr>
        <p>Thank you for shopping with <b>TeeShop</b>!</p>

        <form action="index.html">
            <button class="btn">Back to Shop</button>
        </form>
    </div>
</body>
</html>
