<?php
if (session_id() == null) {
    session_start();
}
?>
<?php include_once(__DIR__ . '/../../frontend/layouts/config.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once(__DIR__ . '/../../frontend/layouts/head.php'); ?>
    <style>
        body {
            background: rgba(0, 0, 5, 0.8);
        }

        .signup-area {
            padding: 10px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.6);
        }

        a {
            color: black;
        }

        form {
            margin-top: 20px;
        }

        .form-group input:focus {
            border: 1px solid #ced4da;
            box-shadow: none;
        }

        label {
            color: gray;
            font-weight: lighter;
            background: white;
            position: absolute;
            padding: 0 5px;
            margin-top: 10px;
            margin-left: 10px;
            transition: .3s;
        }

        .label-toggle {
            margin-top: -13px;
            font-size: small;
            transition: .3s;
        }

        .fa {
            position: absolute;
            right: 30px;
            margin-top: -32px;
        }
    </style>
</head>
<style>

</style>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-1 col-md-3"></div>
            <div class="col-10 col-md-6 signup-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="title mt-2">
                                <h1 class="font-weight-bold" style="color:#FCA311">Đăng ký</h1>
                            </div>
                            <form action="" method="post" name="frmSignup" id="frmSignup" class="mt-2">

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
                                    <div class="form-group col-md-8">
                                        <label for="kh_ten">Tên</label>
                                        <input type="text" class="form-control" id="kh_ten" name="kh_ten" value="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="kh_gioitinh">Giới tính</label>
                                        <select class="form-control" id="kh_gioitinh" name="kh_gioitinh">
                                            <option value="1" selected>Nam</option>
                                            <option value="0">Nữ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="kh_dienthoai">Điện thoại <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="kh_dienthoai" name="kh_dienthoai" value="">
                                </div>
                                <div class="form-group">
                                    <label for="kh_email">Email <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="kh_email" name="kh_email" value="">
                                </div>

                                <div class="form-group">
                                    <label for="kh_diachi">Địa chỉ </label>
                                    <input type="text" class="form-control" id="kh_diachi" name="kh_diachi" value="">
                                </div>

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="kh_ngaysinh">Ngày sinh </label>
                                        <input type="text" class="form-control" id="kh_ngaysinh" name="kh_ngaysinh" value="">
                                    </div>
                                    <div class="form-group col">
                                        <label for="kh_thangsinh">Tháng sinh </label>
                                        <input type="text" class="form-control" id="kh_thangsinh" name="kh_thangsinh" value="">
                                    </div>
                                    <div class="form-group col">
                                        <label for="kh_ngaysinh">Năm sinh </label>
                                        <input type="text" class="form-control" id="kh_namsinh" name="kh_namsinh" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kh_cmnd">CMND</label>
                                    <input type="text" class="form-control" id="kh_cmnd" name="kh_cmnd" value="">
                                </div>
                                <button class="btn btn-primary" name="btnSave">Thêm</button>
                            </form>
                            <?php
                            if (isset($_POST['btnSave'])) {
                                // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
                                $kh_tendangnhap =  addslashes($_POST['kh_tendangnhap']);
                                $kh_matkhau =  md5(addslashes($_POST['kh_matkhau']));
                                $kh_matkhau2 =  md5(addslashes($_POST['kh_matkhau2']));
                                $kh_ten =  addslashes($_POST['kh_ten']);
                                $kh_gioitinh =  addslashes($_POST['kh_gioitinh']);
                                $kh_diachi =  addslashes($_POST['kh_diachi']);
                                $kh_dienthoai =  addslashes($_POST['kh_dienthoai']);
                                $kh_email =  addslashes($_POST['kh_email']);
                                $kh_ngaysinh =  addslashes($_POST['kh_ngaysinh']);
                                $kh_thangsinh =  addslashes($_POST['kh_thangsinh']);
                                $kh_namsinh =  addslashes($_POST['kh_namsinh']);
                                $kh_cmnd =  addslashes($_POST['kh_cmnd']);

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
                                include_once(__DIR__ . '/../../../dbconnect.php');
                                $sql = <<<EOT
                                INSERT INTO khachhang
                                    (kh_tendangnhap, kh_matkhau, kh_ten, kh_gioitinh, kh_diachi, kh_dienthoai, kh_email, kh_ngaysinh, kh_thangsinh, kh_namsinh, kh_cmnd, kh_trangthai, kh_quantri)
                                    VALUES ('$kh_tendangnhap', '$kh_matkhau', '$kh_ten', $kh_gioitinh, '$kh_diachi', '$kh_dienthoai', '$kh_email', $kh_ngaysinh, $kh_thangsinh, $kh_namsinh, '$kh_cmnd',1, 0)
EOT;
                                mysqli_query($conn, $sql);
                                mysqli_close($conn);
                                echo "<script>location.href = '/project-D20085/index.php?direct=dangnhap';</script>";
                            }
                            ?>
                            <a href="/project-D20085/" style="position: absolute; right:2px; bottom: 2px; text-decoration: underline;">Trang chủ</a>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-1 col-md-3"></div>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
    <!-- Thư viện Jquery validation -->
    <script src="/project-D20085/assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/project-D20085/assets/vendor/jquery-validation/localization/messages_vi.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.form-control').focusin(function() {
                $(this).parent().children('label').addClass('label-toggle');
                console.log();
            })
            $('.form-control').focusout(function() {
                if ($(this).val() === '') {
                    $(this).parent().children('label').removeClass('label-toggle');
                }
            })
            $("#frmSignup").validate({
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