<?php
include_once('/var/www/html/app/models/profileModel.php');

function showViewProfile($conn){
    include('/var/www/html/app/views/profile/profile.php');
}


function processUploadFotoProfile($conn) {
    $response = array('success' => false, 'message' => '');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;


        if (isset($_FILES['foto_input']) && $_FILES['foto_input']['error'] == 0 && $userID) {
            $foto = $_FILES['foto_input'];
            $uploadDir = "public/foto/";
            $fileName = "profile_" . $userID . '_' . basename($foto['name']);// Menambahkan user_id ke nama file untuk membuatnya unik
            $uploadPath = $uploadDir . $fileName;
            $fileType = pathinfo($uploadPath, PATHINFO_EXTENSION);

            $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($foto['tmp_name'], $uploadPath)) {

                    // Panggil fungsi model untuk update database
                    if (updateFotoProfil($conn, $userID, $uploadPath)) {
                        $response['success'] = true;
                        $response['message'] = "Foto profil berhasil diunggah.";

                    } else {
                        $response['message'] = "Gagal menyimpan path foto ke database.";
                    }
                } else {
                    $response['message'] = "Gagal mengunggah file.";
                }
            } else {
                $response['message'] = "Format file tidak diizinkan.";
            }
        } else {
            $response['message'] = "Tidak ada file yang diupload atau terjadi kesalahan.";
        }
    } else {
        $response['message'] = "Metode request tidak valid.";
    }
    // Menetapkan header content-type untuk JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}



?>
