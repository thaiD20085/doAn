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
                <div class="row">
                    <div class="col">
                        <h1 class="h2">Thêm mới Khuyến mãi</h1>
                    </div>
                    <div class="col-auto">
                        <a href="./"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại</a>
                    </div>
                </div>
                <form action="" method="post" name="frmCreate" id="frmCreate">
                    <div class="form-group">
                        <label for="km_ma">Mã Khuyến mãi</label>
                        <input type="text" class="form-control" name="km_ma" id="km_ma" readonly>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg">
                            <div class="form-group">
                                <label for="km_ten">Tên</label>
                                <input type="text" class="form-control" name="km_ten" id="km_ten">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="km_tungay">Ngày bắt đầu</label>
                                    <input type="text" class="form-control" name="km_tungay" id="km_tungay">
                                </div>
                                <div class="form-group col-md">
                                    <label for="km_denngay">Ngày bắt đầu</label>
                                    <input type="text" class="form-control" name="km_denngay" id="km_denngay">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <div class="form-group">
                                <label for="km_noidung">Nội dung</label>
                                <textarea class="form-control" rows="5" name="km_noidung" id="km_noidung"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="btnSave" id="btnSave" class="btn btn-primary">Thêm</button>
                </form>
                <?php
                include_once(__DIR__ . '/../../../dbconnect.php');
                if (isset($_POST['btnSave'])) {
                    $km_ten = addslashes($_POST['km_ten']);
                    $km_tungay = addslashes($_POST['km_tungay']);
                    $km_denngay = addslashes($_POST['km_denngay']);
                    $km_noidung = addslashes($_POST['km_noidung']);

                    $errors = [];

                    if (empty($km_ten)) {
                        $errors['km_ten'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $km_ten,
                            'msg' => 'Vui lòng nhập tên khuyến mãi'
                        ];
                    }
                    if (empty($km_tungay)) {
                        $errors['km_tungay'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $km_tungay,
                            'msg' => 'Vui lòng nhập ngày bắt đầu'
                        ];
                    }
                    if (empty($km_denngay)) {
                        $errors['km_denngay'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $km_denngay,
                            'msg' => 'Vui lòng nhập kết thúc'
                        ];
                    }
                    if (empty($km_noidung)) {
                        $errors['km_noidung'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $km_noidung,
                            'msg' => 'Vui lòng nhập nội dung Khuyến mãi'
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
                        INSERT INTO khuyenmai
                        (km_ten, km_noidung, km_tungay, km_denngay)
                        VALUES ('$km_ten', '$km_noidung', '$km_tungay', '$km_denngay');
EOT;
                    echo $sql;
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
                    km_ten: {
                        required: true,
                        maxlength : 100
                    },
                    km_noidung: {
                        required: true,
                        maxlength : 500
                    },
                    km_tungay: {
                        required: true,
                        dateISO: true
                    },
                    km_denngay: {
                        required: true,
                        dateISO: true
                    }
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
        })
    </script>
</body>

</html>