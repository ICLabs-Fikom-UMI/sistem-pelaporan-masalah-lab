<?php

//include
include('app/core/db.php');
include('app/controllers/loginController.php');
include('app/controllers/homeController.php');
include('app/controllers/reportsController.php');
include('app/controllers/tasksController.php');
include('app/controllers/labsController.php');
include('app/controllers/accessController.php');


$action = isset($_GET['action']) ? $_GET['action'] : 'showLoginForm';

// Check if the user is logged in for actions other than login-related ones
if (!in_array($action, ['showLoginForm', 'processLogin'])) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?action=showLoginForm');
        exit;
    }
}
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
            showViewHome($conn);
        } else{
            header('Location: index.php');
            exit;
        }
        break;
    case 'laporan-cepat':
        laporanCepat($conn);
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
        foreach ($_POST['id_masalah'] as $id_masalah) {
            // Construct the names of the dynamic fields
            $batasWaktuField = 'batas_waktu_' . $id_masalah;
            $idTeknisiField = 'id_teknisi_' . $id_masalah;
            $deskripsiMasalahField = 'deskripsi_masalah_' . $id_masalah; // Field baru untuk deskripsi masalah

            // Check if these fields exist in $_POST
            if (isset($_POST[$batasWaktuField]) && isset($_POST[$idTeknisiField])) {
                $batas_waktu = $_POST[$batasWaktuField];
                $id_teknisi = $_POST[$idTeknisiField];
                $deskripsi_masalah = $_POST[$deskripsiMasalahField] ?? null; // Mengambil deskripsi masalah, jika ada

                // Call the function with these values
                setujuiLaporan($conn, $id_masalah, $batas_waktu, $id_teknisi, $deskripsi_masalah);
            }
        }
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


// Menutup koneksi setelah selesai digunakan
mysqli_close($conn);


?>
