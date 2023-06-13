<?php


$host_db    = "sql309.infinityfree.com";
$user_db    = "if0_34418108";
$pass_db    = "9tYAachS1v";
$nama_db    = "if0_34418108_limitless_db";
$koneksi    = mysqli_connect($host_db, $user_db, $pass_db, $nama_db);
$conn       = mysqli_connect($host_db, $user_db, $pass_db, $nama_db);


if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

?>
