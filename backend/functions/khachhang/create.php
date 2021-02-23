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
                    <h1 class="h2">Thêm mới Khách hàng</h1>
                </div>
                <a class="btn btn-primary" href="./">Quay lại</a>
                <form action="" method="get" name="frmCreate" id="frmCreate">
                    <button type="submit" name="btnSave" id="btnSave" class="btn btn-primary">Thêm</button>
                </form>
                <?php
                include_once(__DIR__ . '/../../../dbconnect.php');
                if (isset($_GET['btnSave'])) {
                    $lsp_ten = addslashes($_GET['lsp_ten']);
                    $lsp_mota = addslashes($_GET['lsp_mota']);
                    $sql = <<<EOT
                    INSERT INTO loaisanpham
                        (lsp_ten, lsp_mota)
                        VALUES ('$lsp_ten', '$lsp_mota');
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