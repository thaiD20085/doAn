<?php
include_once(__DIR__ . '/../../../dbconnect.php');
$hsp_ma = $_GET['hsp_ma'];
$sql_oldrow = <<<EOT
SELECT hsp_ma, hsp_tentaptin, sp_ma
FROM hinhsanpham
WHERE hsp_ma = $hsp_ma;
EOT;
$result = mysqli_query($conn , $sql_oldrow);
$hinhsanphamRow = mysqli_fetch_array($result, MYSQLI_ASSOC);

$upload_dir = __DIR__ . "/../../../assets/uploads/products/";

$old_file = $upload_dir . $hinhsanphamRow['hsp_tentaptin'];
if (file_exists($old_file)) {
    // Hàm unlink(filepath) dùng để xóa file trong PHP
    unlink($old_file);
}

$sqlDelete = "DELETE FROM hinhsanpham WHERE hsp_ma=$hsp_ma";
$result2 = mysqli_query($conn, $sqlDelete);
mysqli_close($conn);
header('location:index.php');