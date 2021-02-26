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
                    <h1 class="h2">Thêm mới Sản phẩm</h1>
                </div>
                <a class="btn btn-primary" href="./">Quay lại</a>

                <?php
                // CSDL __________________________________________________
                include_once(__DIR__ . '/../../../dbconnect.php');
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
                $sqlKhachHang = "select * from `khachhang`";
                $resultKhachHang = mysqli_query($conn, $sqlKhachHang);
                $dataKhachHang = [];
                while ($rowKhachHang = mysqli_fetch_array($resultKhachHang, MYSQLI_ASSOC)) {
                    $kh_tomtat = sprintf(
                        "Họ tên %s, số điện thoại: %s",
                        $rowKhachHang['kh_ten'],
                        $rowKhachHang['kh_dienthoai']
                    );

                    $dataKhachHang[] = array(
                        'kh_tendangnhap' => $rowKhachHang['kh_tendangnhap'],
                        'kh_tomtat' => $kh_tomtat,
                    );
                }
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
                    <fieldset id="donHangContainer">
                        <legend>Thông tin Đơn hàng</legend>
                        <div class="form-row">
                            <!-- <div class="col">
                                <div class="form-group">
                                    <label>Mã Đơn hàng</label>
                                    <input type="text" name="dh_ma" id="dh_ma" class="form-control" />
                                </div>
                            </div> -->
                            <div class="col">
                                <div class="form-group">
                                    <label>Khách hàng</label>
                                    <select name="kh_tendangnhap" id="kh_tendangnhap" class="form-control">
                                        <option value="">Vui lòng chọn Khách hàng</option>
                                        <?php foreach ($dataKhachHang as $khachhang) : ?>
                                            <option value="<?= $khachhang['kh_tendangnhap'] ?>"><?= $khachhang['kh_tomtat'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Ngày lập</label>
                                    <input type="text" name="dh_ngaylap" id="dh_ngaylap" class="form-control" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Ngày giao</label>
                                    <input type="text" name="dh_ngaygiao" id="dh_ngaygiao" class="form-control" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Nơi giao</label>
                                    <input type="text" name="dh_noigiao" id="dh_noigiao" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Trạng thái thanh toán</label><br />
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan-1" class="custom-control-input" value="0" checked>
                                        <label class="custom-control-label" for="dh_trangthaithanhtoan-1">Chưa thanh toán</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan-2" class="custom-control-input" value="1">
                                        <label class="custom-control-label" for="dh_trangthaithanhtoan-2">Đã thanh toán</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Hình thức thanh toán</label>
                                    <select name="httt_ma" id="httt_ma" class="form-control">
                                        <option value="">Vui lòng chọn Hình thức thanh toán</option>
                                        <?php foreach ($dataHinhThucThanhToan as $httt) : ?>
                                            <option value="<?= $httt['httt_ma'] ?>"><?= $httt['httt_ten'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset id="chiTietDonHangContainer">
                        <legend>Thông tin Chi tiết Đơn hàng</legend>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="sp_ma">Sản phẩm</label>
                                    <select class="form-control" id="sp_ma" name="sp_ma">
                                        <option value="">Vui lòng chọn Sản phẩm</option>
                                        <?php foreach ($dataSanPham as $sanpham) : ?>
                                            <option value="<?= $sanpham['sp_ma'] ?>" data-sp_gia="<?= $sanpham['sp_gia'] ?>"><?= $sanpham['sp_ten'] ?> - <?= number_format($sanpham['sp_gia'], 0, ".", ",") ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Số lượng</label>
                                    <input type="text" name="soluong" id="soluong" class="form-control" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Xử lý</label><br />
                                    <button type="button" id="btnThemSanPham" class="btn btn-secondary">Thêm vào đơn hàng</button>
                                </div>
                            </div>
                        </div>

                        <table id="tblChiTietDonHang" class="table table-bordered">
                            <thead>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                                <th>Hành động</th>
                            </thead>
                            <tbody>
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
                    $kh_tendangnhap = $_POST['kh_tendangnhap'];
                    $dh_ngaylap = $_POST['dh_ngaylap'];
                    $dh_ngaygiao = $_POST['dh_ngaygiao'];
                    $dh_noigiao = $_POST['dh_noigiao'];
                    $dh_trangthaithanhtoan = $_POST['dh_trangthaithanhtoan'];
                    $httt_ma = $_POST['httt_ma'];

                    // Thông tin các dòng chi tiết đơn hàng
                    $arr_sp_ma = $_POST['sp_ma'];                   
                    $arr_sp_dh_soluong = $_POST['sp_dh_soluong'];   
                    $arr_sp_dh_dongia = $_POST['sp_dh_dongia'];     
                    // var_dump($sp_ma);die;

                    // 2. Thực hiện câu lệnh Tạo mới (INSERT) Đơn hàng
                    // Câu lệnh INSERT
                    $sqlInsertDonHang = "INSERT INTO `dondathang` (`dh_ngaylap`, `dh_ngaygiao`, `dh_noigiao`, `dh_trangthaithanhtoan`, `httt_ma`, `kh_tendangnhap`) VALUES ('$dh_ngaylap', '$dh_ngaygiao', N'$dh_noigiao', '$dh_trangthaithanhtoan', '$httt_ma', '$kh_tendangnhap')";
                   
                    // Thực thi INSERT Đơn hàng
                    mysqli_query($conn, $sqlInsertDonHang);
                    $dh_ma = $conn->insert_id;

                    // 4. Duyệt vòng lặp qua mảng các dòng Sản phẩm của chi tiết đơn hàng được gởi đến qua request POST
                    for ($i = 0; $i < count($arr_sp_ma); $i++) {
                        // 4.1. Chuẩn bị dữ liệu cho câu lệnh INSERT vào table `sanpham_dondathang`
                        $sp_ma = $arr_sp_ma[$i];
                        $sp_dh_soluong = $arr_sp_dh_soluong[$i];
                        $sp_dh_dongia = $arr_sp_dh_dongia[$i];

                        // 4.2. Câu lệnh INSERT
                        $sqlInsertSanPhamDonDatHang = "INSERT INTO `sanpham_dondathang` (`sp_ma`, `dh_ma`, `sp_dh_soluong`, `sp_dh_dongia`) VALUES ($sp_ma, $dh_ma, $sp_dh_soluong, $sp_dh_dongia)";

                        // 4.3. Thực thi INSERT
                        mysqli_query($conn, $sqlInsertSanPhamDonDatHang);
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

                <?php
                if (
                    isset($_POST['btnSave'])
                    && (!isset($errors) || (empty($errors)))
                ) {

                    $sql = <<<EOT
                    INSERT INTO sanpham (sp_ten, sp_gia, sp_giacu, sp_mota_ngan, sp_mota_chitiet, sp_ngaycapnhat, sp_soluong, lsp_ma, nsx_ma, km_ma) 
                    VALUES ('$sp_ten', $sp_gia, $sp_giacu, '$sp_mota_ngan', '$sp_mota_chitiet', '$sp_ngaycapnhat', $sp_soluong, $lsp_ma, $nsx_ma, $km_ma);
EOT;
                    mysqli_query($conn, $sql);
                    mysqli_close($conn);
                    echo "<script>location.href = 'index.php';</script>";
                }
                ?>
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

                // Tạo mẫu giao diện HTML Table Row
                if (sp_ma != '' && soluong > 0) {
                    var htmlTemplate = '<tr>';
                    htmlTemplate += '<td>' + sp_ten + '<input type="hidden" name="sp_ma[]" value="' + sp_ma + '"/></td>';
                    htmlTemplate += '<td>' + soluong + '<input type="hidden" name="sp_dh_soluong[]" value="' + soluong + '"/></td>';
                    htmlTemplate += '<td id="' + sp_ma + '">' + sp_gia.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + '<input type="hidden" name="sp_dh_dongia[]" value="' + sp_gia + '"/></td>';
                    htmlTemplate += '<td>' + thanhtien.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + '</td>';
                    htmlTemplate += '<td><button type="button" class="btn btn-danger btn-delete-row">Xóa</button></td>';
                    htmlTemplate += '</tr>';

                    // Thêm vào TABLE BODY
                    $('#tblChiTietDonHang tbody').append(htmlTemplate);
                } else alert("chọn sản phẩm");

                // Clear
                $('#sp_ma').val('');
                $('#soluong').val('');
            });
            $('#chiTietDonHangContainer').on('click', '.btn-delete-row', function() {
                $(this).parent().parent()[0].remove();
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