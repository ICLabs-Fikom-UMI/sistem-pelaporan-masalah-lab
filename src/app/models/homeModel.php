<?php
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

// beranda
function getAllPermasalahanLab($conn) {
    $query = "SELECT tli.ID_Masalah, mal.Nama_Aset, ml.Nama_Lab, tli.Nomor_Unit,
                     tli.Deskripsi_Masalah, tli.Batas_Waktu, tli.Status_Masalah
              FROM txn_lab_issues tli
              JOIN master_lab ml ON tli.ID_Lab = ml.ID_Lab
              JOIN master_aset_lab mal ON tli.ID_Aset = mal.ID_Aset
              WHERE tli.Status_Masalah = 'Disetujui' OR tli.Status_Masalah = 'Selesai'
              GROUP BY tli.ID_Masalah
              ORDER BY tli.Tanggal_Pelaporan DESC";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $permasalahanLab = [];
    while ($row = $result->fetch_assoc()) {
        $permasalahanLab[] = $row;
    }

    // Menambahkan jumlah data ke dalam array yang dikembalikan
    $responseData = [
        'jumlahData' => count($permasalahanLab),
        'data' => $permasalahanLab
    ];

    return $responseData;
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


function getDetailDataBerandaById($conn, $id_masalah) {
    $query = "SELECT tli.ID_Masalah, mal.Nama_Aset, ml.Nama_Lab, tli.Nomor_Unit,
                     tli.Deskripsi_Masalah, tli.Batas_Waktu, tli.Status_Masalah,
                     tli.Foto_Path, tli.Komentar, mu.Nama_Depan AS Nama_Pengguna
              FROM txn_lab_issues tli
              JOIN master_lab ml ON tli.ID_Lab = ml.ID_Lab
              JOIN master_aset_lab mal ON tli.ID_Aset = mal.ID_Aset
              LEFT JOIN master_teknisi_task mtt ON tli.ID_Masalah = mtt.ID_Masalah
              LEFT JOIN master_user mu ON mtt.ID_Pengguna = mu.ID_Pengguna
              WHERE tli.Status_Masalah IN ('Disetujui', 'Selesai') AND tli.ID_Masalah = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_masalah);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $permasalahanLab = [];
    while ($row = $result->fetch_assoc()) {
        // Panggil fungsi getTeknisiByMasalah dengan ID Masalah yang dikirim dari user
        $teknisi = getTeknisiByMasalah($conn, $row['ID_Masalah']);

        // Masukkan hasilnya ke dalam kolom baru 'teknisi'
        $row['teknisi'] = $teknisi;

        // Tambahkan baris masalah dengan informasi teknisi ke dalam array
        $permasalahanLab[] = $row;
    }

    return $permasalahanLab;
}

?>
