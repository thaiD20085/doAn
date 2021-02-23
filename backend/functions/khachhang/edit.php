<?php
if (session_id() === '') {
    session_start();
}
?>
<?php include_once(__DIR__ . '/../../layouts/config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once(__DIR__ . '/../../layouts/head.php'); ?>
</head>

<body>
    <?php include_once(__DIR__ . '/../../partials/header.php') ?>
    <div class="container-fluid">
        <div class="row">
            <?php include_once(__DIR__ . '/../../partials/sidebar.php') ?>
            <main role="main" class=" col-md-10 ml-sm-auto px-4 mb-2">
                <div>
                    <h1 class="h2">Thiết lập thông tin Khách hàng</h1>
                </div>
                <a class="btn btn-primary" href="./">Quay lại</a>
                <?php
                if (isset($_GET['kh_tendangnhap'])) {
                    $kh_tendangnhap = $_GET['kh_tendangnhap'];
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    $sql = <<<EOT
                    SELECT kh_trangthai, kh_quantri
                        FROM khachhang
                        WHERE kh_tendangnhap = '$kh_tendangnhap';
EOT;
                    $result = mysqli_query($conn, $sql);
                    $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
                } else die();
                ?>
                <form action="" method="get" name="frmCreate" id="frmCreate">
                    <div class="form-group">
                        <label for="kh_tendangnhap">Tên đăng nhập</label>
                        <input type="text" class="form-control" name="kh_tendangnhap" id="kh_tendangnhap" value="<?= $kh_tendangnhap; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kh_trangthai">Trạng thái người dùng</label>
                        <select class="form-control" id="kh_trangthai" name="kh_trangthai">
                            <option value="1">Hoạt động</option>
                            <option value="0">Khoá</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kh_quantri">Quyền của người dùng</label>
                        <select class="form-control" id="kh_quantri" name="kh_quantri">
                            <option value="0">Khách hàng</option>
                            <option value="1">Quản trị</option>
                        </select>
                    </div>
                    <button type="submit" name="btnSave" id="btnSave" class="btn btn-primary">Lưu</button>
                </form>
                <?php
                if (isset($_GET['btnSave'])) {
                    $lsp_ten = addslashes($_GET['lsp_ten']);
                    $lsp_mota = addslashes($_GET['lsp_mota']);
                    $sql = <<<EOT
                    UPDATE loaisanpham
                    SET
                        lsp_ten='$lsp_ten',
                        lsp_mota='$lsp_mota'
                    WHERE lsp_ma=$lsp_ma;
EOT;
                    mysqli_query($conn, $sql);
                    echo "<script>location.href = 'index.php';</script>";
                }
                ?>
            </main>
        </div>
    </div>
    <!-- FOOTER -->
    <?php include_once(__DIR__ . '/../../partials/footer.php'); ?>

    <?php include_once(__DIR__ . '/../../../backend/layouts/scripts.php'); ?>
</body>

</html>