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

function getTaskById($conn, $id_masalah) {
    // Prepare the SQL query
    $query = "SELECT tli.ID_Masalah, tli.Tanggal_Pelaporan, ml.Nama_Lab, mal.Nama_Aset,
                     tli.Nomor_Unit, tli.Deskripsi_Masalah, tli.Batas_Waktu,
                     mu.Nama_Depan as Teknisi
              FROM txn_lab_issues tli
              JOIN master_lab ml ON tli.ID_Lab = ml.ID_Lab
              JOIN master_aset_lab mal ON tli.ID_Aset = mal.ID_Aset
              JOIN master_teknisi_task mtt ON tli.ID_Masalah = mtt.ID_Masalah
              JOIN master_user mu ON mtt.ID_Pengguna = mu.ID_Pengguna
              WHERE tli.ID_Masalah = ?";

    // Prepare and bind
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_masalah);

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Bind the result variables
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        // Handle error
        error_log('Query failed: ' . mysqli_error($conn));
        return null;
    }

    // Fetch the data
    $taskDetail = mysqli_fetch_assoc($result);

    return $taskDetail;
}

function updateDatabaseWithFile($conn, $id_masalah, $fileName, $komentar){
    $targetFilePath = $fileName;
    $status = 'Selesai'; // Set the Status_Masalah to 'Selesai'

    // Query to update the database
    $query = "UPDATE txn_lab_issues SET Foto_Path = ?, Komentar = ?, Status_Masalah = ? WHERE ID_Masalah = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $targetFilePath, $komentar, $status, $id_masalah);
    mysqli_stmt_execute($stmt);

    if(mysqli_stmt_affected_rows($stmt) > 0){
        // Successfully updated
        return true;
    } else {
        // Failed to update
        return false;
    }
}




?>
