<?php
include_once('/var/www/html/app/models/navbarModel.php');
function handleProfilePictureRequest($conn) {
    // Pastikan ID pengguna tersedia, misal dari session atau input lain
    $userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    if ($userID) {
        $fotoPath = getProfilePicturePath($conn, $userID);
        if ($fotoPath) {
            $response = array('success' => true, 'fotoPath' => $fotoPath);
        } else {
            $response = array('success' => false, 'message' => 'Foto profil tidak ditemukan.');
        }
    } else {
        $response = array('success' => false, 'message' => 'User ID tidak ditemukan.');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

?>
