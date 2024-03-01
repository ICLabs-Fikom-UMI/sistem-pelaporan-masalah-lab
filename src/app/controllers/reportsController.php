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
        // Validasi apakah teknisi dipilih
        if (empty($teknisi)) {
            $response['message'] = 'Harus memilih setidaknya satu teknisi.';
            echo json_encode($response);
            exit;
        }
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



// tolak laporan masuk by id
function processTolakLaporanMasukByIdAjax($conn) {
    header('Content-Type: application/json');
    $response = ['success' => false, 'message' => ''];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_masalah = $_POST['id_masalah'] ?? '';

        if (empty($id_masalah)) {
            $response['message'] = 'ID masalah tidak boleh kosong.';
        } else {
            $result = tolakLaporanMasukById($conn, $id_masalah);

            if ($result) {
                $response['success'] = true;
                $response['message'] = 'Laporan berhasil ditolak.';
            } else {
                $response['message'] = 'Gagal menolak laporan.';
            }
        }
    } else {
        $response['message'] = 'Invalid request method.';
    }

    echo json_encode($response);
    exit;
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

// controller hapus laporan saya by id
function processHapusLaporanSayaByIdAjax($conn) {
    header('Content-Type: application/json');
    $response = ['success' => false, 'message' => ''];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_masalah = $_POST['id_masalah'] ?? '';

        // Anda bisa menambahkan validasi disini jika perlu

        if (empty($id_masalah)) {
            $response['message'] = 'ID masalah tidak boleh kosong.';
        } else {
            // Jika validasi berhasil, lanjutkan dengan hapus data
            $result = hapusLaporanSayaById($conn, $id_masalah);

            if ($result) {
                // Berhasil hapus data
                $response['success'] = true;
                $response['message'] = 'Laporan berhasil dihapus.';
            } else {
                // Gagal hapus data
                $response['message'] = 'Gagal menghapus laporan.';
            }
        }
    } else {
        $response['message'] = 'Invalid request method.';
    }

    echo json_encode($response);
    exit;
}

?>
