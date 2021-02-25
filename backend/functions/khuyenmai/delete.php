<?php
    if(isset($_GET['km_ma'])){
        $km_ma = $_GET['km_ma'];
        include_once(__DIR__ . '/../../../dbconnect.php');
        $sql = <<<EOT
            DELETE FROM khuyenmai WHERE km_ma= $km_ma
EOT;
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        echo "<script>location.href = 'index.php';</script>";

    }