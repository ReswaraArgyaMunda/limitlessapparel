<?php
session_start();

if (!isset($_GET['id-cart'])) {
    header('Location: index.php');
    exit;
} else {
    // Konfigurasi database

    $username_sess = isset($_SESSION['session-username']) ? $_SESSION['session-username'] : $_GET['username'];

    $id_cart = $_GET['id-cart'];

    require '../function/connect.php';

    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_id = (SELECT id FROM users WHERE username = ?)");
    $stmt->bind_param("ss", $id_cart, $username_sess);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header('Location: ../Web-View/cart.php');
        exit;

    } else {
        header('Location: ../Web-View/cart.php');
        exit;

    }
}
?>
