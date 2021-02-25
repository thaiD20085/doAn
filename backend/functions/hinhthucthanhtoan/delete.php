<?php
    if(isset($_GET['httt_ma'])){
        $httt_ma = $_GET['httt_ma'];
        include_once(__DIR__ . '/../../../dbconnect.php');
        $sql = <<<EOT
            DELETE FROM hinhthucthanhtoan WHERE httt_ma= $httt_ma
EOT;
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        echo "<script>location.href = 'index.php';</script>";

    }