<?php
function getUserByEmail($email, $conn) {
    // $query = "SELECT * FROM master_user WHERE Email = ?";
    $query = "SELECT master_user.*, master_roles.Nama_Peran FROM master_user
              JOIN master_roles ON master_user.ID_Peran = master_roles.ID_Peran
              WHERE Email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}
function getUserByNim($nim, $conn){
    $query = "SELECT master_user.*, master_roles.Nama_Peran FROM master_user
              JOIN master_roles ON master_user.ID_Peran = master_roles.ID_Peran
              WHERE Nim = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $nim);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}
?>
