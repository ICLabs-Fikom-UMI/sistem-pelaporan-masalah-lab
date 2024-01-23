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
    header("Location: index.php?action=reports");


}
?>
