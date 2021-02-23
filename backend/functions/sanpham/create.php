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
                // Kết nối csdl  ------------------------------
                include_once(__DIR__ . '/../../../dbconnect.php');
                // SELECT LOAI SAN PHAM --------------------
                $sql_lsp = "select * from loaisanpham";
                $result_lsp = mysqli_query($conn, $sql_lsp);
                $data_lsp = [];
                while ($row = mysqli_fetch_array($result_lsp, MYSQLI_ASSOC)) {
                    $data_lsp[] = array(
                        'lsp_ma' => $row['lsp_ma'],
                        'lsp_ten' => $row['lsp_ten'],
                        'lsp_mota' => $row['lsp_mota']
                    );
                }
                // --------------------------------
                // SELECT NHA SAN XUAT --------------------
                $sql_nsx = "select * from nhasanxuat";
                $result_nsx = mysqli_query($conn, $sql_nsx);
                $data_nsx = [];
                while ($row = mysqli_fetch_array($result_nsx, MYSQLI_ASSOC)) {
                    $data_nsx[] = array(
                        'nsx_ma' => $row['nsx_ma'],
                        'nsx_ten' => $row['nsx_ten']
                    );
                }
                // --------------------------------
                // SELECT KHUYEN MAI --------------------
                $sql_km = "select * from khuyenmai";
                $result_km = mysqli_query($conn, $sql_km);
                $data_km = [];
                while ($row_km = mysqli_fetch_array($result_km, MYSQLI_ASSOC)) {
                    $km_tomtat = '';
                    if (!empty($row_km['km_ten'])) {
                        $km_tomtat = sprintf(
                            "Khuyến mãi %s, nội dung: %s, thời gian: %s-%s",
                            $row_km['km_ten'],
                            $row_km['kh_noidung'],
                            date('d/m/Y', strtotime($row_km['kh_tungay'])),
                            date('d/m/Y', strtotime($row_km['km_denngay']))
                        );
                    }
                    $data_km[] = array(
                        'km_ma' => $row_km['km_ma'],
                        'km_tomtat' => $km_tomtat,
                    );
                }
                // --------------------------------
                ?>
                <form action="" method="post" name="frmCreate" id="frmCreate">
                    <div class="form-group">
                        <label for="sp_ma">Mã Sản phẩm</label>
                        <input type="text" class="form-control" id="sp_ma" name="sp_ma" placeholder="Tên Sản phẩm" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="sp_ten">Tên Sản phẩm</label>
                        <input type="text" class="form-control" id="sp_ten" name="sp_ten" placeholder="Tên Sản phẩm" value="">
                    </div>
                    <div class="form-group">
                        <label for="sp_gia">Giá Sản phẩm</label>
                        <input type="text" class="form-control" id="sp_gia" name="sp_gia" placeholder="Giá Sản phẩm" value="">
                    </div>
                    <div class="form-group">
                        <label for="sp_giacu">Giá cũ Sản phẩm</label>
                        <input type="text" class="form-control" id="sp_giacu" name="sp_giacu" placeholder="Giá cũ Sản phẩm" value="">
                    </div>
                    <div class="form-group">
                        <label for="sp_mota_ngan">Mô tả ngắn</label>
                        <textarea class="form-control" id="sp_mota_ngan" name="sp_mota_ngan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="sp_mota_chitiet">Mô tả chi tiết</label>
                        <textarea class="form-control" id="sp_mota_chitiet" name="sp_mota_chitiet"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="sp_ngaycapnhat">Ngày cập nhật</label>
                        <input type="text" class="form-control" id="sp_ngaycapnhat" name="sp_ngaycapnhat" placeholder="Ngày cập nhật Sản phẩm" value="">
                    </div>
                    <div class="form-group">
                        <label for="sp_soluong">Số lượng</label>
                        <input type="text" class="form-control" id="sp_soluong" name="sp_soluong" placeholder="Số lượng Sản phẩm" value="">
                    </div>
                    <div class="form-group">
                        <label for="lsp_ma">Loại sản phẩm</label>
                        <select name="lsp_ma" id="lsp_ma" class="form-control">
                            <?php foreach ($data_lsp as $lsp) : ?>
                                <option value="<?= $lsp['lsp_ma'] ?>"><?= $lsp['lsp_ten'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nsx_ma">Nhà sản xuất</label>
                        <select class="form-control" id="nsx_ma" name="nsx_ma">
                            <?php foreach ($data_nsx as $nhasanxuat) : ?>
                                <option value="<?= $nhasanxuat['nsx_ma'] ?>"><?= $nhasanxuat['nsx_ten'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nsx_ma">Khuyến mãi</label>
                        <select class="form-control" id="km_ma" name="km_ma">
                            <option value="">Chọn loại khuyến mãi...</option>
                            <?php foreach ($data_km as $khuyenmai) : ?>
                                <option value="<?= $khuyenmai['km_ma'] ?>"><?= $khuyenmai['km_tomtat'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button class="btn btn-primary" name="btnSave">Lưu dữ liệu</button>
                </form>
                <?php
                if (isset($_POST['btnSave'])) {
                    // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
                    $sp_ten = $_POST['sp_ten'];
                    $sp_gia = $_POST['sp_gia'];
                    $sp_giacu = $_POST['sp_giacu'];
                    $sp_mota_ngan = $_POST['sp_mota_ngan'];
                    $sp_mota_chitiet = $_POST['sp_mota_chitiet'];
                    $sp_ngaycapnhat = $_POST['sp_ngaycapnhat'];
                    $sp_soluong = $_POST['sp_soluong'];
                    $lsp_ma = $_POST['lsp_ma'];
                    $nsx_ma = $_POST['nsx_ma'];
                    $km_ma = (empty($_POST['km_ma']) ? 'NULL' : $_POST['km_ma']);

                    // Kiểm tra ràng buộc dữ liệu (Validation)
                    // Tạo biến lỗi để chứa thông báo lỗi
                    $errors = [];

                    // Validate Tên  Sản phẩm_____________
                    // required
                    if (empty($sp_ten)) {
                        $errors['sp_ten'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $sp_ten,
                            'msg' => 'Vui lòng nhập tên sản phẩm'
                        ];
                    }
                    // minlength 5
                    if (!empty($sp_ten) && strlen($sp_ten) < 5) {
                        $errors['sp_ten'][] = [
                            'rule' => 'minlength',
                            'rule_value' => 5,
                            'value' => $sp_ten,
                            'msg' => 'Tên  sản phẩm phải có ít nhất 5 ký tự'
                        ];
                    }
                    // maxlength 50
                    if (!empty($sp_ten) && strlen($sp_ten) > 50) {
                        $errors['sp_ten'][] = [
                            'rule' => 'maxlength',
                            'rule_value' => 50,
                            'value' => $sp_ten,
                            'msg' => 'Tên  sản phẩm không được vượt quá 50 ký tự'
                        ];
                    }

                    // Validate giá________________________
                    // required
                    if (empty($sp_gia)) {
                        $errors['sp_gia'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $sp_gia,
                            'msg' => 'Vui lòng nhập giá sản phẩm'
                        ];
                    }

                    // Là số
                    if (!empty($sp_gia) && !is_numeric($sp_gia)) {
                        $errors['sp_gia'][] = [
                            'rule' => 'number',
                            'rule_value' => true,
                            'value' => $sp_gia,
                            'msg' => 'Giá sản phẩm phải là số'
                        ];
                    }

                    //Lớn hơn 0
                    if (!empty($sp_gia) && $sp_gia <= 0 && is_numeric($sp_gia)) {
                        $errors['sp_gia'][] = [
                            'rule' => 'required',
                            'rule_value' => 0,
                            'value' => $sp_gia,
                            'msg' => 'Giá sản phẩm phải lớn hơn 0'
                        ];
                    }
                    // Validate giá cũ___________________
                    // required
                    if (empty($sp_giacu)) {
                        $errors['sp_giacu'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $sp_giacu,
                            'msg' => 'Vui lòng nhập giá cũ sản phẩm'
                        ];
                    }
                    // Là số
                    if (!empty($sp_giacu) && !is_numeric($sp_giacu)) {
                        $errors['sp_giacu'][] = [
                            'rule' => 'number',
                            'rule_value' => true,
                            'value' => $sp_giacu,
                            'msg' => 'Giá cũ sản phẩm phải là số'
                        ];
                    }
                    //Lớn hơn 0
                    if (!empty($sp_giacu) && $sp_giacu <= 0) {
                        $errors['sp_giacu'][] = [
                            'rule' => 'required',
                            'rule_value' => 0,
                            'value' => $sp_giacu,
                            'msg' => 'Giá cũ sản phẩm phải lớn hơn 0'
                        ];
                    }
                    // Validate mô tả ngắn Sản phẩm___________________
                    // required
                    if (empty($sp_mota_ngan)) {
                        $errors['sp_mota_ngan'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $sp_mota_ngan,
                            'msg' => 'Vui lòng nhập mô tả ngắn sản phẩm'
                        ];
                    }
                    // minlength 5
                    if (!empty($sp_mota_ngan) && strlen($sp_mota_ngan) < 5) {
                        $errors['sp_mota_ngan'][] = [
                            'rule' => 'minlength',
                            'rule_value' => 5,
                            'value' => $sp_mota_ngan,
                            'msg' => 'Mô tả ngắn sản phẩm phải có ít nhất 5 ký tự'
                        ];
                    }
                    // maxlength 50
                    if (!empty($sp_mota_ngan) && strlen($sp_mota_ngan) > 100) {
                        $errors['sp_mota_ngan'][] = [
                            'rule' => 'maxlength',
                            'rule_value' => 100,
                            'value' => $sp_mota_ngan,
                            'msg' => 'Mô tả ngắn sản phẩm không được vượt quá 100 ký tự'
                        ];
                    }
                    // Validate mô tả chi tiết  Sản phẩm
                    // required
                    if (empty($sp_mota_chitiet)) {
                        $errors['sp_mota_chitiet'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $sp_mota_chitiet,
                            'msg' => 'Vui lòng nhập mô tả chi tiết  sản phẩm'
                        ];
                    }
                    // minlength 5
                    if (!empty($sp_mota_chitiet) && strlen($sp_mota_chitiet) < 5) {
                        $errors['sp_mota_chitiet'][] = [
                            'rule' => 'minlength',
                            'rule_value' => 5,
                            'value' => $sp_mota_chitiet,
                            'msg' => 'mô tả chi tiết  sản phẩm phải có ít nhất 5 ký tự'
                        ];
                    }
                    // maxlength 5000
                    if (!empty($sp_mota_chitiet) && strlen($sp_mota_chitiet) > 5000) {
                        $errors['sp_mota_chitiet'][] = [
                            'rule' => 'maxlength',
                            'rule_value' => 5000,
                            'value' => $sp_mota_chitiet,
                            'msg' => 'mô tả chi tiết  sản phẩm không được vượt quá 5000 ký tự'
                        ];
                    }
                    // Validate ngày cập nhật___________________
                    // required
                    if (empty($sp_ngaycapnhat)) {
                        $errors['sp_ngaycapnhat'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $sp_ngaycapnhat,
                            'msg' => 'Vui lòng nhập ngày cập nhật sản phẩm'
                        ];
                    }

                    // Validate số lượng___________________
                    // required
                    if (empty($sp_soluong)) {
                        $errors['sp_soluong'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $sp_soluong,
                            'msg' => 'Vui lòng nhập số lượng sản phẩm'
                        ];
                    }

                    // Là số
                    if (!empty($sp_soluong) && !is_numeric($sp_soluong)) {
                        $errors['sp_soluong'][] = [
                            'rule' => 'number',
                            'rule_value' => true,
                            'value' => $sp_soluong,
                            'msg' => 'Số lượng sản phẩm phải là số'
                        ];
                    }

                    //Lớn hơn hoặc bằng 0
                    if ($sp_soluong < 0) {
                        $errors['sp_soluong'][] = [
                            'rule' => 'required',
                            'rule_value' => 0,
                            'value' => $sp_soluong,
                            'msg' => 'Vui lòng nhập số lượng sản phẩm lớn hơn hoặc bằng 0'
                        ];
                    }
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
            $("#frmCreate").validate({
                rules: {
                    sp_ten: {
                        required: true,
                        minlength: 5,
                        maxlength: 50
                    },
                    sp_gia: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    sp_giacu: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    sp_mota_ngan: {
                        required: true,
                        minlength: 5,
                        maxlength: 50
                    },
                    sp_mota_chitiet: {
                        required: true,
                        minlength: 5,
                        maxlength: 5000
                    },
                    sp_ngaycapnhat: {
                        required: true
                    },
                    sp_soluong: {
                        required: true,
                        number: true,
                        min: 0
                    }
                },
                messages: {
                    sp_ten: {
                        required: "Vui lòng nhập tên sản phẩm",
                        min: "Tên sản phẩm phải có ít nhất 5 ký tự",
                        maxlength: "Tên sản phẩm không được vượt quá 50 ký tự"
                    },
                    sp_gia: {
                        required: "Vui lòng nhập giá sản phẩm",
                        number: "Giá sản phẩm phải là số",
                        min: "Vui lòng nhập giá sản phẩm lớn hơn 0"
                    },
                    sp_giacu: {
                        required: "Vui lòng nhập giá cũ sản phẩm",
                        number: "Giá cũ sản phẩm phải là số",
                        min: "Giá cũ sản phẩm phải lớn hơn 0"
                    },
                    sp_mota_ngan: {
                        required: "Vui lòng nhập mô tả sản phẩm",
                        minlength: "Mô tả ngắn sản phẩm phải có ít nhất 5 ký tự",
                        maxlength: "Mô tả ngắn sản phẩm không được vượt quá 100 ký tự"
                    },
                    sp_mota_chitiet: {
                        required: "Vui lòng nhập mô tả chi tiết sản phẩm",
                        minlength: "Mô tả chi tiết sản phẩm phải có ít nhất 5 ký tự",
                        maxlength: "Mô tả chi tiết sản phẩm không được vượt quá 5000 ký tự"
                    },
                    sp_ngaycapnhat: {
                        required: "Vui lòng nhập ngày cập nhật sản phẩm"
                    },
                    sp_soluong: {
                        required: "Vui lòng nhập số lượng sản phẩm",
                        number: "Số lượng sản phẩm phải là số",
                        min: "Số lượng sản phẩm phải lớn hơn 0"
                    }
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