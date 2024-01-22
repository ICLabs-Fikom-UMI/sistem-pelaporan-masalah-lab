<?php
function getDataLab() {
    $result = mysqli_query($conn, "SELECT ID_Lab, Nama_Lab FROM master_lab");
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $users;
}
?>
