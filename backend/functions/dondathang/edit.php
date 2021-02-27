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
                    <h1 class="h2">Thêm mới</h1>
                </div>
                <a class="btn btn-primary" href="./">Quay lại</a>

                <?php
                $dh_ma = $_GET['dh_ma'];
                // CSDL __________________________________________________
                include_once(__DIR__ . '/../../../dbconnect.php');
                $sql = <<<EOT
                SELECT dh_ngaylap, dh_ngaygiao, dh_noigiao, dh_trangthaithanhtoan, httt_ma, kh_tendangnhap
                    FROM dondathang
                    WHERE dh_ma = $dh_ma;
EOT;
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
                // HTTT __________________________________________________
                $sqlHinhThucThanhToan = "select * from `hinhthucthanhtoan`";
                $resultHinhThucThanhToan = mysqli_query($conn, $sqlHinhThucThanhToan);
                $dataHinhThucThanhToan = [];
                while ($rowHinhThucThanhToan = mysqli_fetch_array($resultHinhThucThanhToan, MYSQLI_ASSOC)) {
                    $dataHinhThucThanhToan[] = array(
                        'httt_ma' => $rowHinhThucThanhToan['httt_ma'],
                        'httt_ten' => $rowHinhThucThanhToan['httt_ten'],
                    );
                }
                // KH ______________________________________________________
                $kh_tendangnhap = $data['kh_tendangnhap'];
                
                $sqlKhachHang = <<<EOT
                SELECT kh_ten, kh_dienthoai
	                FROM khachhang
                    WHERE kh_tendangnhap = '$kh_tendangnhap';
EOT;   
                $resultKhachHang = mysqli_query($conn, $sqlKhachHang);
                $dataKhachHang = mysqli_fetch_array($resultKhachHang, MYSQLI_ASSOC);
                // SP ______________________________________________________
                $sqlSanPham = "select * from `sanpham`";
                $resultSanPham = mysqli_query($conn, $sqlSanPham);
                $dataSanPham = [];
                while ($rowSanPham = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC)) {
                    $dataSanPham[] = array(
                        'sp_ma' => $rowSanPham['sp_ma'],
                        'sp_gia' => $rowSanPham['sp_gia'],
                        'sp_ten' => $rowSanPham['sp_ten'],
                    );
                }
                ?>
                <form name="frmhinhsanpham" id="frmhinhanpham" method="post" action="" enctype="multipart/form-data">
                    <legend>Thông tin Đơn hàng</legend>
                    <div class="form-row">

                        <div class="col">
                            <div class="form-group">
                                <label>Khách hàng</label>
                                <input class="form-control" value="<?php echo sprintf("Họ tên %s, số điện thoại: %s", $dataKhachHang['kh_ten'], $dataKhachHang['kh_dienthoai']); ?>" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label>Ngày lập</label>
                                <input type="text" name="dh_ngaylap" id="dh_ngaylap" value="<?=$data['dh_ngaylap']?>" class="form-control" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Ngày giao</label>
                                <input type="text" name="dh_ngaygiao" id="dh_ngaygiao" value="<?=$data['dh_ngaygiao']?>" class="form-control" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Nơi giao</label>
                                <input type="text" name="dh_noigiao" id="dh_noigiao" value="<?=$data['dh_noigiao']?>" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label>Trạng thái thanh toán</label><br />
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan-1" class="custom-control-input" value="0" <?php if ($data['dh_trangthaithanhtoan']==0) echo ' checked';?>>
                                    <label class="custom-control-label" for="dh_trangthaithanhtoan-1">Chưa thanh toán</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan-2" class="custom-control-input" value="1" <?php if ($data['dh_trangthaithanhtoan']!=0) echo ' checked';?>>
                                    <label class="custom-control-label" for="dh_trangthaithanhtoan-2">Đã thanh toán</label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Hình thức thanh toán</label>
                                <select name="httt_ma" id="httt_ma" class="form-control">
                                    <?php foreach ($dataHinhThucThanhToan as $httt) : ?>
                                        <option value="<?= $httt['httt_ma'] ?>" <?php if ($data['httt_ma']==$httt['httt_ma']) echo ' selected';?> ><?= $httt['httt_ten'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>



                    <button class="btn btn-primary" name="btnSave">Lưu</button>
                    <a href="index.php" class="btn btn-outline-secondary" name="btnBack" id="btnBack">Quay về</a>
                </form>
                <?php

                if (isset($_POST['btnSave'])) {
                    $dh_ngaylap = addslashes($_POST['dh_ngaylap']);
                    $dh_ngaygiao = addslashes($_POST['dh_ngaygiao']);
                    $dh_noigiao = addslashes($_POST['dh_noigiao']);
                    $dh_trangthaithanhtoan = $_POST['dh_trangthaithanhtoan'];
                    $httt_ma = $_POST['httt_ma'];

                    $sql_update =  <<<EOT
                    UPDATE dondathang
                        SET
                            dh_ngaylap='$dh_ngaylap',
                            dh_ngaygiao='$dh_ngaylap',
                            dh_noigiao='$dh_noigiao',
                            dh_trangthaithanhtoan=$dh_trangthaithanhtoan,
                            httt_ma= $httt_ma
                        WHERE dh_ma= $dh_ma                
EOT;    
                    // echo $sql_update;
                    mysqli_query($conn, $sql_update);
                    mysqli_close($conn);
                    echo '<script>location.href = "index.php";</script>';
                }
                ?>
                <?php if (
                    isset($_POST['btnSave'])
                    && isset($errors)
                    && (!empty($errors))
                ) : ?>
                    <div id="errors-container" class="alert alert-danger face my-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                            <?php foreach ($errors as $fields) : ?>
                                <?php foreach ($fields as $field) : ?>
                                    <li><?php echo $field['msg']; ?></li>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </main>
        </div>
    </div>
    <!-- FOOTER -->
    <?php include_once(__DIR__ . '/../../partials/footer.php'); ?>

    <?php include_once(__DIR__ . '/../../../backend/layouts/scripts.php'); ?>

    <script>
        $(document).ready(function() {
            $('#btnThemSanPham').click(function() {
                // debugger;
                // Lấy thông tin Sản phẩm
                var sp_ma = $('#sp_ma').val();
                var sp_gia = $('#sp_ma option:selected').data('sp_gia');
                var sp_ten = $('#sp_ma option:selected').text();
                var soluong = $('#soluong').val();
                var thanhtien = (soluong * sp_gia);


            });

            $("#frmCreate").validate({
                rules: {
                    sp_ten: {
                        required: true,
                        minlength: 5,
                        maxlength: 50
                    },
                },
                messages: {
                    sp_ten: {
                        required: "Vui lòng nhập tên sản phẩm",
                        min: "Tên sản phẩm phải có ít nhất 5 ký tự",
                        maxlength: "Tên sản phẩm không được vượt quá 50 ký tự"
                    },
                },
                errorElement: "em",
                errorPlacement: function(error, element) {
                    // Thêm class `invalid-feedback` cho field đang có lỗi
                    error.addClass("invalid-feedback");
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                success: function(label, element) {},
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });
        });
    </script>

</body>

</html>