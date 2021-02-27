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

        .signin-area {
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

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-1"></div>
            <div class="col-10 signin-area">
                <div class="container">
                    <div class="row">
                        <div class=" col-md-6 d-none d-md-block text-center">
                            <img src="/project-D20085/assets/frontend/img/login.png" class="img-fluid">
                            <p class="mb-2">Đăng nhập để theo dõi đơn hàng, nhận ưu đãi và được sự hỗ trợ tốt nhất
                                của chúng tôi!</p>
                        </div>
                        <div class="col-md-6">
                            <div class="title mt-2">
                                <h1 class="font-weight-bold" style="color:#FCA311">Đăng nhâp</h1>
                            </div>

                            <form name="frmSignin" id="frmSignin" method="post" action="">
                                <div class="form-group input-group-lg">
                                    <label for="kh_tendangnhap">Tên đăng nhập <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="kh_tendangnhap" id="kh_tendangnhap" />
                                </div>
                                <div class="form-group input-group-lg">
                                    <label for="kh_tendangnhap">Mật khẩu<span style="color:red">*</span></label>
                                    <input type="password" class="form-control" name="kh_matkhau" id="kh_matkhau" />
                                </div>
                                <button type="submit" name="btnSave" class="btn btn-primary mb-3">Đăng nhập</button>
                                <span style="color:gray">hay</span>
                                <a href="/project-D20085/index.php?direct=dangky" class="btn btn-secondary mb-3">Đăng ký</a>
                            </form>
                            <?php
                            include_once(__DIR__ . '/../../dbconnect.php');
                            if (isset($_POST['btnSave'])) {
                                $kh_tendangnhap =  addslashes($_POST['kh_tendangnhap']);
                                $kh_matkhau =  md5(addslashes($_POST['kh_matkhau']));

                                $errors = [];

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
                                SELECT kh_matkhau, kh_quantri, kh_trangthai
                                    FROM khachhang
                                    WHERE kh_tendangnhap = '$kh_tendangnhap' AND kh_matkhau = '$kh_matkhau';
EOT;
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                    if ($data['kh_trangthai'] == 1) {
                                        // Lưu thông tin Tên tài khoản user đã đăng nhập

                                        $_SESSION['kh_tendangnhap_logged'] = $kh_tendangnhap;
                                        if ($data['kh_quantri'] == 1) {
                                            $_SESSION['kh_quantri'] = 1;
                                        }
                                        echo 'Đăng nhập thành công!';
                                        // Điều hướng (redirect) về trang chủ

                                        echo '<script>location.href = "/project-D20085/";</script>';
                                    } else {
                                        echo '<h2 style="color: red;">Đăng nhập thất bại!</h2>';
                                    }
                                } else {
                                    echo '<h2 style="color: red;">Đăng nhập thất bại!</h2>';
                                }
                                mysqli_close($conn);
                            }
                            ?>
                            <a href="/project-D20085/" style="position: absolute; right:2px; bottom: 2px; text-decoration: underline;">Trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
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
            $("#frmSignin").validate({
                rules: {
                    kh_tendangnhap: {
                        required: true,
                        rangelength: [6, 12]
                    },
                    kh_matkhau: {
                        required: true,
                        rangelength: [6, 12]
                    },

                },
                messages: {

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