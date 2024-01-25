<?php
function getDataLab($conn) {
        $result = mysqli_query($conn, "SELECT ID_Lab, Nama_Lab FROM master_lab");
        $lab = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $lab;
    }
function getDataAset($conn) {
        $result = mysqli_query($conn, "SELECT ID_Aset, Nama_Aset FROM master_aset_lab");
        $aset = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $aset;
}

function getUser($conn) {
    $sql = "SELECT u.ID_Pengguna, u.Nama_Depan
            FROM master_user u
            INNER JOIN master_roles r ON u.ID_Peran = r.ID_Peran
            WHERE r.Nama_Peran = 'Asisten'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    return $users;
}

?>
