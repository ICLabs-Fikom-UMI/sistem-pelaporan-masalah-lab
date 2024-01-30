<?php

include_once('/var/www/html/app/models/homeModel.php');
include_once('/var/www/html/app/models/utility/dataModel.php');

function showViewHome($conn) {
    $permasalahanLab = getAllPermasalahanLab($conn);
    foreach ($permasalahanLab as $key => $permasalahan) {
        $permasalahanLab[$key]['teknisi'] = getTeknisiByMasalah($conn, $permasalahan['ID_Masalah']);
    }
    $asets = getDataAset($conn);
    $labs = getDataLab($conn);
    include('/var/www/html/app/views/home/home.php');

}
function laporanCepat($conn) {
    $id_lab = $_POST['id_lab'];
    $id_aset = $_POST['id_aset'];
    $no_unit = $_POST['no_unit'];
    $deskripsi = $_POST['deskripsi'];
    $ID_Pelapor = $_SESSION['user_id'];

    // Call the setLaporanCepat function from the model
    $result = setLaporanCepat($id_lab, $id_aset, $no_unit, $deskripsi, $ID_Pelapor, $conn);

    // Handle the response
    if ($result === true) {
        $_SESSION['success_message'] = "Laporan berhasil ditambahkan. Akan segera di cek oleh Kordinator Lab";
        header("Location: index.php?action=home");
        exit();
    } else {
        $_SESSION['bad_message'] = "Laporan Gagal ditambahkan.";
        header("Location: index.php?action=home");
        exit();
    }
}




?>
