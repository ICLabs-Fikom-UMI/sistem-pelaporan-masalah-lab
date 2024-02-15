<?php
// UserProfileModel.php

function updateFotoProfil($conn, $userID, $uploadPath) {
    $query = "UPDATE user_table SET foto_path = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $uploadPath, $userID);

    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}

?>
