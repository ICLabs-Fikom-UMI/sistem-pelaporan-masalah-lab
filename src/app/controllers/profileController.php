<?php
include_once('app/models/profileModel.php');

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

// ubah password
function processUbahPasswordAjax($conn) {
    header('Content-Type: application/json');
    $response = ['success' => false, 'message' => ''];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idPengguna = $_POST['id_masalah'] ?? ''; // Pastikan parameter yang dikirim sesuai
        $passwordBaru = $_POST['password_baru'] ?? '';

        // Validasi input
        if (empty($idPengguna) || empty($passwordBaru)) {
            $response['message'] = 'ID pengguna dan password baru tidak boleh kosong.';
        } else {
            // Hash password baru sebelum menyimpan ke database
            $passwordBaruHash = password_hash($passwordBaru, PASSWORD_DEFAULT);

            $result = ubahPasswordById($conn, $idPengguna, $passwordBaruHash);

            if ($result) {
                $response['success'] = true;
                $response['message'] = 'Password berhasil diubah.';
            } else {
                $response['message'] = 'Gagal mengubah password.';
            }
        }
    } else {
        $response['message'] = 'Invalid request method.';
    }

    echo json_encode($response);
    exit;
}


// submitEditProfile
function handleUpdateUserRequest($conn) {
    // Contoh pengambilan data dari $_POST, validasi seharusnya lebih komprehensif
    $userID = $_SESSION['user_id'];
    $namaDepan = $_POST['nama_depan'];
    $namaBelakang = $_POST['nama_belakang'];
    $email = $_POST['email'];
    $nim = $_POST['nim'];

    // Memanggil fungsi model untuk update data
    $updateSuccess = updateUserData($conn, $userID, $namaDepan, $namaBelakang, $email, $nim);

    // Membuat response berdasarkan hasil update
    if ($updateSuccess) {
        echo json_encode(array('success' => true, 'message' => 'Data pengguna berhasil diperbarui.'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Gagal memperbarui data pengguna.'));
    }
}



?>
