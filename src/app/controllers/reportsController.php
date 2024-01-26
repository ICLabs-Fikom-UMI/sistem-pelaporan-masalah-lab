<?php
include_once('/var/www/html/app/models/reportsModel.php');
include_once('/var/www/html/app/models/utility/dataModel.php');
function showViewReportKorlab($conn) {
    $users = getUser($conn); // Fetch user data
    $dataLaporan = getDataLaporan($conn); // Fetch report data

    // Directly include the view file without checking for data retrieval success
    include('/var/www/html/app/views/reports/reportsKorlab.php');
}

function setujuiLaporan($conn, $id_masalah, $batas_waktu, $id_teknisi, $Deskripsi_Masalah = null) {
    approveReport($conn, $id_masalah, $batas_waktu, $id_teknisi, $Deskripsi_Masalah);
    $_SESSION['setuju_message'] = "Laporan Telah Disetujui";
    header("Location: index.php?action=reports");
}

function tolakLaporan($conn, $id_masalah){
    $users = getUser($conn); // Fetch user data
    $dataLaporan = getDataLaporan($conn); // Fetch report data
    rejectReport($conn, $id_masalah);
    $_SESSION['tolak_message'] = "Laporan Telah Di Tolak...";
    header("Location: index.php?action=reports");
}
function detailLaporan($conn, $id_masalah){
    $users = getUser($conn); // Fetch user data
    $dataLaporan = getDataLaporan($conn); // Fetch report data
    $dataDetailLaporan =getDetailLaporan($conn, $id_masalah);
    include('/var/www/html/app/views/reports/reportsKorlab.php');

}


// reports asisten
function showViewReportAsisten($conn) {
    $allLaporanSaya = getAllLaporanSaya($conn);
    // Directly include the view file without checking for data retrieval success
    include('/var/www/html/app/views/reports/reportsAsisten.php');
}

function dataEditLaporan($conn, $id_masalah){
    $asets = getDataAset($conn);
    $labs = getDataLab($conn);
    $allLaporanSaya = getAllLaporanSaya($conn);
    $dataDetailLaporan=getDetailLaporan($conn, $id_masalah);
    include('/var/www/html/app/views/reports/reportsAsisten.php');

}

function editLaporan($conn, $id_masalah, $id_lab, $id_aset, $nomor_unit, $deskripsi_masalah) {
    $asets = getDataAset($conn);
    $labs = getDataLab($conn);

    submitEditLaporan($conn, $id_masalah, $id_lab, $id_aset, $nomor_unit, $deskripsi_masalah);
    $allLaporanSaya = getAllLaporanSaya($conn);
    include('/var/www/html/app/views/reports/reportsAsisten.php');
}
?>
