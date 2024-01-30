<?php
include_once('/var/www/html/app/models/accessModel.php');
function showAccessView($conn){
    $dataAsisten =getDataPengguna($conn);
    include('/var/www/html/app/views/access/access.php');
}
?>
