<?php
include_once(__DIR__ . '/../../../dbconnect.php');
$hsp_ma = $_GET['hsp_ma'];
$sqlSelect = "SELECT * FROM `hinhsanpham` WHERE hsp_ma=$hsp_ma;";
$resultSelect = mysqli_query($conn, $sqlSelect);
$hinhsanphamRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC); // 1 record
$upload_dir = "/project-d20085/assets/uploads/";
$subdir = 'products/';
$old_file = $upload_dir . $subdir . $hinhsanphamRow['hsp_tentaptin'];
if (file_exists($old_file)) {
    // Hàm unlink(filepath) dùng để xóa file trong PHP
    unlink($old_file);
}
$hsp_ma = $_GET['hsp_ma'];
$sql = "DELETE FROM `hinhsanpham` WHERE hsp_ma=" . $hsp_ma;
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
header('location:index.php');