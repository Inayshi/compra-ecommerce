<?php
include 'includes/session.php';

if (isset($_POST['pay']) && $_POST['pay'] === 'Cash on Delivery') {
    $date = date('Y-m-d');
    $buyer = $_POST['buyer'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $paymentMethod = $_POST['paymentMethod'];  // Include the payment method

    $conn = $pdo->open();

    $conn = $pdo->open();

    try {
        // Generate a random PAY ID
        $payId = 'PAYID-' . generateRandomString(32);

        $stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date, sales_recipient, sales_address, sales_contact_info, pay_method) VALUES (:user_id, :pay_id, :sales_date, :sales_recipient, :sales_address, :sales_contact_info, :pay_method)");
        $stmt->execute([
            
            'user_id' => $user['id'], 
            'pay_id' => $payId, 
            'sales_date' => $date,
            'sales_recipient' => $buyer,
            'sales_address' => $address,
            'sales_contact_info' => $contact,
            'pay_method' => $paymentMethod

        
        
        ]);
        $salesid = $conn->lastInsertId();

        try {
            $stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user_id");
            $stmt->execute(['user_id' => $user['id']]);

            foreach ($stmt as $row) {
                $stmt = $conn->prepare("INSERT INTO details (sales_id, product_id, quantity) VALUES (:sales_id, :product_id, :quantity)");
                $stmt->execute(['sales_id' => $salesid, 'product_id' => $row['product_id'], 'quantity' => $row['quantity']]);
            }

            $stmt = $conn->prepare("DELETE FROM cart WHERE user_id=:user_id");
            $stmt->execute(['user_id' => $user['id']]);

            $_SESSION['success'] = 'Transaction successful. Thank you.';
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }

    $pdo->close();

    exit;
}

header('location: profile.php');

function generateRandomString($length) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
?>
