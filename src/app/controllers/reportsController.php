<?php
include_once('/var/www/html/app/models/reportsModel.php');
include_once('/var/www/html/app/models/utility/dataModel.php');
function showViewReportKorlab($conn) {
    $users = getUser($conn); // Fetch user data
    $dataLaporan = getDataLaporan($conn); // Fetch report data


    include('/var/www/html/app/views/reports/reportsKorlab.php');
}

function setujuiLaporan($conn, $id_masalah, $batas_waktu, $id_teknisi, $Deskripsi_Masalah = null) {
    approveReport($conn, $id_masalah, $batas_waktu, $id_teknisi, $Deskripsi_Masalah);
    $_SESSION['setuju_message'] = "Laporan Telah Disetujui";
    header("Location: index.php?action=reports");
}

function tolakLaporan($conn, $id_masalah){
    $users = getUser($conn);
    $dataLaporan = getDataLaporan($conn);
    rejectReport($conn, $id_masalah);
    $_SESSION['tolak_message'] = "Laporan Telah Di Tolak...";
    header("Location: index.php?action=reports");
}
function detailLaporan($conn, $id_masalah){
    $users = getUser($conn);
    $dataLaporan = getDataLaporan($conn);
    $dataDetailLaporan =getDetailLaporan($conn, $id_masalah);
    include('/var/www/html/app/views/reports/reportsKorlab.php');

}


// reports asisten
function showViewReportAsisten($conn) {
    $allLaporanSaya = getAllLaporanSaya($conn);
    include('/var/www/html/app/views/reports/reportsAsisten.php');
}

function dataEditLaporan($conn){
    $id_masalah = $_GET['id_masalah'] ?? null;
    $asets = getDataAset($conn);
    $labs = getDataLab($conn);
    $allLaporanSaya = getAllLaporanSaya($conn);
    $dataDetailLaporan=getDetailLaporan($conn, $id_masalah);
    include('/var/www/html/app/views/reports/reportsAsisten.php');

}

function editLaporan($conn) {
    $id_masalah = $_POST['id_Masalah'];
    $id_lab = $_POST['lab'];
    $id_aset = $_POST['aset'];
    $nomor_unit = $_POST['aset_no'];
    $deskripsi_masalah = $_POST['deskripsi_masalah'];

    // fetch data asets and labs
    $asets = getDataAset($conn);
    $labs = getDataLab($conn);

    submitEditLaporan($conn, $id_masalah, $id_lab, $id_aset, $nomor_unit, $deskripsi_masalah);
    $allLaporanSaya = getAllLaporanSaya($conn);
    include('/var/www/html/app/views/reports/reportsAsisten.php');
}
?>
