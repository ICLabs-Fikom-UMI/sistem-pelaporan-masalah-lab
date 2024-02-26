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

function approveReport($conn, $id_masalah, $batas_waktu, $deskripsi_tambahan, $teknisi) {
    // Perbarui txn_lab_issues dengan Batas_Waktu, Status_Masalah, dan Deskripsi_Tambahan
    $sql = "UPDATE txn_lab_issues
            SET Batas_Waktu = ?,
                Status_Masalah = 'Disetujui',
                Deskripsi_Tambahan = ?
            WHERE ID_Masalah = ?";

    // Mempersiapkan pernyataan
    $stmt = mysqli_prepare($conn, $sql);

    // Mengikat parameter
    mysqli_stmt_bind_param($stmt, 'ssi', $batas_waktu, $deskripsi_tambahan, $id_masalah);

    // Menjalankan query
    if (!mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return false; // Gagal menjalankan query
    }

    // Menutup statement
    mysqli_stmt_close($stmt);

    // Hapus semua entri teknisi sebelumnya untuk ID_Masalah ini
    $delete_query = "DELETE FROM master_teknisi_task WHERE ID_Masalah = ?";
    $stmt_delete = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($stmt_delete, "i", $id_masalah);
    mysqli_stmt_execute($stmt_delete);
    mysqli_stmt_close($stmt_delete);

    // Insert semua teknisi baru untuk ID_Masalah ini
    foreach ($teknisi as $id_teknisi_single) {
        $insert_query = "INSERT INTO master_teknisi_task (ID_Pengguna, ID_Masalah) VALUES (?, ?)";
        $stmt_insert = mysqli_prepare($conn, $insert_query);
        if (!$stmt_insert || !mysqli_stmt_bind_param($stmt_insert, "ii", $id_teknisi_single, $id_masalah) || !mysqli_stmt_execute($stmt_insert)) {
            mysqli_stmt_close($stmt_insert);
            return false; // Gagal memasukkan data teknisi
        }
        mysqli_stmt_close($stmt_insert);
    }

    return true; // Sukses
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

// next fitur feat keep
// Laporan Masuk
function getDetailLaporanMasuk($conn, $id_masalah) {
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

//  tolak laporan masuk by id
function tolakLaporanMasukById($conn, $idMasalah) {
    $query = "UPDATE txn_lab_issues SET Status_Masalah = 'Ditolak' WHERE ID_Masalah = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $idMasalah);
    $execute = mysqli_stmt_execute($stmt);
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);

    return $execute && $affected_rows > 0;
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

// fungsi untuk mengambil lengkap data laporan saya berdasarkan ID_Masalah
// bisa di gunakan hingga 3 fitur
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

// hapus laporan saya by id
function hapusLaporanSayaById($conn, $idMasalah) {
    $query = "DELETE FROM txn_lab_issues WHERE ID_Masalah = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $idMasalah);
    $execute = mysqli_stmt_execute($stmt);
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);

    return $execute && $affected_rows > 0;
}


?>
