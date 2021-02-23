<?php
    if(isset($_GET['kh_tendangnhap'])){
        $kh_tendangnhap = $_GET['kh_tendangnhap'];
        include_once(__DIR__ . '/../../../dbconnect.php');
        $sql = <<<EOT
        DELETE FROM khachhang WHERE kh_tendangnhap='$kh_tendangnhap'
EOT;
        mysqli_query($conn, $sql);
        header('Location: ./');
    }