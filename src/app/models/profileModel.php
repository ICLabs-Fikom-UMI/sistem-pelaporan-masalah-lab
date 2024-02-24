<?php
// UserProfileModel.php

function updateFotoProfil($conn, $userID, $uploadPath) {
    // Membersihkan input untuk menghindari SQL Injection
    $userID = mysqli_real_escape_string($conn, $userID);
    $uploadPath = mysqli_real_escape_string($conn, $uploadPath);

    // Membuat query untuk update path foto profil
    $query = "UPDATE master_user SET Foto_Path = '$uploadPath' WHERE ID_Pengguna = $userID";

    // Menjalankan query
    $result = mysqli_query($conn, $query);

    // Mengecek apakah query berhasil dijalankan
    if ($result) {
        // Cek berapa banyak baris yang terpengaruh, jika ada yang terupdate maka kembalikan true
        if (mysqli_affected_rows($conn) > 0) {
            return true;
        } else {
            // Jika tidak ada baris yang terupdate, bisa jadi karena ID_Pengguna tidak ditemukan
            // Tergantung kebutuhan, Anda bisa memilih untuk menganggap ini sebagai sukses atau gagal
            // Untuk kasus ini, saya akan menganggapnya sebagai gagal karena tidak ada perubahan yang terjadi
            return false;
        }
    } else {
        // Jika query gagal dijalankan
        return false;
    }
}


?>
