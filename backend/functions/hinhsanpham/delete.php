<?php
    if(isset($_GET['hsp_ma'])){
        $hsp_ma = $_GET['hsp_ma'];
        include_once(__DIR__ . '/../../../dbconnect.php');
        $sql = <<<EOT
        DELETE FROM hinhsanpham WHERE hsp_ma= $hsp_ma
EOT;
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        echo "<script>location.href = 'index.php';</script>";

    }