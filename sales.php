<?php
include 'includes/session.php';

if (isset($_GET['pay'])) {
    $payid = $_GET['pay'];
    $date = date('Y-m-d');
    

    $conn = $pdo->open();

    try {

        $stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date, sales_recipient, sales_address, sales_contact_info, pay_method) VALUES (:user_id, :pay_id, :sales_date, :sales_recipient, :sales_address, :sales_contact_info, :pay_method)");
        $stmt->execute([
            'user_id' => $user['id'],
            'pay_id' => $payid,
            'sales_date' => $date,
            'sales_recipient' => $_GET['buyer'],  
            'sales_address' => $_GET['address'], 
            'sales_contact_info' => $_GET['contact'], 
            'pay_method' => 'Paid via Paypal',
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
}

header('location: profile.php');
?>
