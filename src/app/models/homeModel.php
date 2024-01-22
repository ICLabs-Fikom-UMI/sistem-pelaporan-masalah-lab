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
function getAllPermasalahanLab($conn) {
    $query = "SELECT tli.ID_Masalah, mal.Nama_Aset, ml.Nama_Lab, tli.Nomor_Unit,
                     tli.Deskripsi_Masalah, tli.Batas_Waktu, tli.Status_Masalah
              FROM txn_lab_issues tli
              JOIN master_lab ml ON tli.ID_Lab = ml.ID_Lab
              JOIN master_aset_lab mal ON tli.ID_Aset = mal.ID_Aset
              WHERE tli.Status_Masalah = 'Disetujui'";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $permasalahanLab = [];
    while ($row = $result->fetch_assoc()) {
        $permasalahanLab[] = $row;
    }

    return $permasalahanLab;
}


function getTeknisiByIDMasalah($conn, $idMasalah) {
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
