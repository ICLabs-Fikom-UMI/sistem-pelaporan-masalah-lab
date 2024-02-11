<?php

function getDataLaporan($conn) {
    $query = "SELECT tli.ID_Masalah, ml.Nama_Lab, mal.Nama_Aset, tli.Nomor_Unit, tli.Deskripsi_Masalah,
                     mu.Nama_Depan AS Nama_Pelapor, tli.Tanggal_Pelaporan AS Tanggal_Laporan
              FROM txn_lab_issues tli
              JOIN master_lab ml ON tli.ID_Lab = ml.ID_Lab
              JOIN master_aset_lab mal ON tli.ID_Aset = mal.ID_Aset
              JOIN master_user mu ON tli.ID_Pelapor = mu.ID_Pengguna
              WHERE tli.Status_Masalah = 'Diproses'";

    $result = mysqli_query($conn, $query);
    $laporan = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $laporan;
}


function approveReport($conn, $id_masalah, $batas_waktu, $deskripsi_masalah,$id_teknisi) {
     // Mempersiapkan pernyataan SQL dengan placeholder
     $sql = "UPDATE txn_lab_issues
     SET Batas_Waktu = ?,
         Status_Masalah = 'Disetujui',
         Deskripsi_Masalah = ?
     WHERE ID_Masalah = ?";

    // Mempersiapkan pernyataan
    $stmt = mysqli_prepare($conn, $sql);

    // Mengikat parameter
    mysqli_stmt_bind_param($stmt, 'ssi', $batas_waktu, $deskripsi_masalah, $id_masalah);

    // Menjalankan query
    mysqli_stmt_execute($stmt);

    // Menutup statement
    mysqli_stmt_close($stmt);

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
function rejectReport($conn, $id_masalah){
    $query = "DELETE FROM txn_lab_issues WHERE ID_Masalah = ?";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt || !mysqli_stmt_bind_param($stmt, "i", $id_masalah) || !mysqli_stmt_execute($stmt)) {
        return false;
    }

    mysqli_stmt_close($stmt);
    return true;
}

function getDetailLaporan($conn, $id_masalah) {
    $query = "SELECT tli.ID_Masalah, tli.Tanggal_Pelaporan, tli.ID_Lab, ml.Nama_Lab, tli.ID_Aset, mal.Nama_Aset, tli.Nomor_Unit, tli.Deskripsi_Masalah
              FROM txn_lab_issues tli
              JOIN master_lab ml ON tli.ID_Lab = ml.ID_Lab
              JOIN master_aset_lab mal ON tli.ID_Aset = mal.ID_Aset
              WHERE tli.ID_Masalah = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_masalah);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        mysqli_stmt_close($stmt);
        return $row;
    } else {
        mysqli_stmt_close($stmt);
        return null;
    }
}



// asisten reports
function getAllLaporanSaya($conn) {
    $idPelapor = $_SESSION['user_id']; // Mengambil ID pengguna dari session

    $query = "SELECT tli.ID_Masalah, ml.Nama_Lab, mal.Nama_Aset, tli.Nomor_Unit, tli.Deskripsi_Masalah, tli.Tanggal_Pelaporan, tli.Status_Masalah
              FROM txn_lab_issues tli
              JOIN master_lab ml ON tli.ID_Lab = ml.ID_Lab
              JOIN master_aset_lab mal ON tli.ID_Aset = mal.ID_Aset
              WHERE tli.ID_Pelapor = ?
              ORDER BY FIELD(tli.Status_Masalah, 'Selesai', 'Disetujui', 'Diproses')";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $idPelapor);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $laporan = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);

    return $laporan;
}

// getLaporanSayaBYId
// edit
function getLaporanSayaEdit($conn, $idMasalah) {
    $idPelapor = $_SESSION['user_id']; // Mengambil ID pengguna dari session

    // Menambahkan kondisi WHERE untuk ID_Masalah
    $query = "SELECT tli.ID_Masalah, ml.ID_Lab , ml.Nama_Lab, mal.Nama_Aset, tli.Nomor_Unit, tli.Deskripsi_Masalah, tli.Tanggal_Pelaporan, tli.Status_Masalah
              FROM txn_lab_issues tli
              JOIN master_lab ml ON tli.ID_Lab = ml.ID_Lab
              JOIN master_aset_lab mal ON tli.ID_Aset = mal.ID_Aset
              WHERE tli.ID_Pelapor = ? AND tli.ID_Masalah = ?"; // Menambahkan kondisi untuk ID_Masalah

    $stmt = mysqli_prepare($conn, $query);
    // Menambahkan parameter untuk ID_Masalah dalam mysqli_stmt_bind_param
    mysqli_stmt_bind_param($stmt, "ii", $idPelapor, $idMasalah);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $laporan = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);

    return $laporan;
}

function submitEditLaporan($conn, $id_masalah, $id_lab, $id_aset, $nomor_unit, $deskripsi_masalah) {
    $sql = "UPDATE txn_lab_issues SET ID_Lab = ?, ID_Aset = ?, Nomor_Unit = ?, Deskripsi_Masalah = ? WHERE ID_Masalah = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "iissi", $id_lab, $id_aset, $nomor_unit, $deskripsi_masalah, $id_masalah);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result; // Mengembalikan true jika berhasil, false jika gagal
    } else {
        return false; // Gagal menyiapkan statement
    }
}


function getLaporanByIdMasalah($conn, $id_masalah){
    // Mempersiapkan query SQL dengan JOIN dan kondisi Status_Masalah
    $query = "SELECT ml.Nama_Lab, ml.ID_Lab,mal.ID_Aset, mal.Nama_Aset, tli.ID_Masalah, tli.Nomor_Unit, tli.Deskripsi_Masalah, tli.Status_Masalah,
            tli.Foto_Path, tli.Tanggal_Pelaporan, tli.Komentar, mu.Nama_Depan AS Nama_Teknisi
            FROM txn_lab_issues tli
            INNER JOIN master_lab ml ON tli.ID_Lab = ml.ID_Lab
            INNER JOIN master_aset_lab mal ON tli.ID_Aset = mal.ID_Aset
            LEFT JOIN master_teknisi_task mtt ON tli.ID_Masalah = mtt.ID_Masalah
            LEFT JOIN master_user mu ON mtt.ID_Pengguna = mu.ID_Pengguna
            WHERE tli.ID_Masalah = ?";

    // Mempersiapkan pernyataan
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Mengikat parameter
        mysqli_stmt_bind_param($stmt, "i", $id_masalah);

        // Menjalankan pernyataan
        mysqli_stmt_execute($stmt);

        // Mengambil hasil
        $result = mysqli_stmt_get_result($stmt);

        // Memeriksa apakah hasilnya ada
        if ($row = mysqli_fetch_assoc($result)) {
            // Kembalikan data jika ditemukan
            return $row;
        } else {
            // Kembalikan null jika tidak ada data
            return null;
        }
    } else {
        // Menangani error dalam pembuatan statement
        return null;
    }
}

?>
