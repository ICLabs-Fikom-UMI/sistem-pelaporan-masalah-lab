<?php

//include
include('app/core/db.php');
include('app/controllers/loginController.php');
include('app/controllers/homeController.php');
include('app/controllers/reportsController.php');


$action = isset($_GET['action']) ? $_GET['action'] : 'showLoginForm';

switch ($action) {
    case 'showLoginForm':

        showLoginForm();
        break;

    case 'processLogin':
        $emailOrNim = $_POST['emailNim'];
        $password = $_POST['password'];

        processLogin($emailOrNim, $password, $conn);
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
        $id_lab = $_POST['id_lab'];
        $id_aset = $_POST['id_aset'];
        $no_unit = $_POST['no_unit'];
        $deskripsi = $_POST['deskripsi'];
        $ID_Pelapor = $_SESSION['user_id'];
        laporanCepat($id_lab, $id_aset, $no_unit, $deskripsi, $ID_Pelapor, $conn);
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
            // If the role is neither 'korlab' nor 'asisten', or the role is not set
            else {
                header("Location: index.php?action=home");
            }
            break;
        }
    case 'berikanTugas':
            $id_masalah = $_POST['id_masalah'];
            $id_teknisi = $_POST['id_teknisi'];
            $batas_waktu = $_POST['batas_waktu'];
            setujuiLaporan($conn, $id_masalah, $batas_waktu, $id_teknisi);
            break;
    default:
        echo "404 Not Found";
}


// Menutup koneksi setelah selesai digunakan
mysqli_close($conn);


?>
