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
    case 'laporan-saya':
        getLaporanSayaAjax($conn);
        break;
    case 'laporan-masuk':
        getLaporanMasukAjax($conn);
        break;
    case 'profile':
        showViewProfile($conn);
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
    // templates
    case 'jenis-barang':
        getJenisBarangAjax($conn);
        break;
    case 'nama-lab':
        getNamaLabAjax($conn);
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
    case 'berikanTugas':
        setujuiLaporan($conn);
        break;
    case 'tolakLaporan':
        $id_masalah = $_GET['id_masalah'] ?? null;
        if($id_masalah){
            tolakLaporan($conn, $id_masalah);
        }else{
            showViewReportKorlab($conn);
        }
        break;
    case 'detailLaporan':
        $id_masalah = $_GET['id_masalah'] ?? null;
        if($id_masalah){
            detailLaporan($conn, $id_masalah);
        }else{
            showViewReportKorlab($conn);
        }
        break;
    case 'getEditLaporan':
        dataEditLaporan($conn);
        break;
    case 'editLaporan':
        editLaporan($conn);
        break;
    case 'DetailSelesai':
        processDetailSelesai($conn);
        break;
    case 'tasks':
        showTasksView($conn);
        break;
    case 'tasksDetail':
        taskDetail($conn);
        break;
    case 'tasksPenyelesaian':
        tasksPenyelesaian($conn);
        break;
    case 'labs':
        showLabsView($conn);
        break;
    case 'access':
        showAccessView($conn);
        break;
    case 'peranBaru':
        echo '<script>console.log("Anda berhasil mengakses peran baru");</script>';
        processEditPeran($conn);
        break;
    case 'detailPengguna':
        detailDataById($conn);
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
