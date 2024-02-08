<?php
include_once('/var/www/html/app/models/reportsModel.php');
include_once('/var/www/html/app/models/utility/dataModel.php');
function getLaporanMasukAjax($conn) {
    $dataLaporan = getDataLaporan($conn); // Fetch report data
    header('Content-Type: application/json');
    echo json_encode($dataLaporan);
}

function setujuiLaporan($conn) {
    $allSuccess = true;

    foreach ($_POST['id_masalah'] as $id_masalah) {
        $batasWaktuField = 'batas_waktu_' . $id_masalah;
        $idTeknisiField = 'id_teknisi_' . $id_masalah;
        $deskripsiMasalahField = 'deskripsi_masalah_' . $id_masalah;

        if (isset($_POST[$batasWaktuField]) && isset($_POST[$idTeknisiField])) {
            $batas_waktu = $_POST[$batasWaktuField];
            $id_teknisi = $_POST[$idTeknisiField];
            $deskripsi_masalah = $_POST[$deskripsiMasalahField] ?? null;

            if (!approveReport($conn, $id_masalah, $batas_waktu, $deskripsi_masalah, $id_teknisi)) {
                $allSuccess = false;
                $_SESSION['gagal_message'] = "Persetujuan Laporan Gagal";
                break;
            }
        }
    }

    if ($allSuccess) {
        $_SESSION['setuju_message'] = "Laporan Telah Disetujui";
    }

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
function getLaporanSayaAjax($conn) {
    $allLaporanSaya = getAllLaporanSaya($conn);
    header('Content-Type: application/json');
    echo json_encode($allLaporanSaya);
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

    submitEditLaporan($conn, $id_masalah, $id_lab, $id_aset, $nomor_unit, $deskripsi_masalah);
    $allLaporanSaya = getAllLaporanSaya($conn);
    include('/var/www/html/app/views/reports/reportsAsisten.php');
}

function processDetailSelesai($conn){
    if(isset($_GET['id_masalah'])) {
        $id_masalah = $_GET['id_masalah'];
        $data = detailSelesai($conn, $id_masalah);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
?>
