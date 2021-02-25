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
                <?php
                include_once(__DIR__ . '/../../../dbconnect.php');
                $kh_tendangnhap = $_GET['kh_tendangnhap'];
                $sql = <<<EOT
                    SELECT kh_tendangnhap, kh_matkhau, kh_ten, kh_gioitinh, kh_diachi, kh_dienthoai, kh_email, kh_ngaysinh, kh_thangsinh, kh_namsinh, kh_cmnd, kh_trangthai, kh_quantri
                        FROM khachhang
                        WHERE kh_tendangnhap = '$kh_tendangnhap';
EOT;
                $result = mysqli_query($conn, $sql);
                $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
                ?>
                <form action="" method="post" name="frmCreate" id="frmCreate">
                    <div class="form-row">
                        <div class="form-group col-lg">
                            <h5>Thông tin cơ bản<span style="color:red;">*</span></h5>
                            <div class="form-group">
                                <label for="kh_tendangnhap">Tên đăng nhập <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="kh_tendangnhap" name="kh_tendangnhap" value="<?= $data['kh_tendangnhap']; ?>" readonly>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="kh_ten">Tên <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="kh_ten" name="kh_ten" value="<?= $data['kh_ten']; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="kh_gioitinh">Giới tính <span style="color:red;">*</span></label>
                                    <select class="form-control" id="kh_gioitinh" name="kh_gioitinh">
                                        <option value="1" <?php if ($data['kh_gioitinh'] == 1) echo 'selected'; ?>>Nam</option>
                                        <option value="0" <?php if ($data['kh_gioitinh'] == 0) echo 'selected'; ?>>Nữ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="kh_dienthoai">Điện thoại <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="kh_dienthoai" name="kh_dienthoai" value="<?= $data['kh_dienthoai']; ?>">
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="kh_email">Email <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="kh_email" name="kh_email" value="<?= $data['kh_email']; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="kh_trangthai">Trạng thái <span style="color:red;">*</span></label>
                                    <select class="form-control" id="kh_trangthai" name="kh_trangthai">
                                        <option value="1" <?php if ($data['kh_trangthai'] == 1) echo 'selected'; ?>>Hoạt động</option>
                                        <option value="0" <?php if ($data['kh_trangthai'] == 0) echo 'selected'; ?>>Khoá</option>
                                    </select>
                                </div>
                                <div class="form-group col-md">
                                    <label for="kh_quantri">Quyền của người dùng <span style="color:red;">*</span></label>
                                    <select class="form-control" id="kh_quantri" name="kh_quantri">
                                        <option value="0" <?php if ($data['kh_quantri'] == 0) echo 'selected'; ?>>Khách hàng</option>
                                        <option value="1" <?php if ($data['kh_quantri'] == 1) echo 'selected'; ?>>Quản trị</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <h5>Thông tin Chi tiết</h5>
                            <div class="form-group">
                                <label for="kh_diachi">Địa chỉ <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="kh_diachi" name="kh_diachi" value="<?= $data['kh_diachi']; ?>">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="kh_ngaysinh">Ngày sinh <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="kh_ngaysinh" name="kh_ngaysinh" value="<?= $data['kh_ngaysinh']; ?>">
                                </div>
                                <div class="form-group col-md">
                                    <label for="kh_thangsinh">Tháng sinh <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="kh_thangsinh" name="kh_thangsinh" value="<?= $data['kh_thangsinh']; ?>">
                                </div>
                                <div class="form-group col-md">
                                    <label for="kh_ngaysinh">Năm sinh <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="kh_namsinh" name="kh_namsinh" value="<?= $data['kh_namsinh']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kh_cmnd">CMND</label>
                                <input type="text" class="form-control" id="kh_cmnd" name="kh_cmnd" value="<?= $data['kh_cmnd']; ?>">
                            </div>
                        </div>
                    </div>



                    <button class="btn btn-primary" name="btnSave">Thêm</button>
                </form>
                <?php
                if (isset($_POST['btnSave'])) {
                    // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
                    $kh_tendangnhap =  addslashes($_POST['kh_tendangnhap']);
                    $kh_ten =  addslashes($_POST['kh_ten']);
                    $kh_gioitinh =  addslashes($_POST['kh_gioitinh']);
                    $kh_diachi =  addslashes($_POST['kh_diachi']);
                    $kh_dienthoai =  addslashes($_POST['kh_dienthoai']);
                    $kh_email =  addslashes($_POST['kh_email']);
                    $kh_ngaysinh =  addslashes($_POST['kh_ngaysinh']);
                    $kh_thangsinh =  addslashes($_POST['kh_thangsinh']);
                    $kh_namsinh =  addslashes($_POST['kh_namsinh']);
                    $kh_cmnd =  addslashes($_POST['kh_cmnd']);
                    $kh_trangthai =  addslashes($_POST['kh_trangthai']);
                    $kh_quantri =  addslashes($_POST['kh_quantri']);

                    // Kiểm tra ràng buộc dữ liệu (Validation)
                    // Tạo biến lỗi để chứa thông báo lỗi
                    $errors = [];

                    // Validate Tên  Sản phẩm_____________
                    // required
                    if (empty($kh_tendangnhap)) {
                        $errors['kh_tendangnhap'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $kh_tendangnhap,
                            'msg' => 'Vui lòng nhập tên đăng nhập'
                        ];
                    }
                    if (empty($kh_ten)) {
                        $errors['kh_ten'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $kh_ten,
                            'msg' => 'Vui lòng nhập lại mật khẩu'
                        ];
                    }
                    if (empty($kh_diachi)) {
                        $errors['kh_diachi'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $kh_diachi,
                            'msg' => 'Vui lòng nhập lại mật khẩu'
                        ];
                    }
                    if (empty($kh_dienthoai)) {
                        $errors['kh_dienthoai'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $kh_dienthoai,
                            'msg' => 'Vui lòng nhập số điện thoại'
                        ];
                    }
                    if (empty($kh_email)) {
                        $errors['kh_email'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $kh_email,
                            'msg' => 'Vui lòng nhập email'
                        ];
                    }
                }
                ?>
                <?php if (isset($_POST['btnSave']) && isset($errors) && (!empty($errors))) : ?>
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
                    INSERT INTO khachhang
                        (kh_tendangnhap, kh_matkhau, kh_ten, kh_gioitinh, kh_diachi, kh_dienthoai, kh_email, kh_ngaysinh, kh_thangsinh, kh_namsinh, kh_cmnd, kh_trangthai, kh_quantri)
                        VALUES ('$kh_tendangnhap', '$kh_matkhau', '$kh_ten', $kh_gioitinh, '$kh_diachi', '$kh_dienthoai', '$kh_email', $kh_ngaysinh, $kh_thangsinh, $kh_namsinh, '$kh_cmnd', $kh_trangthai, $kh_quantri)
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
            $("#frmCreate").validate({
                rules: {
                    kh_tendangnhap: {
                        required: true,
                        rangelength: [6, 12]
                    },
                    kh_matkhau: {
                        required: true,
                        rangelength: [6, 12]
                    },
                    kh_matkhau2: {
                        required: true,
                        equalTo: "#kh_matkhau",
                        rangelength: [6, 12]
                    },
                    kh_dienthoai: {
                        required: true,
                        number: true,
                        rangelength: [10, 11]
                    },
                    kh_email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    kh_dienthoai: {
                        required: "Vui lòng nhập số điện thoại",
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