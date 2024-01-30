<?php
include_once('/var/www/html/app/models/accessModel.php');
function showAccessView($conn){
    $dataAsisten =getDataPengguna($conn);
    include('/var/www/html/app/views/access/access.php');
}

function processEditPeran($conn) {
    $id_pengguna = $_POST['id_pengguna'];
    $id_peran = $_POST['id_peran'];

    // Memanggil fungsi editPeran dan menyimpan hasilnya
    $result = editPeran($conn, $id_pengguna, $id_peran);

    // Mengecek apakah operasi berhasil atau tidak
    if ($result) {
        // Mengatur pesan sukses di sesi
        $_SESSION['success_message'] = 'Peran pengguna berhasil diubah.';
    } else {
        // Mengatur pesan gagal di sesi
        $_SESSION['failed_message'] = 'Gagal mengubah peran pengguna.';
    }

    // Mengambil data pengguna terbaru
    $dataAsisten = getDataPengguna($conn);

    // Mengarahkan kembali ke view
    include('/var/www/html/app/views/access/access.php');
}

?>
