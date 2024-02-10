<?php
include_once('/var/www/html/app/models/accessModel.php');
function getBeriAksesAjax($conn){
    $dataAsisten =getDataPengguna($conn);
    header('Content-Type: application/json');
    echo json_encode($dataAsisten);
}

function processEditPeran($conn) {
    $response = array('success' => false, 'message' => '');

    $id_pengguna = $_POST['id_pengguna'] ?? null;
    $id_peran = $_POST['id_peran'] ?? null;

    // Check if id_peran is empty
    if (empty($id_peran)) {
        // Gagal, ID peran kosong
        $response['message'] = 'ID peran tidak boleh kosong';
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    // Memanggil fungsi editPeran dan menyimpan hasilnya
    $result = editPeran($conn, $id_pengguna, $id_peran);

    // Mengecek apakah operasi berhasil atau tidak
    if ($result) {
        // Berhasil mengubah data
        $response['success'] = true;
        $response['message'] = 'Peran pengguna berhasil diubah.';
    } else {
        // Gagal mengubah data
        $response['message'] = 'Terjadi kesalahan saat mengubah peran pengguna.';
    }

    // Mengatur header sebagai JSON
    header('Content-Type: application/json');
    // Mengirim response
    echo json_encode($response);
    exit;
}


function detailDataById($conn){
    if(isset($_GET['id_pengguna'])) {
        $id_pengguna = $_GET['id_pengguna'];
        $data = getDetailDataById($conn, $id_pengguna);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}

function processDeletePengguna($conn) {
    $id_pengguna = $_GET['id_pengguna'] ?? null;
    if ($id_pengguna) {
        $result = deleteUserById($conn, $id_pengguna);
        if ($result) {
            // Penghapusan berhasil
            // Set flash message atau redirect
            header('Location: index.php?action=access&message=deleteSuccess');
        } else {
            // Penghapusan gagal
            // Set flash message atau redirect
            header('Location: index.php?action=access&message=deleteFail');
        }
    }
}

function processResetPassword($conn) {
    $response = array('success' => false, 'message' => '');

    // Asumsikan menggunakan metode POST untuk peningkatan keamanan
    $id_pengguna = $_POST['id_pengguna'] ?? null;

    if ($id_pengguna) {
        $result = resetPasswordById($conn, $id_pengguna);
        if ($result) {
            // Reset password berhasil
            $response['success'] = true;
            $response['message'] = 'Password berhasil direset.';
        } else {
            // Reset password gagal
            $response['message'] = 'Gagal mereset password.';
        }
    } else {
        $response['message'] = 'ID pengguna tidak ditemukan.';
    }

    // Mengatur header sebagai JSON
    header('Content-Type: application/json');
    // Mengirim response
    echo json_encode($response);
    exit;
}

function processTambahUser($conn) {
    $response = array('success' => false, 'message' => '');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $namaDepan = $_POST['nama_depan'] ?? '';
        $email = $_POST['email'] ?? '';
        $nim = $_POST['nim'] ?? '';

        // Validasi panjang NIM
        if (strlen($nim) != 11) {
            // Gagal, NIM tidak 11 karakter
            $response['message'] = 'NIM harus 11 karakter.';
            echo json_encode($response);
            exit;
        }

        // Jika semua validasi berhasil, lanjutkan dengan penyimpanan data
        $result = tambahUser($conn, $namaDepan, $email, $nim);

        if ($result) {
            // Berhasil menyimpan data
            $response['success'] = true;
            $response['message'] = 'User berhasil ditambahkan.';
        } else {
            // Gagal menyimpan data
            $response['message'] = 'Gagal menambahkan user.';
        }
    } else {
        $response['message'] = 'Invalid request method.';
    }

    echo json_encode($response);
    exit;
}



?>
