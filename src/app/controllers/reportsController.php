<?php
include_once('/var/www/html/app/models/reportsModel.php');
include_once('/var/www/html/app/models/utility/dataModel.php');
function getLaporanMasukAjax($conn) {
    $dataLaporan = getDataLaporan($conn); // Fetch report data
    header('Content-Type: application/json');
    echo json_encode($dataLaporan);
}
function setujuiLaporanAjax($conn) {
    header('Content-Type: application/json');
    $response = array('success' => false, 'message' => '');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_masalah = $_POST['id_masalah'] ?? '';
        $batas_waktu = $_POST['batas_waktu'] ?? '';
        $deskripsi_tambahan = $_POST['deskripsi_tambahan'] ?? '';
        $teknisi = $_POST['teknisi'] ?? []; // Asumsikan teknisi dikirim sebagai array

        // Anda bisa menambahkan validasi disini jika perlu
        // Misalnya, validasi apakah semua field wajib terisi

        // Jika validasi berhasil, lanjutkan dengan proses penyimpanan data
        $result = approveReport($conn, $id_masalah, $batas_waktu, $deskripsi_tambahan, $teknisi);

        if ($result) {
            // Berhasil menyimpan data
            $response['success'] = true;
            $response['message'] = 'Tugas berhasil diberikan kepada teknisi.';
        } else {
            // Gagal menyimpan data
            $response['message'] = 'Gagal memberikan tugas.';
        }
    } else {
        $response['message'] = 'Invalid request method.';
    }

    echo json_encode($response);
    exit;
}



function tolakLaporan($conn, $id_masalah){
    $users = getUser($conn);
    $dataLaporan = getDataLaporan($conn);
    rejectReport($conn, $id_masalah);
    $_SESSION['tolak_message'] = "Laporan Telah Di Tolak...";
    header("Location: index.php?action=reports");
}

// feat develop
// Laporan Masuk
function detailLaporanMasukAjax($conn, $id_masalah){
    $dataUser = getUser($conn);
    $dataDetailLaporan = getDetailLaporanMasuk($conn, $id_masalah);

    // Gabungkan kedua set data ke dalam satu array asosiatif
    $dataLaporanMasukById = [
        'dataUser' => $dataUser,
        'dataDetailLaporan' => $dataDetailLaporan
    ];

    header('Content-Type: application/json');

    // Encode dan kirim data sebagai JSON
    echo json_encode($dataLaporanMasukById);
}


// reports asisten
function getLaporanSayaAjax($conn) {
    $allLaporanSaya = getAllLaporanSaya($conn);
    header('Content-Type: application/json');
    echo json_encode($allLaporanSaya);
}
// get data laporan saya by id #detail
function getLaporanSayaByIdAjax($conn) {
    if(isset($_GET['id_masalah'])) {
        $id_masalah = $_GET['id_masalah'];
        $allLaporanSayaById = getLaporanByIdMasalah($conn, $id_masalah);
        header('Content-Type: application/json');
        echo json_encode($allLaporanSayaById);
    }
}
// get data laporan saya by id #edit
function getLaporanSayaByIdEditAjax($conn) {
    if(isset($_GET['id_masalah'])) {
        $id_masalah = $_GET['id_masalah'];
        $allLaporanSayaById = getLaporanSayaEdit($conn, $id_masalah);
        header('Content-Type: application/json');
        echo json_encode($allLaporanSayaById);
    }
}
function editLaporanSayaAjax($conn) {
    header('Content-Type: application/json');
    $response = array('success' => false, 'message' => '');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_masalah = $_POST['id_masalah'] ?? '';
        $id_lab = $_POST['id_lab'] ?? '';
        $id_aset = $_POST['id_aset'] ?? '';
        $nomor_unit = $_POST['nomor_unit'] ?? '';
        $deskripsi_masalah = $_POST['deskripsi_masalah'] ?? '';

        // Anda bisa menambahkan validasi disini jika perlu

        // Jika validasi berhasil, lanjutkan dengan update data
        $result = submitEditLaporan($conn, $id_masalah, $id_lab, $id_aset, $nomor_unit, $deskripsi_masalah);

        if ($result) {
            // Berhasil update data
            $response['success'] = true;
            $response['message'] = 'Laporan berhasil diperbarui.';
        } else {
            // Gagal update data
            $response['message'] = 'Gagal memperbarui laporan.';
        }
    } else {
        $response['message'] = 'Invalid request method.';
    }

    echo json_encode($response);
    exit;
}


function editLaporanSaya($conn) {
    $id_masalah = $_POST['id_masalah'];
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
