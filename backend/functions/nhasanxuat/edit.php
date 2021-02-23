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
                <?php
                if (isset($_GET['nsx_ma'])) {
                    
                    $nsx_ma = $_GET['nsx_ma'];

                    include_once(__DIR__ . '/../../../dbconnect.php');
                    $sql = <<<EOT
                    SELECT nsx_ma, nsx_ten
                        FROM nhasanxuat
                        WHERE nsx_ma= $nsx_ma
EOT;
                    $result = mysqli_query($conn , $sql);
                    $data = mysqli_fetch_array($result,MYSQLI_ASSOC);
                }
                else die();
                ?>
                <form action="" method="get" name="frmCreate" id="frmCreate">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mã Nhà sản xuất</label>
                        <input type="text" class="form-control" name="nsx_ma" id="nsx_ma" value="<?=$nsx_ma;?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên Nhà sản xuất</label>
                        <input type="text" class="form-control" name="nsx_ten" id="nsx_ten" value="<?=$data['nsx_ten'];?>">
                    </div>

                    <button type="submit" name="btnSave" id="btnSave" class="btn btn-primary">Lưu</button>
                </form>
                <?php
                if (isset($_GET['btnSave'])) {
                    $nsx_ten = addslashes($_GET['nsx_ten']);
                    $sql = <<<EOT
                        UPDATE nhasanxuat
                        SET
                            nsx_ten='$nsx_ten'
                        WHERE nsx_ma=$nsx_ma;
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