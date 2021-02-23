<?php
if (isset($_GET['sp_ma'])) {
    $sp_ma = $_GET['sp_ma'];
    include_once(__DIR__ . '/../../../dbconnect.php');
    $sql = <<<EOT
        DELETE FROM sanpham WHERE sp_ma='$sp_ma'
EOT;
    mysqli_query($conn, $sql);
    header('Location: ./');
}
