<?php
session_start();
include('/var/www/html/app/models/loginModel.php');


function showLoginForm() {
    include('/var/www/html/app/views/login/login.php');

}

function processLogin($conn) {
    $emailOrNim = $_POST['emailNim'];
    $password = $_POST['password'];

    if (filter_var($emailOrNim, FILTER_VALIDATE_EMAIL)) {
        $user = getUserByEmail($emailOrNim, $conn);
    } else {
        $user = getUserByNIM($emailOrNim, $conn);
    }

    if ($user && password_verify($password, $user['Kata_Sandi'])) {
        $_SESSION['user_id'] = $user['ID_Pengguna'];
        $_SESSION['role'] = $user['Nama_Peran'];
        header("Location: index.php?action=home");
        exit;
    } else {
        // Simpan pesan error ke sesi
        $_SESSION['login_error'] = "Login gagal. Periksa kembali email dan password Anda.";
        header("Location: index.php?action=showLoginForm"); // Asumsi Anda memiliki route untuk menampilkan login form
        exit;
    }
}




?>
