<?php
function getUser($conn) {
    $sql = "SELECT u.ID_Pengguna, u.Nama_Depan
            FROM master_user u
            INNER JOIN master_roles r ON u.ID_Peran = r.ID_Peran
            WHERE r.Nama_Peran = 'Asisten'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    return $users;
}


function getDataLaporan($conn) {
    $query = "SELECT tli.ID_Masalah, ml.Nama_Lab, mal.Nama_Aset, tli.Nomor_Unit, tli.Deskripsi_Masalah
              FROM txn_lab_issues tli
              JOIN master_lab ml ON tli.ID_Lab = ml.ID_Lab
              JOIN master_aset_lab mal ON tli.ID_Aset = mal.ID_Aset
              WHERE tli.Status_Masalah = 'Diproses'";

    $result = mysqli_query($conn, $query);
    $laporan = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $laporan;
}

function approveReport($conn, $id_masalah, $batas_waktu, $id_teknisi) {
    // First, update the Batas_Waktu in txn_lab_issues
    $query_issues = "UPDATE txn_lab_issues SET Batas_Waktu = ?, Status_Masalah = 'Disetujui' WHERE ID_Masalah = ?";
    $stmt_issues = mysqli_prepare($conn, $query_issues);

    if (!$stmt_issues || !mysqli_stmt_bind_param($stmt_issues, "si", $batas_waktu, $id_masalah) || !mysqli_stmt_execute($stmt_issues)) {
        return false;
    }

    mysqli_stmt_close($stmt_issues);

    // Second, update or insert the ID_Teknisi in master_teknisi_task
    // Check if a record already exists for this ID_Masalah
    $query_check = "SELECT * FROM master_teknisi_task WHERE ID_Masalah = ?";
    $stmt_check = mysqli_prepare($conn, $query_check);
    mysqli_stmt_bind_param($stmt_check, "i", $id_masalah);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);
    mysqli_stmt_close($stmt_check);

    if ($result_check && mysqli_num_rows($result_check) > 0) {
        // If a record exists, update it
        $query_teknisi = "UPDATE master_teknisi_task SET ID_Pengguna = ? WHERE ID_Masalah = ?";
        $stmt_teknisi = mysqli_prepare($conn, $query_teknisi);
        if (!$stmt_teknisi || !mysqli_stmt_bind_param($stmt_teknisi, "ii", $id_teknisi, $id_masalah) || !mysqli_stmt_execute($stmt_teknisi)) {
            return false;
        }
        mysqli_stmt_close($stmt_teknisi);
    } else {
        // If no record exists, insert a new one
        $query_teknisi = "INSERT INTO master_teknisi_task (ID_Pengguna, ID_Masalah) VALUES (?, ?)";
        $stmt_teknisi = mysqli_prepare($conn, $query_teknisi);
        if (!$stmt_teknisi || !mysqli_stmt_bind_param($stmt_teknisi, "ii", $id_teknisi, $id_masalah) || !mysqli_stmt_execute($stmt_teknisi)) {
            return false;
        }
        mysqli_stmt_close($stmt_teknisi);
    }

    return true;
}



?>
