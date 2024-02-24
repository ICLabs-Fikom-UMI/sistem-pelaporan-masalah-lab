<?php
function getProfilePicturePath($conn, $userID) {
    $userID = mysqli_real_escape_string($conn, $userID);
    $query = "SELECT Foto_Path FROM master_user WHERE ID_Pengguna = '$userID' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['Foto_Path'];
    } else {
        return false; // atau return path default gambar
    }
}

?>
