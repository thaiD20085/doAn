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
                    <h1 class="h2">Thêm mới Loại sản phẩm</h1>
                </div>
                <a class="btn btn-primary" href="./">Quay lại</a>
                <?php
                if (isset($_GET['lsp_ma'])) {
                    
                    $lsp_ma = $_GET['lsp_ma'];

                    include_once(__DIR__ . '/../../../dbconnect.php');
                    $sql = <<<EOT
                    SELECT lsp_ma, lsp_ten, lsp_mota
                        FROM loaisanpham
                        WHERE lsp_ma= $lsp_ma;
EOT;
                    $result = mysqli_query($conn , $sql);
                    $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
                }
                else die();
                ?>
                <form action="" method="get" name="frmCreate" id="frmCreate">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mã Loại sản phẩm</label>
                        <input type="text" class="form-control" name="lsp_ma" id="lsp_ma" value="<?=$lsp_ma;?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên Loại sản phẩm</label>
                        <input type="text" class="form-control" name="lsp_ten" id="lsp_ten" value="<?=$data['lsp_ten'];?>">
                    </div>
                    <div class="form-group">
                        <label for="lsp_mota">Mô tả</label>
                        <textarea class="form-control" name="lsp_mota" id="lsp_mota" rows="3"><?=$data['lsp_mota'];?></textarea>
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