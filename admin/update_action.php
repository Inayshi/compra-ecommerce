




<?php
// update_action.php

include 'includes/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = $_POST['id'];
        $sales_status = $_POST['sales_status'];

        error_log("ID: " . $id . ", Status: " . $sales_status);

        $conn = $pdo->open();

        $stmt = $conn->prepare("UPDATE sales SET sales_status = :sales_status WHERE id = :id");


        $stmt->bindParam(':sales_status', $sales_status);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        error_log("Update successful");

        echo json_encode(['sales_status' => 'success']);
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());

        echo json_encode(['sales_status' => 'error', 'message' => $e->getMessage()]);
    } finally {
        $pdo->close();
    }
}

