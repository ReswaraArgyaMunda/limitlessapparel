<?php
session_start();

if (!isset($_POST['product-id'])) {
    header('Location: index.php');
    exit; // Menghentikan eksekusi script setelah redirect
} else {
    // Konfigurasi database

    $username_sess = isset($_SESSION['session-username']) ? $_SESSION['session-username'] : $_POST['username-session'];

    $product_id = $_POST['product-id'];
    $size = $_POST['size-option'];
    $sex = $_POST['sex-option'];
    $color = $_POST['color-option'];
    $quantity = $_POST['product-qty'];


    $id_keranjang = "0";
    $rand_char = "0123456789";

    require '../function/connect.php';

    echo $username_sess;

    $result = $conn->query("SELECT id FROM users WHERE username = '$username_sess'");
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username_id = $row['id'];
    } else {
        // Handle jika tidak ada hasil yang ditemukan
        $username_id = null;
    }

    // Cek jika user sebelumnya telah menambahkan produk, jika YA increment jumlahnya
    if ($conn->query("SELECT * FROM cart WHERE product_id = '$product_id' AND user_id = '$username_id'")->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + 1 WHERE product_id = ? AND user_id = ?");
        $stmt->bind_param("ss", $product_id, $username_id);
    } else {
        do {
            $id_keranjang = ""; // Reset nilai id_keranjang sebelum loop
            for ($i = 0; $i < 6; $i++) {
                $id_keranjang .= $rand_char[rand(0, strlen($rand_char) - 1)];
            }
            $sql = "SELECT id FROM cart WHERE id = '$id_keranjang'";
        } while (($conn->query($sql))->num_rows >= 1);

        $stmt = $conn->prepare("INSERT INTO cart (id, user_id, product_id, size, sex, color, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $id_keranjang, $username_id, $product_id, $size, $sex, $color, $quantity);
    }

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
?>
