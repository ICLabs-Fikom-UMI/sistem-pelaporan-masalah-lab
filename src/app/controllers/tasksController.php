<?php
include_once('/var/www/html/app/models/tasksModel.php');
function showTasksView($conn) {
    $reports =getAllTaskById($conn);
    include('/var/www/html/app/views/tasks/tasks.php');
}

function taskDetail($conn, $id_masalah){
    $reports =getAllTaskById($conn);
    $reportsById = getTaskById($conn, $id_masalah);
    include('/var/www/html/app/views/tasks/tasks.php');
}

function tasksPenyelesaian($conn, $id_masalah, $foto_path, $komentar) {
    $targetDir = "public/foto/";
    $fileType = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);

    // Membuat nama file baru dengan format task_[id_masalah]_[timestamp].[ekstensi]
    $timestamp = time();
    $fileName = "task_{$id_masalah}_{$timestamp}.{$fileType}";
    $targetFilePath = $targetDir . $fileName;

    $uploadSuccess = false;

    if(isset($_POST["submit"]) && !empty($_FILES["foto"]["name"])){
        // Izinkan format file tertentu
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if(in_array($fileType, $allowTypes)){
            // Unggah file ke server
            if(move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFilePath)){
                // File berhasil diunggah
                $uploadSuccess = true;
            } else{
                $error_msg = "Gagal mengunggah file Anda.";
            }
        } else{
            $error_msg = "Maaf, hanya file JPG, JPEG, PNG, & GIF yang diizinkan.";
        }
    }

    if ($uploadSuccess) {
        $updateResult = updateDatabaseWithFile($conn, $id_masalah, $fileName, $komentar);
        if ($updateResult) {
            // Tetapkan pesan sukses ke session
            $_SESSION['Success_Message'] = "Anda berhasil Menyelesaikan tugas.";
        } else {
            // Tetapkan pesan error ke session atau handle error
            $_SESSION['Error_Message'] = "Gagal memperbarui data.";
        }
    }

    $reports = getAllTaskById($conn);
    include('/var/www/html/app/views/tasks/tasks.php');
}


?>
