<?php
function getAllTaskById($conn) {
    // Get the user ID from the session
    $userId = $_SESSION['user_id'];

    // Prepare the SQL query
    $query = "SELECT tli.ID_Masalah, ml.Nama_Lab, mal.Nama_Aset, tli.Nomor_Unit,
                     tli.Deskripsi_Masalah, tli.Batas_Waktu
              FROM master_teknisi_task mtt
              JOIN txn_lab_issues tli ON mtt.ID_Masalah = tli.ID_Masalah
              JOIN master_lab ml ON tli.ID_Lab = ml.ID_Lab
              JOIN master_aset_lab mal ON tli.ID_Aset = mal.ID_Aset
              WHERE tli.Status_Masalah = 'Disetujui'
                AND mtt.ID_Pengguna = ?";

    // Prepare and bind
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $userId);

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Bind the result variables
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        // Handle error - for example, log it or show a user-friendly message
        error_log('Query failed: ' . mysqli_error($conn));
        return null;
    }

    $laporanDetail = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $laporanDetail;
}
// getTaskById

function getTaskById($conn, $id_masalah) {
    $query = "SELECT tli.ID_Masalah, mal.Nama_Aset, ml.Nama_Lab, tli.Nomor_Unit,
                     tli.Deskripsi_Masalah,tli.Deskripsi_Tambahan, tli.Batas_Waktu, tli.Status_Masalah, tli.Komentar, mu.Nama_Depan AS Nama_Pengguna
              FROM txn_lab_issues tli
              JOIN master_lab ml ON tli.ID_Lab = ml.ID_Lab
              JOIN master_aset_lab mal ON tli.ID_Aset = mal.ID_Aset
              LEFT JOIN master_teknisi_task mtt ON tli.ID_Masalah = mtt.ID_Masalah
              LEFT JOIN master_user mu ON mtt.ID_Pengguna = mu.ID_Pengguna
              WHERE  tli.ID_Masalah = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_masalah);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Mengambil hanya satu baris dari hasil
    if ($row = $result->fetch_assoc()) {
        // Panggil fungsi getTeknisiByMasalah dengan ID Masalah
        $teknisi = getTeknisiByMasalah($conn, $row['ID_Masalah']);

        // Masukkan informasi teknisi ke dalam baris hasil
        $row['teknisi'] = $teknisi;

        // Kembalikan baris permasalahan langsung
        return $row;
    }

    // Kembalikan null jika tidak ada permasalahan yang ditemukan
    return null;
}



function updateDatabaseWithFile($conn, $id_masalah, $fileNameInDb, $komentar){
    $targetFilePath = $fileNameInDb;
    $status = 'Selesai';

    $query = "UPDATE txn_lab_issues SET Foto_Path = ?, Komentar = ?, Status_Masalah = ? WHERE ID_Masalah = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $targetFilePath, $komentar, $status, $id_masalah);
    mysqli_stmt_execute($stmt);

    if(mysqli_stmt_affected_rows($stmt) > 0){
        return true;
    } else {

        return false;
    }
}




?>
