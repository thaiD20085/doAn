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
                    <h1 class="h2">Thêm mới Nhà sản xuất</h1>
                </div>
                <a class="btn btn-primary" href="./">Quay lại</a>
                <form action="" method="get" name="frmCreate" id="frmCreate">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mã Nhà sản xuất</label>
                        <input type="text" class="form-control" name="nsx_ma" id="nsx_ma" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên Nhà sản xuất</label>
                        <input type="text" class="form-control" name="nsx_ten" id="nsx_ten">
                    </div>

                    <button type="submit" name="btnSave" id="btnSave" class="btn btn-primary">Thêm</button>
                </form>
                <?php
                include_once(__DIR__ . '/../../../dbconnect.php');
                if (isset($_GET['btnSave'])) {
                    $nsx_ten = addslashes($_GET['nsx_ten']);
                    $sql = <<<EOT
                        INSERT INTO nhasanxuat
                            (nsx_ten)
                            VALUES ('$nsx_ten')
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