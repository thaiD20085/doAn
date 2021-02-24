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