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

// editprofile
function updateUserData($conn, $userID, $namaDepan, $namaBelakang, $email, $nim) {
    // Membersihkan data input untuk mencegah SQL Injection
    $userID = mysqli_real_escape_string($conn, $userID);
    $namaDepan = mysqli_real_escape_string($conn, $namaDepan);
    $namaBelakang = mysqli_real_escape_string($conn, $namaBelakang);
    $email = mysqli_real_escape_string($conn, $email);
    $nim = mysqli_real_escape_string($conn, $nim);

    // Membuat query update
    $query = "UPDATE master_user SET Nama_Depan = '$namaDepan', Nama_Belakang = '$namaBelakang', Email = '$email', Nim = '$nim' WHERE ID_Pengguna = $userID";

    // Menjalankan query
    $result = mysqli_query($conn, $query);

    // Mengecek hasil
    if ($result) {
        return true;
    } else {
        return false;
    }
}



?>
