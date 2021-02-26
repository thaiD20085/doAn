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
                <div class="row">
                    <div class="col">
                        <h1 class="h2">Thêm mới</h1>
                    </div>
                    <div class="col-auto">
                        <a href="./"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại</a>
                    </div>
                </div>
                <?php
                $hsp_ma = $_GET['hsp_ma'];
                include_once(__DIR__ . '/../../../dbconnect.php');
                $sql = <<<EOT
                SELECT hsp_ma, hsp_tentaptin, sp.sp_ma, sp_ten, sp_gia
                    FROM hinhsanpham hsp
                    LEFT JOIN sanpham sp ON hsp.sp_ma = sp.sp_ma
                    WHERE hsp_ma = $hsp_ma
EOT;
                $result = mysqli_query($conn, $sql);
                $data =  mysqli_fetch_array($result, MYSQLI_ASSOC);

                ?>
                <form name="frmhinhsanpham" id="frmhinhanpham" method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="sp_ma">Sản phẩm</label>
                        <input class="form-control" id="sp_tt" name="sp_tt" value="
                            <?php echo sprintf(
                                "Sản phẩm %s, giá: %s",
                                $data['sp_ten'],
                                number_format($data['sp_gia'], 2, ".", ",") . ' vnđ'
                            ); ?>" readonly />
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg">
                            <img src="../../../assets/uploads/products/<?= $data['hsp_tentaptin'] ?>" width="200px" />
                        </div>
                        <div class="form-group col-lg">
                            <label for="hsp_tentaptin">Tập tin ảnh</label>

                            <!-- Tạo khung div hiển thị ảnh cho người dùng Xem trước khi upload file lên Server -->
                            <div class="preview-img-container">
                                <img src="../../../assets/uploads/products/default-image_600.png" id="preview-img" width="200px" />
                            </div>

                            <!-- Input cho phép người dùng chọn FILE -->
                            <input type="file" class="form-control" id="hsp_tentaptin" name="hsp_tentaptin">
                        </div>
                    </div>
                    <button class="btn btn-primary" name="btnSave">Lưu</button>
                    <a href="index.php" class="btn btn-outline-secondary" name="btnBack" id="btnBack">Quay về</a>
                </form>
                <?php
                if (isset($_POST['btnSave'])) {
                    $hsp_ma = $_GET['hsp_ma'];

                    // Nếu người dùng có chọn file để upload
                    if (isset($_FILES['hsp_tentaptin'])) {
                        $upload_dir = __DIR__ . "/../../../assets/uploads/";
                        $subdir = 'products/';
                        if ($_FILES['hsp_tentaptin']['error'] > 0) {
                            echo 'File Upload Bị Lỗi';
                            die;
                        } else {
                            $old_file = $upload_dir . $subdir . $hinhsanphamRow['hsp_tentaptin'];
                            if (file_exists($old_file)) {
                                unlink($old_file);
                            }
                            $hsp_tentaptin = $_FILES['hsp_tentaptin']['name'];
                            $tentaptin = date('YmdHis') . '_' . $hsp_tentaptin;
                            move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'], $upload_dir . $subdir . $tentaptin);
                        }
                        $sql = "UPDATE `hinhsanpham` SET hsp_tentaptin='$tentaptin' WHERE hsp_ma=$hsp_ma;";
                        mysqli_query($conn, $sql);
                        mysqli_close($conn);
                        echo '<script>location.href = "index.php";</script>';
                    }
                }
                ?>
            </main>
        </div>
    </div>
    <!-- FOOTER -->
    <?php include_once(__DIR__ . '/../../partials/footer.php'); ?>
    <!--SCRiPTS-->
    <?php include_once(__DIR__ . '/../../../backend/layouts/scripts.php'); ?>
    <script>
        // Hiển thị ảnh preview (xem trước) khi người dùng chọn Ảnh
        const reader = new FileReader();
        const fileInput = document.getElementById("hsp_tentaptin");
        const img = document.getElementById("preview-img");
        reader.onload = e => {
            img.src = e.target.result;
        }
        fileInput.addEventListener('change', e => {
            const f = e.target.files[0];
            reader.readAsDataURL(f);
        })
    </script>
</body>

</html>