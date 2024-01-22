<?php
function getDataLab($conn) {
    $result = mysqli_query($conn, "SELECT ID_Lab, Nama_Lab FROM master_lab");
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $users;
}
function getDataAset($conn) {
    $result = mysqli_query($conn, "SELECT ID_Aset, Nama_Aset FROM master_aset_lab");
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $users;
}
function setLaporanCepat($id_lab, $id_aset, $no_unit, $deskripsi, $ID_Pelapor, $conn){
    $query = "INSERT INTO txn_lab_issues (Deskripsi_Masalah, ID_Lab, ID_Aset, ID_Pelapor, Status_Masalah, Nomor_Unit) VALUES (?, ?, ?, ?, 'Diproses', ?)";
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $deskripsi, $id_lab, $id_aset, $ID_Pelapor, $no_unit);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    } else {
        return false;
    }
}

function getAllPermasalahanLab($conn) {
    $query = "SELECT tli.ID_Masalah, mal.Nama_Aset, ml.Nama_Lab, tli.Nomor_Unit,
                     tli.Deskripsi_Masalah, tli.Batas_Waktu, tli.Status_Masalah, mu.Nama_Depan AS Nama_Pengguna
              FROM txn_lab_issues tli
              JOIN master_lab ml ON tli.ID_Lab = ml.ID_Lab
              JOIN master_aset_lab mal ON tli.ID_Aset = mal.ID_Aset
              LEFT JOIN master_teknisi_task mtt ON tli.ID_Masalah = mtt.ID_Masalah
              LEFT JOIN master_user mu ON mtt.ID_Pengguna = mu.ID_Pengguna
              WHERE tli.Status_Masalah = 'Disetujui'"; // Menambahkan kondisi WHERE
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $permasalahanLab = [];
    while ($row = $result->fetch_assoc()) {
        $permasalahanLab[] = $row;
    }

    return $permasalahanLab;
}

function getTeknisiByMasalah($conn, $idMasalah) {
    $query = "SELECT mu.Nama_Depan
              FROM master_user mu
              JOIN master_teknisi_task mtt ON mu.ID_Pengguna = mtt.ID_Pengguna
              WHERE mtt.ID_Masalah = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $idMasalah);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $teknisiNames = [];
    while ($row = $result->fetch_assoc()) {
        $teknisiNames[] = $row['Nama_Depan'];
    }

    return $teknisiNames;
}



?>
