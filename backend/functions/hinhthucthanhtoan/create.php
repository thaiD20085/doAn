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
                        <h1 class="h2">Thêm mới Hình thức thanh toán</h1>
                    </div>
                    <div class="col-auto">
                        <a href="./"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại</a>
                    </div>
                </div>
                <form action="" method="post" name="frmCreate" id="frmCreate">
                    <div class="form-group">
                        <label for="httt_ma">Mã Hình thức thanh toán</label>
                        <input type="text" class="form-control" name="httt_ma" id="httt_ma" readonly>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg">
                            <div class="form-group">
                                <label for="httt_ten">Tên</label>
                                <input type="text" class="form-control" name="httt_ten" id="httt_ten">
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="btnSave" id="btnSave" class="btn btn-primary">Thêm</button>
                </form>
                <?php
                include_once(__DIR__ . '/../../../dbconnect.php');
                if (isset($_POST['btnSave'])) {
                    $httt_ten = addslashes($_POST['httt_ten']);
                    $errors = [];

                    if (empty($httt_ten)) {
                        $errors['httt_ten'][] = [
                            'rule' => 'required',
                            'rule_value' => true,
                            'value' => $httt_ten,
                            'msg' => 'Vui lòng nhập tên Hình thức thanh toán'
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
                    INSERT INTO hinhthucthanhtoan
                        (httt_ten)
                        VALUES ('$httt_ten');
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
                    httt_ten: {
                        required: true,
                        maxlength: 100
                    },
                    httt_noidung: {
                        required: true,
                        maxlength: 500
                    },
                    httt_tungay: {
                        required: true,
                        dateISO: true
                    },
                    httt_denngay: {
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