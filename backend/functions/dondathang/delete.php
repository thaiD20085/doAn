<?php
include_once(__DIR__. '/../../../dbconnect.php');
$dh_ma = $_GET['dh_ma'];
$sql = <<<EOT
    DELETE FROM sanpham_dondathang WHERE dh_ma=$dh_ma
EOT;
mysqli_query($conn, $sql);
$sql2 = <<<EOT
    DELETE FROM dondathang WHERE dh_ma=$dh_ma
EOT;
mysqli_query($conn, $sql2);

