<?php

//require_once
require_once('app/core/db.php');
require_once('app/controllers/loginController.php');
require_once('app/controllers/homeController.php');
require_once('app/controllers/reportsController.php');
require_once('app/controllers/tasksController.php');
require_once('app/controllers/labsController.php');
require_once('app/controllers/accessController.php');
require_once('app/controllers/profileController.php');
require_once('app/controllers/navbarController.php');


$action = isset($_GET['action']) ? $_GET['action'] : 'showLoginForm';

// Check if the user is logged in for actions other than login-related ones
// if (!in_array($action, ['showLoginForm', 'processLogin', 'beranda', 'detailPengguna'])) {
//     if (!isset($_SESSION['user_id'])) {
//         header('Location: index.php?action=showLoginForm');
//         exit;
//     }
// }
// Restrict access to 'tasks' for 'Laboran' and 'Korlab' roles
if ($action == 'tasks' && isset($_SESSION['role']) && in_array($_SESSION['role'], ['Laboran', 'Korlab'])) {
    header('Location: index.php?action=home');
    exit;
}

switch ($action) {
    case 'showLoginForm':
            if (isset($_SESSION['user_id'])) {
                header('Location: index.php?action=home');
                exit;
            }
            showLoginForm();
        break;

    case 'processLogin':
        processLogin($conn);
        break;
    case 'logout':
        session_destroy();
        header('Location: index.php');
        exit;
        break;
    case 'home':
        if(isset($_SESSION['user_id'])){
            include('app/views/home/home-baru.php');
        } else{
            header('Location: index.php');
            exit;
        }
        break;
    case 'beranda':
        getPermasalahanLabAjax($conn);
        break;
    case 'beranda-detail':
        detailDataBerandaById($conn);
        break;
    // laporan saya
    case 'laporan-saya':
        getLaporanSayaAjax($conn);
        break;
    case 'laporan-saya-by-id':
        getLaporanSayaByIdAjax($conn);
        break;
    case 'laporan-saya-get-edit':
        getLaporanSayaByIdAjax($conn);
        break;
    case 'laporan-saya-submit-edit':
        editLaporanSayaAjax($conn);
        break;
    case 'hapus-laporan-saya-by-id':
        processHapusLaporanSayaByIdAjax($conn);
        break;
    // laporan masuk
    case 'laporan-masuk':
        getLaporanMasukAjax($conn);
        break;
    case 'tolak-laporan-masuk-by-id':
        processTolakLaporanMasukByIdAjax($conn);
        break;
    case 'tugas':
        getTugasAjax($conn);
        break;
    case 'beri-akses':
        getBeriAksesAjax($conn);
        break;
    case 'tambahUser':
        processTambahUser($conn);
        break;
    case 'laporan-cepat':
        laporanCepat($conn);
        break;
    case 'tasksDetail':
        taskDetailAjax($conn);
        break;
    case 'tasksPenyelesaian':
        tasksPenyelesaianAjax($conn);
        break;
    // profile
    case 'profile':
        showViewProfile($conn);
        break;
    case 'profile-ubah-password':
        processUbahPasswordAjax($conn);
        break;
    case 'uploadFotoProfile':
        processUploadFotoProfile($conn);
        break;
    // ubah data profile
    case 'detailPengguna':
        detailDataById($conn);
        break;
    case 'ubah-data-profile-submit':
        handleUpdateUserRequest($conn);
        break;
    // navbar
    case 'navbar-img-profile':
        handleProfilePictureRequest($conn);
        break;
    // templates
    case 'jenis-barang':
        getJenisBarangAjax($conn);
        break;
    case 'nama-lab':
        getNamaLabAjax($conn);
        break;
    case 'berikanTugas':
        setujuiLaporanAjax($conn);
        break;
    case 'reports':
        if(isset($_SESSION['user_id'])){
            // Check if the user's role is 'korlab'
            if ($_SESSION['role'] == 'Korlab') {
                showViewReportKorlab($conn);
            }
            // Check if the user's role is 'asisten'
            else if ($_SESSION['role'] == 'Asisten') {
                showViewReportAsisten($conn);
            }
        else {
                header("Location: index.php?action=home");
        }
            break;
        }

    case 'tolakLaporan':
        $id_masalah = $_GET['id_masalah'] ?? null;
        if($id_masalah){
            tolakLaporan($conn, $id_masalah);
        }else{
            showViewReportKorlab($conn);
        }
        break;
    case 'detailLaporanMasuk':
        detailLaporanMasukAjax($conn, $_GET['id_masalah']);
        break;
    case 'getEditLaporan':
        dataEditLaporan($conn);
        break;
    case 'DetailSelesai':
        processDetailSelesai($conn);
        break;
    case 'tasks':
        showTasksView($conn);
        break;

    case 'labs':
        showLabsView($conn);
        break;
    case 'access':
        showAccessView($conn);
        break;
    case 'peranBaru':
        processEditPeran($conn);
        break;
    case 'deletePengguna':
        processDeletePengguna($conn);
        break;
    case 'resetPassword':
        processResetPassword($conn);
        break;

    default:
        echo "404 Not Found";
}


?>
