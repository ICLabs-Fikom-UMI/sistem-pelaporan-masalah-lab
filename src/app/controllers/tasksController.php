<?php
include_once('/var/www/html/app/models/tasksModel.php');
function getTugasAjax($conn) {
    $reports =getAllTaskById($conn);
    header('Content-Type: application/json');
    echo json_encode($reports);
}

// function taskDetailAjax($conn){
//     $id_masalah = $_GET['id_masalah'] ?? null;
//     if($id_masalah){
//         $reportsById = getTaskById($conn, $id_masalah);
//         header('Content-Type: application/json');
//         echo json_encode($reportsById);
//     } else {
//         $response = [
//             'error' => 'ID Masalah tidak ditemukan'
//         ];
//         header('Content-Type: application/json');
//         echo json_encode($response);
//     }
// }
function taskDetailAjax($conn){
    if(isset($_GET['id_masalah'])) {
        $id_masalah = $_GET['id_masalah'];
        $data = getTaskById($conn, $id_masalah);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
function tasksPenyelesaianAjax($conn) {
    header('Content-Type: application/json');
    $response = array('success' => false, 'message' => '');

    // Pastikan request adalah POST dan file telah diupload
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto_input']['name'])) {
        $id_masalah = $_POST['id_masalah'] ?? '';
        $komentar = $_POST['komentar_input'] ?? '-';
        $targetDir = "public/foto/";
        $fileType = pathinfo($_FILES["foto_input"]["name"], PATHINFO_EXTENSION);

        // Membuat nama file baru
        $timestamp = time();
        $fileName = "task_{$id_masalah}_{$timestamp}.{$fileType}";
        $targetFilePath = $targetDir . $fileName;

        // Izinkan format file tertentu
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if(in_array($fileType, $allowTypes)){
            // Unggah file ke server
            if(move_uploaded_file($_FILES["foto_input"]["tmp_name"], $targetFilePath)){
                $fileNameInDb = "public/foto/{$fileName}";
                $updateResult = updateDatabaseWithFile($conn, $id_masalah, $fileNameInDb, $komentar);
                if ($updateResult) {
                    $response['success'] = true;
                    $response['message'] = "Anda berhasil menyelesaikan tugas.";
                } else {
                    $response['message'] = "Gagal memperbarui database.";
                }
            } else{
                $response['message'] = "Gagal mengunggah file.";
            }
        } else{
            $response['message'] = "Maaf, hanya file JPG, JPEG, PNG, & GIF yang diizinkan.";
        }
    } else {
        $response['message'] = "Tidak ada data atau file yang dikirim.";
    }

    echo json_encode($response);
    exit;
}

?>
