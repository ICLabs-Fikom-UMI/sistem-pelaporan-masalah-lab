<?php
function getDataPengguna($conn) {
    $userId = $_SESSION['user_id']; // Ambil user_id dari session

    // SQL query to join the master_user and master_roles tables
    // Kecualikan pengguna yang sedang login
    $sql = "SELECT master_user.ID_Pengguna, master_user.Nama_Depan, master_user.Nama_Belakang, master_roles.Nama_Peran
            FROM master_user
            INNER JOIN master_roles ON master_user.ID_Peran = master_roles.ID_Peran
            WHERE master_user.ID_Pengguna != ?";

    // Persiapkan statement SQL
    $stmt = mysqli_prepare($conn, $sql);

    // Ikat parameter ke statement
    mysqli_stmt_bind_param($stmt, "i", $userId);

    // Eksekusi statement
    mysqli_stmt_execute($stmt);

    // Dapatkan hasilnya
    $result = mysqli_stmt_get_result($stmt);

    // Fetch all rows as an associative array
    $dataAsisten = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Tutup statement
    mysqli_stmt_close($stmt);

    return $dataAsisten;
}


function editPeran($conn, $id_pengguna, $id_peran) {
    // Mempersiapkan statement untuk menghindari SQL injection
    $stmt = mysqli_prepare($conn, "UPDATE master_user SET ID_Peran = ? WHERE ID_Pengguna = ?");

    // Mengikat parameter ke statement
    mysqli_stmt_bind_param($stmt, "ii", $id_peran, $id_pengguna);

    // Menjalankan statement
    $result = mysqli_stmt_execute($stmt);

    // Menutup statement
    mysqli_stmt_close($stmt);

    // Mengembalikan hasil eksekusi
    return $result;
}


?>
