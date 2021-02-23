<?php
    if(isset($_GET['nsx_ma'])){
        $nsx_ma = $_GET['nsx_ma'];
        include_once(__DIR__ . '/../../../dbconnect.php');
        $sql = <<<EOT
            DELETE FROM nhasanxuat WHERE nsx_ma=$nsx_ma
EOT;
        mysqli_query($conn, $sql);
        echo "<script>location.href = 'index.php';</script>";

    }