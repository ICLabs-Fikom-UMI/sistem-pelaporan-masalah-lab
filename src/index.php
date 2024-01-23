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
                // Assuming $_POST['id_masalah'] is an array of all the masalah IDs
            foreach ($_POST['id_masalah'] as $id_masalah) {
                // Construct the names of the dynamic fields
                $batasWaktuField = 'batas_waktu_' . $id_masalah;
                $idTeknisiField = 'id_teknisi_' . $id_masalah;

                // Check if these fields exist in $_POST
                if (isset($_POST[$batasWaktuField]) && isset($_POST[$idTeknisiField])) {
                    $batas_waktu = $_POST[$batasWaktuField];
                    $id_teknisi = $_POST[$idTeknisiField];

                    // Call the function with these values
                    setujuiLaporan($conn, $id_masalah, $batas_waktu, $id_teknisi);
                }
            }
            break;
    default:
        echo "404 Not Found";
}


// Menutup koneksi setelah selesai digunakan
mysqli_close($conn);


?>
