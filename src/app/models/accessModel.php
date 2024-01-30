<?php
function getDataPengguna($conn) {
    // SQL query to join the master_user and master_roles tables
    $sql = "SELECT master_user.ID_Pengguna, master_user.Nama_Depan, master_user.Nama_Belakang, master_roles.Nama_Peran
            FROM master_user
            INNER JOIN master_roles ON master_user.ID_Peran = master_roles.ID_Peran";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Fetch all rows as an associative array
    $dataAsisten = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $dataAsisten;
}


?>
