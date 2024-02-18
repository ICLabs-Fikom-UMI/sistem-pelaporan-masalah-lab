<?php
function showViewProfile($conn){
    include('/var/www/html/app/views/profile/profile.php');
}

// Asumsikan UserProfileModel.php sudah di-include atau di-require di awal file

function processUploadFotoProfile($conn) {
    $response = array('success' => false, 'message' => '');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['foto_profile']) && $_FILES['foto_profile']['error'] == 0) {
            $foto = $_FILES['foto_profile'];
            $uploadDir = "public/foto/";
            $fileName = basename($foto['name']);
            $uploadPath = $uploadDir . $fileName;
            $fileType = pathinfo($uploadPath, PATHINFO_EXTENSION);

            $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($foto['tmp_name'], $uploadPath)) {
                    $userID = $_SESSION['user_id'];

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

    echo json_encode($response);
    exit;
}


?>
