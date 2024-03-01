<?php
function getDataPengguna($conn) {
    $userId = $_SESSION['user_id']; // Ambil user_id dari session

    // SQL query to join the master_user and master_roles tables
    // Kecualikan pengguna yang sedang login
    $sql = "SELECT master_user.ID_Pengguna, master_user.Nama_Depan, master_user.Nama_Belakang, master_user.Foto_Path, master_roles.Nama_Peran
            FROM master_user
            INNER JOIN master_roles ON master_user.ID_Peran = master_roles.ID_Peran
            WHERE master_user.ID_Pengguna != ?
            ORDER BY master_user.ID_Peran ASC";

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

function getDetailDataById($conn, $id_pengguna) {
    // SQL query to join master_user and master_roles tables
    $sql = "SELECT master_user.ID_Pengguna,
                   master_user.Nama_Depan,
                   master_user.Nama_Belakang,
                   master_user.Nim,
                   master_user.Email,
                   master_user.Foto_Path,
                   master_roles.Nama_Peran
            FROM master_user
            INNER JOIN master_roles ON master_user.ID_Peran = master_roles.ID_Peran
            WHERE master_user.ID_Pengguna = ?";

    // Persiapkan statement SQL
    $stmt = mysqli_prepare($conn, $sql);

    // Ikat parameter ke statement (user ID)
    mysqli_stmt_bind_param($stmt, "i", $id_pengguna);

    // Eksekusi statement
    mysqli_stmt_execute($stmt);

    // Dapatkan hasilnya
    $result = mysqli_stmt_get_result($stmt);

    // Fetch the user data as an associative array
    $userData = mysqli_fetch_assoc($result);

    // Tutup statement
    mysqli_stmt_close($stmt);

    return $userData;
}

function deleteUserById($conn, $id_pengguna) {
    // SQL untuk menghapus pengguna
    $sql = "DELETE FROM master_user WHERE  ID_Pengguna = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_pengguna);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}
function resetPasswordById($conn, $id_pengguna) {
  $passwordDefault = 'fikom12345';
    $hashedPassword = password_hash($passwordDefault, PASSWORD_DEFAULT);

    $sql = "UPDATE master_user SET Kata_Sandi = ? WHERE ID_Pengguna = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $id_pengguna);

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}

function tambahUser($conn, $namaDepan, $email, $nim) {
    // Pengecekan email duplikat
    $sqlCheck = "SELECT email FROM master_user WHERE email = ?";
    $stmtCheck = mysqli_prepare($conn, $sqlCheck);
    mysqli_stmt_bind_param($stmtCheck, "s", $email);
    mysqli_stmt_execute($stmtCheck);
    mysqli_stmt_store_result($stmtCheck);

    if (mysqli_stmt_num_rows($stmtCheck) > 0) {
        // Email sudah terdaftar
        mysqli_stmt_close($stmtCheck);
        return false;
    }
    mysqli_stmt_close($stmtCheck);

    // Jika email belum terdaftar, lanjutkan dengan penyimpanan data
    $passwordDefault = 'fikom12345';
    $hashedPassword = password_hash($passwordDefault, PASSWORD_DEFAULT);
    $id_peran = 3;

    $sql = "INSERT INTO master_user (Nama_Depan, Email, Nim, Kata_sandi, ID_Peran) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $namaDepan, $email, $nim, $hashedPassword, $id_peran);

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}





?>
