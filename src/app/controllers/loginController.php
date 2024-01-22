<?php
session_start();
include('/var/www/html/app/models/loginModel.php');



function showLoginForm() {
    include('/var/www/html/app/views/login/login.php');

}

function processLogin($emailOrNim, $password, $conn) {
    // Validasi input
    if (filter_var($emailOrNim, FILTER_VALIDATE_EMAIL)) {
        // Jika input adalah email yang valid
        $user = getUserByEmail($emailOrNim, $conn);
    } else {
        // Jika input bukan email, anggap sebagai NIM
        $user = getUserByNIM($emailOrNim, $conn);
    }

    if ($user && password_verify($password, $user['Kata_Sandi'])) {
        // Successful login
        $_SESSION['user_id'] = $user['ID_Pengguna'];
        $_SESSION['role'] = $user['Nama_Peran'];
        // Redirect ke halaman home
        header("Location: index.php?action=home");
        exit;
    } else {
        // Login failed
        echo "Login gagal. Periksa kembali email dan password Anda.";
    }
}




?>
