<?php

include('/var/www/html/app/models/homeModel.php');




function showViewHome($conn) {
    $getAll = getAllPermasalahanLab($conn);
    $getTeknisiByIDMasalah = getTeknisiByIDMasalah($conn, $idMasalah);
    $asets = getDataAset($conn);
    $labs = getDataLab($conn);
    include('/var/www/html/app/views/home/home.php');

}
function laporanCepat($id_lab, $id_aset, $no_unit, $deskripsi, $ID_Pelapor, $conn) {
    // Call the setLaporanCepat function from the model
    $result = setLaporanCepat($id_lab, $id_aset, $no_unit, $deskripsi, $ID_Pelapor, $conn);

    // Handle the response
    if ($result === true) {
        $_SESSION['success_message'] = "Laporan berhasil ditambahkan.";
        header("Location: index.php?action=home");
        exit();
    } else {
        $_SESSION['success_message'] = "Laporan Gagal ditambahkan.";
        header("Location: index.php?action=home");
        exit();
    }
}




?>
