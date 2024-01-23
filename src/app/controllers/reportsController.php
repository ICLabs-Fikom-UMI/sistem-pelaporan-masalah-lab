<?php
include('/var/www/html/app/models/reportsModel.php');
function showViewReportKorlab($conn) {
    $users = getUser($conn); // Fetch user data
    $dataLaporan = getDataLaporan($conn); // Fetch report data

    // Directly include the view file without checking for data retrieval success
    include('/var/www/html/app/views/reports/reportsKorlab.php');
}

function setujuiLaporan($conn, $id_masalah, $batas_waktu, $id_teknisi){


    approveReport($conn, $id_masalah, $batas_waktu, $id_teknisi);
    $_SESSION['setuju_message'] = "Laporan Telah Di Tolak...";
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
?>
