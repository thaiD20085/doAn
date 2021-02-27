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

    </style>
</head>

<body>
    <!-- nav-bar -------------------------------------------------------------------------------- -->
    <?php include_once(__DIR__ . '/../partials/header.php') ?>
    <!-- main content-------------------------------------------------------------------------------- -->
    <div class="container">
        <div class="row">

            <div class="col-md-12" width="100%">
                <div class="text-center font-weight-bold mt-2">
                    HỘP THƯ GÓP Ý
                </div>
            </div>
        </div>
        <?php
        include_once(__DIR__ . '/../../dbconnect.php');
        $sql = <<<EOT
        SELECT cdgy_ma, cdgy_ten
	        FROM chudegopy
EOT;
        $result = mysqli_query($conn, $sql);
        $data_cd = [];
        while ($row_cd = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data_cd[] = array(
                'cdgy_ma' => $row_cd['cdgy_ma'],
                'cdgy_ten' => $row_cd['cdgy_ten'],
            );
        }
        ?>
        <form action="" method="post" name="frmCreate" id="frmCreate" class="mt-2">
            <div class="form-group">
                <label for="cdgy_ma">Chủ đề</label>
                <select class="form-control" name="cdgy_ma" id="cdgy_ma">
                    <?php foreach ($data_cd as $cdgy) : ?>
                        <option value="<?= $cdgy['cdgy_ma'] ?>"><?= $cdgy['cdgy_ten'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-8">
                    <label for="gy_tieude">Tiêu đề</label>
                    <input type="text" class="form-control" id="gy_tieude" name="gy_tieude">
                </div>
                <div class="form-group col-lg-4">
                    <label for="gy_ngaygopy">Ngày</label>
                    <input type="text" class="form-control" id="gy_ngaygopy" name="gy_ngaygopy">
                </div>
            </div>
            <div class="form-group">
                <label for="gy_hoten">Họ tên</label>
                <input type="text" class="form-control" name="gy_hoten" id="gy_hoten">
            </div>
            <div class="form-row">
                <div class="form-group col-lg-6">
                    <label for="gy_dienthoai">Điện thoại <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="gy_dienthoai" name="gy_dienthoai" value="">
                </div>
                <div class="form-group col-lg-6">
                    <label for="gy_email">Email <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="gy_email" name="gy_email" value="">
                </div>
            </div>
            <div class="form-group ">
                <label for="gy_diachi">Địa chỉ <span style="color:red;">*</span></label>
                <input type="text" class="form-control" id="gy_diachi" name="gy_diachi" value="">
            </div>
            <div class="form-group">
                <label for="gy_noidung">Nội dung</label>
                <textarea class="form-control" id="gy_noidung" name="gy_noidung"></textarea>
            </div>

            <button class="btn btn-primary" name="btnSave">Gửi</button>
        </form>
        <?php
        if (isset($_POST['btnSave'])) {
            // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
            $gy_hoten =  addslashes($_POST['gy_hoten']);
            $gy_email =  addslashes($_POST['gy_email']);
            $gy_diachi =  addslashes($_POST['gy_diachi']);
            $gy_dienthoai =  addslashes($_POST['gy_dienthoai']);
            $gy_tieude =  addslashes($_POST['gy_tieude']);
            $gy_noidung =  addslashes($_POST['gy_noidung']);
            $gy_ngaygopy =  addslashes($_POST['gy_ngaygopy']);
            $cdgy_ma =  $_POST['cdgy_ma'];
            // Kiểm tra ràng buộc dữ liệu (Validation)
            // Tạo biến lỗi để chứa thông báo lỗi
            $errors = [];

            // Validate Tên  Sản phẩm_____________
            // required
            if (empty($gy_hoten)) {
                $errors['gy_hoten'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $gy_hoten,
                    'msg' => 'Vui lòng nhập tên'
                ];
            }
            if (empty($gy_email)) {
                $errors['gy_email'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $gy_email,
                    'msg' => 'Vui lòng nhập email'
                ];
            }
            if (empty($gy_dienthoai)) {
                $errors['gy_dienthoai'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $gy_dienthoai,
                    'msg' => 'Vui lòng nhập số điện thoại'
                ];
            }
            if (empty($gy_diachi)) {
                $errors['gy_diachi'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $gy_diachi,
                    'msg' => 'Vui lòng nhập địa chỉ'
                ];
            }
            if (empty($gy_tieude)) {
                $errors['gy_tieude'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $gy_tieude,
                    'msg' => 'Vui lòng nhập tiêu đề'
                ];
            }
            if (empty($gy_noidung)) {
                $errors['gy_noidung'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $gy_noidung,
                    'msg' => 'Vui lòng nhập nội dung'
                ];
            }
            if (empty($gy_ngaygopy)) {
                $errors['gy_ngaygopy'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $gy_ngaygopy,
                    'msg' => 'Vui lòng nhập ngày góp ý'
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
            INSERT INTO gopy
                (gy_hoten, gy_email, gy_diachi, gy_dienthoai, gy_tieude, gy_noidung, gy_ngaygopy, cdgy_ma)
                VALUES ('$gy_hoten', '$gy_email', '$gy_diachi', '$gy_dienthoai', '$gy_tieude', '$gy_noidung', '$gy_ngaygopy', $cdgy_ma)
EOT;
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            echo "<script>location.href = '/PROJECT_D20085/';</script>";
        }
        ?>

    </div>
    <!--Footer-->
    <?php include_once(__DIR__ . '/../partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
    <script src="/project-D20085/assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/project-D20085/assets/vendor/jquery-validation/localization/messages_vi.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#frmCreate").validate({
                rules: {
                    gy_hoten: {
                        required: true,
                        rangelength: [6, 100]
                    },
                    gy_email: {
                        required: true,
                        email: true,
                    },
                    gy_diachi: {
                        required: true,
                        rangelength: [6, 100]
                    },
                    gy_tieude: {
                        required: true,
                        rangelength: [6, 100]

                    },
                    gy_noidung: {
                        required: true,
                        rangelength: [6, 500]
                    },
                    gy_ngaygopy: {
                        required: true,
                        dateISO: true
                    },
                },
                messages: {},
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