<?php
// Informasi koneksi database
$host = "my-mysql";
$user = "root"; // Ganti dengan username database Anda
$password = "12345678"; // Ganti dengan password database Anda
$database = "db-coba"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = mysqli_connect($host, $user, $password, $database);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
