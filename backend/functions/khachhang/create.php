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

                <form action="" method="post" name="frmCreate" id="frmCreate">
                    <div class="form-group">
                        <label for="kh_tendangnhap">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="kh_tendangnhap" name="kh_tendangnhap" value="">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kh_matkhau">Mật khẩu</label>
                            <input type="password" class="form-control" id="kh_matkhau" name="kh_matkhau" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="kh_matkhau2">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" id="kh_matkhau2" name="kh_matkhau2" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <label for="kh_ten">Tên</label>
                            <input type="text" class="form-control" id="kh_ten" name="kh_ten" value="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="kh_gioitinh">Giới tính</label>
                            <select class="form-control" id="kh_gioitinh" name="kh_gioitinh">
                                <option value="1">Nam</option>
                                <option value="0">Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kh_diachi">Địa chỉ</label>
                        <input type="text" class="form-control" id="kh_diachi" name="kh_diachi" value="">
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="kh_dienthoai">Điện thoại</label>
                            <input type="text" class="form-control" id="kh_dienthoai" name="kh_dienthoai" value="">
                        </div>
                        <div class="form-group col">
                            <label for="kh_email">Email</label>
                            <input type="text" class="form-control" id="kh_email" name="kh_email" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="kh_ngaysinh">Ngày sinh</label>
                            <input type="text" class="form-control" id="kh_ngaysinh" name="kh_ngaysinh" value="">
                        </div>
                        <div class="form-group col">
                            <label for="kh_thangsinh">Tháng sinh</label>
                            <input type="text" class="form-control" id="kh_thangsinh" name="kh_thangsinh" value="">
                        </div>
                        <div class="form-group col">
                            <label for="kh_ngaysinh">Năm sinh</label>
                            <input type="text" class="form-control" id="kh_namsinh" name="kh_namsinh" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kh_cmnd">CMND</label>
                        <input type="text" class="form-control" id="kh_cmnd" name="kh_cmnd" value="">
                    </div>
                    <div class="form-group">
                        <label for="kh_trangthai">Trạng thái</label>
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
                    <button class="btn btn-primary" name="btnSave">Thêm</button>
                </form>
                <?php
                if (isset($_POST['btnSave'])) {
                    // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
                    $kh_tendangnhap = $_POST['kh_tendangnhap'];
                    $kh_matkhau = $_POST['kh_matkhau'];
                    $kh_matkhau2 = $_POST['kh_matkhau2'];
                    $kh_ten = $_POST['kh_ten'];
                    $kh_gioitinh = $_POST['kh_gioitinh'];
                    $kh_diachi = $_POST['kh_diachi'];
                    $kh_dienthoai = $_POST['kh_dienthoai'];
                    $kh_email = $_POST['kh_email'];
                    $kh_ngaysinh = $_POST['kh_ngaysinh'];
                    $kh_thangsinh = $_POST['kh_thangsinh'];
                    $kh_namsinh = $_POST['kh_namsinh'];
                    $kh_cmnd = $_POST['kh_cmnd'];
                    $kh_trangthai = $_POST['kh_trangthai'];
                    $kh_quantri = $_POST['kh_quantri'];

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
                    if (empty($kh_matkhau)) {
                        $errors['kh_matkhau'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $kh_matkhau,
                            'msg' => 'Vui lòng nhập mật khẩu'
                        ];
                    }
                    if (empty($kh_matkhau2)) {
                        $errors['kh_matkhau2'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $kh_matkhau2,
                            'msg' => 'Vui lòng nhập lại mật khẩu'
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
                            'msg' => 'Vui lòng nhập lại mật khẩu'
                        ];
                    }

                }
                ?>
                <?php if ( isset($_POST['btnSave']) && isset($errors) && (!empty($errors))  ) : ?>
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