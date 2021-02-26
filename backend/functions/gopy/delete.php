<?php
if (isset($_GET['gy_ma'])) {
    $gy_ma = $_GET['gy_ma'];
    include_once(__DIR__ . '/../../../dbconnect.php');
    $sql = <<<EOT
        DELETE FROM gopy WHERE gy_ma='$gy_ma'
EOT;
    mysqli_query($conn, $sql);
    header('Location: ./');
}
