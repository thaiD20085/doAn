<?php
if (session_id() == null) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once(__DIR__ . '/../layouts/config.php'); ?>

<head>
    <?php include_once(__DIR__ . '/../layouts/head.php'); ?>
    <style>
        .hinhdaidien {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <!-- header -->
    <?php include_once(__DIR__ . '/../partials/header.php') ?>
    <!-- end header -->

    <main role="main" class="mb-2">
        <!-- Block content -->
        <?php
        // Truy vấn database để lấy danh sách
        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
        include_once(__DIR__ . '/../../dbconnect.php');
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
        $kh_tendangnhap = $_SESSION['kh_tendangnhap_logged'];
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
        // Kiểm tra dữ liệu trong session
        $giohangdata = [];
        if (isset($_SESSION['giohangdata'])) {
            $giohangdata = $_SESSION['giohangdata'];
        } else {
            $giohangdata = [];
        }
        ?>
        <div class="container mt-4">
            <!-- Vùng ALERT hiển thị thông báo -->
            <div id="alert-container" class="alert alert-warning alert-dismissible fade d-none" role="alert">
                <div id="thongbao">&nbsp;</div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <h1 class="text-center">Đặt hàng</h1>
            <form name="frmCreate" id="frmCreate" method="post" action="">
                <fieldset id="donHangContainer">
                    <legend>Thông tin Đơn hàng</legend>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label>Khách hàng</label>
                                <input class="form-control" type="text" value="<?php echo sprintf("Họ tên %s, số điện thoại: %s", $dataKhachHang['kh_ten'], $dataKhachHang['kh_dienthoai']); ?>" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-8">
                            <label>Nơi giao</label>
                            <input type="text" name="dh_noigiao" id="dh_noigiao" class="form-control" />
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Hình thức thanh toán</label>
                            <select name="httt_ma" id="httt_ma" class="form-control">
                                <option value="">Vui lòng chọn Hình thức thanh toán</option>
                                <?php foreach ($dataHinhThucThanhToan as $httt) : ?>
                                    <option value="<?= $httt['httt_ma'] ?>"><?= $httt['httt_ten'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </fieldset>

                <fieldset id="chiTietDonHangContainer">
                    <legend>Thông tin Chi tiết Đơn hàng</legend>
                    <table id="tblChiTietDonHang" class="table table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </thead>
                        <tbody>
                            <?php $stt = 1; ?>
                            <?php foreach ($giohangdata as $sp) : ?>
                                <tr>
                                    <td><?= $stt++; ?></td>
                                    <td><?= $sp['sp_ten'] ?><input type="hidden" name="sp_ma[]" value="<?= $sp['sp_ma'] ?>" /></td>
                                    <td> <img src="/project-D20085/assets/uploads/products/<?= $sp['hinhdaidien'] ?>" class="img-fluid hinhdaidien" /> </td>
                                    <td><?= $sp['soluong'] ?><input type="hidden" name="sp_dh_soluong[]" value="<?= $sp['soluong'] ?>" /></td>
                                    <td><?= number_format($sp['gia'], 2, ".", ",") ?> vnđ<input type="hidden" name="sp_dh_dongia[]" value="<?= $sp['gia'] ?>" /></td>
                                    <td><?= number_format($sp['soluong'] * $sp['gia'], 2, ".", ",") ?> vnđ</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </fieldset>
                <button class="btn btn-primary" name="btnSave">Lưu</button>
                <a href="index.php" class="btn btn-outline-secondary" name="btnBack" id="btnBack">Quay về</a>
            </form>
            <?php
            if (isset($_POST['btnSave'])) {
                // 1. Phân tách lấy dữ liệu người dùng gởi từ REQUEST POST
                // Thông tin đơn hàng
                $dh_noigiao = addslashes($_POST['dh_noigiao']);
                $httt_ma = addslashes($_POST['httt_ma']);
                // Thông tin các dòng chi tiết đơn hàng
                $arr_sp_ma = $_POST['sp_ma'];
                $arr_sp_dh_soluong = $_POST['sp_dh_soluong'];
                $arr_sp_dh_dongia = $_POST['sp_dh_dongia'];
                // var_dump($sp_ma);die;

                // 2. Thực hiện câu lệnh Tạo mới (INSERT) Đơn hàng
                // Câu lệnh INSERT
                $sqlInsertDonHang = "INSERT INTO `dondathang` (`dh_ngaylap`, `dh_ngaygiao`, `dh_noigiao`, `dh_trangthaithanhtoan`, `httt_ma`, `kh_tendangnhap`) VALUES (NOW(), '', '$dh_noigiao', 0, '$httt_ma', '$kh_tendangnhap')";

                // Thực thi INSERT Đơn hàng
                mysqli_query($conn, $sqlInsertDonHang);
                $dh_ma = $conn->insert_id;

                // 4. Duyệt vòng lặp qua mảng các dòng Sản phẩm của chi tiết đơn hàng được gởi đến qua request POST
                for ($i = 0; $i < count($arr_sp_ma); $i++) {
                    // 4.1. Chuẩn bị dữ liệu cho câu lệnh INSERT vào table `sanpham_dondathang`
                    $sp_ma = $arr_sp_ma[$i];
                    $sp_dh_soluong = $arr_sp_dh_soluong[$i];
                    $sp_dh_dongia = $arr_sp_dh_dongia[$i];
                    // echo $sp_ma.'-'.$sp_dh_soluong.'-'.$sp_dh_dongia.'<br />';
                    // 4.2. Câu lệnh INSERT
                    $sqlInsertSanPhamDonDatHang = "INSERT INTO `sanpham_dondathang` (`sp_ma`, `dh_ma`, `sp_dh_soluong`, `sp_dh_dongia`) VALUES ($sp_ma, $dh_ma, $sp_dh_soluong, $sp_dh_dongia)";

                    // 4.3. Thực thi INSERT

                    if (mysqli_query($conn, $sqlInsertSanPhamDonDatHang))
                        unset($_SESSION['giohangdata']);
                }

                // 5. Thực thi hoàn tất, điều hướng về trang Danh sách
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
        </div>
        <!-- End block content -->
    </main>

    <!-- footer -->
    <!--Footer-->
    <?php include_once(__DIR__ . '/../partials/footer.php'); ?>

    <!--SCRIPT-->
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
    <script>
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
    </script>
</body>

</html>