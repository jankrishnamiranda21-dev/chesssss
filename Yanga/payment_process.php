<?php
// payment_process.php

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $product = $_POST['product'] ?? 'Unknown Product';
    $price = $_POST['price'] ?? '0.00';
    $paymentMethod = $_POST['paymentMethod'] ?? 'Unknown';
    $cardName = $_POST['cardName'] ?? '';
    $cardNumber = $_POST['cardNumber'] ?? '';
    $gcashNumber = $_POST['gcashNumber'] ?? '';
    $paymayaNumber = $_POST['paymayaNumber'] ?? '';

    // Create a unique transaction ID
    $transactionId = 'TS' . strtoupper(uniqid());

    // Simulate payment validation (real systems would call a payment API)
    $status = "Payment Successful";

    // ✅ Insert payment record into the database
    $stmt = $conn->prepare("INSERT INTO receipt 
        (transactionId, product, price, paymentMethod, status, cardName, cardNumber, gcashNumber, paymayaNumber, date)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

    $stmt->bind_param("ssdssssss", 
        $transactionId, 
        $product, 
        $price, 
        $paymentMethod, 
        $status, 
        $cardName, 
        $cardNumber, 
        $gcashNumber, 
        $paymayaNumber
    );

    $stmt->execute();
    $stmt->close();

    // ✅ Save data into session for receipt display
    session_start();
    $_SESSION['receipt'] = [
        'transactionId' => $transactionId,
        'product' => $product,
        'price' => $price,
        'paymentMethod' => ucfirst($paymentMethod),
        'status' => $status,
        'cardName' => $cardName,
        'gcashNumber' => $gcashNumber,
        'paymayaNumber' => $paymayaNumber,
        'date' => date("F j, Y, g:i a")
    ];

    // Redirect to receipt page
    header("Location: receipt.php");
    exit();
} else {
    echo "Invalid request.";
}
?>

$conn->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $product = $_POST['product'] ?? 'Unknown Product';
    $price = $_POST['price'] ?? '0.00';
    $paymentMethod = $_POST['paymentMethod'] ?? 'Unknown';
    $cardName = $_POST['cardName'] ?? '';
    $cardNumber = $_POST['cardNumber'] ?? '';
    $gcashNumber = $_POST['gcashNumber'] ?? '';
    $paymayaNumber = $_POST['paymayaNumber'] ?? '';

    // Create a unique transaction ID
    $transactionId = 'TS' . strtoupper(uniqid());

    // Simulate payment validation (in real systems, you’d call a payment API)
    $status = "Payment Successful";

    // Save data into session for receipt display
    session_start();
    $_SESSION['receipt'] = [
        'transactionId' => $transactionId,
        'product' => $product,
        'price' => $price,
        'paymentMethod' => ucfirst($paymentMethod),
        'status' => $status,
        'cardName' => $cardName,
        'gcashNumber' => $gcashNumber,
        'paymayaNumber' => $paymayaNumber,
        'date' => date("F j, Y, g:i a")
    ];

    // Redirect to receipt page
    header("Location: receipt.php");
    exit();
} else {
    echo "Invalid request.";
}
?>
