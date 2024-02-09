<?php

include_once('/var/www/html/app/models/homeModel.php');
include_once('/var/www/html/app/models/utility/dataModel.php');

    function getPermasalahanLabAjax($conn) {
        $permasalahanLab = getAllPermasalahanLab($conn);
        foreach ($permasalahanLab as $key => $permasalahan) {
            $permasalahanLab[$key]['teknisi'] = getTeknisiByMasalah($conn, $permasalahan['ID_Masalah']);
        }
        header('Content-Type: application/json');
        echo json_encode($permasalahanLab);
    }

    function getJenisBarangAjax($conn) {
        $jenisBarang = getDataAset($conn);
        header('Content-Type: application/json');
        echo json_encode($jenisBarang);
    }

    function getNamaLabAjax($conn) {
        $dataLab = getDataLab($conn);
        header('Content-Type: application/json');
        echo json_encode($dataLab);
    }
    function laporanCepat($conn) {
        $response = array('success' => false, 'message' => '');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Mengambil data dari POST request
            $id_lab = $_POST['id_lab'] ?? '';
            $id_aset = $_POST['id_aset'] ?? '';
            $no_unit = $_POST['no_unit'] ?? '';
            $deskripsi = $_POST['deskripsi'] ?? '';
            $ID_Pelapor = $_SESSION['user_id'] ?? '';

            // Validasi input
            if (empty($id_lab) || empty($id_aset)  || empty($deskripsi)) {
                $response['message'] = 'Semua field harus diisi.';
                echo json_encode($response);
                exit;
            }


            // Call the setLaporanCepat function from the model
            $result = setLaporanCepat($id_lab, $id_aset, $no_unit, $deskripsi, $ID_Pelapor, $conn);

            // Handle the response
            if ($result === true) {
                $response['success'] = true;
                $response['message'] = "Laporan berhasil ditambahkan. Akan segera di cek oleh Kordinator Lab";
            } else {
                $response['message'] = "Laporan Gagal ditambahkan.";
            }
        } else {
            $response['message'] = 'Invalid request method.';
        }

        // Mengembalikan respons dalam format JSON
        echo json_encode($response);
        exit;
    }

    function detailDataBerandaById($conn){
        if(isset($_GET['id_masalah'])) {
            $id_masalah = $_GET['id_masalah'];
            $data = getDetailDataBerandaById($conn, $id_masalah);
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }




?>
