<?php
    if(isset($_GET['cdgy_ma'])){
        $cdgy_ma = $_GET['cdgy_ma'];
        include_once(__DIR__ . '/../../../dbconnect.php');
        $sql = <<<EOT
            DELETE FROM chudegopy WHERE cdgy_ma= $cdgy_ma
EOT;
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        echo "<script>location.href = 'index.php';</script>";

    }