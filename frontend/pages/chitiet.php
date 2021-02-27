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
        #product-detail {
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.1);
        }

        .isChecked {
            background: #007bff;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <!-- nav-bar ---------------------------------------------------------------------------------->
    <?php include_once(__DIR__ . '/../partials/header.php') ?>

    <!-- main content--------------------------------------------------------------------------- -->
    <?php
    $sp_ma = $_GET['sp_ma'];
    include_once(__DIR__ . '/../../dbconnect.php');
    $sql = <<<EOT
        SELECT sp_ten, sp_gia, sp_mota_chitiet, sp_ngaycapnhat,
                hsp.hsp_tentaptin,
                lsp.lsp_ten,
                nsx.nsx_ten
            FROM sanpham sp
            LEFT JOIN hinhsanpham hsp ON hsp.sp_ma = sp.sp_ma
            LEFT JOIN loaisanpham lsp ON lsp.lsp_ma = sp.lsp_ma
            LEFT JOIN nhasanxuat nsx ON nsx.nsx_ma = sp.nsx_ma
            WHERE sp.sp_ma = $sp_ma;
EOT;
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
    ?>
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="container my-4 py-4" id="product-detail">
                    <div class="row">
                        <div class="col-6">
                            <img src="/project-D20085/assets/uploads/products/<?= $data['hsp_tentaptin']; ?>" class="img-fluid hinh" />
                        </div>
                        <div class="col-6">
                            <h4 class="w-100 font-weight-bold" style="color:rgba( 0,0,0,0.5)"><?= $data['sp_ten'] ?></h4>
                            <span style="color:gold">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </span><br />
                            <span class="font-weight-bold">Loại: </span><span><?= $data['lsp_ten'] ?></span><br />
                            <span class="font-weight-bold">Giá: </span><span><?= $data['sp_gia'] ?></span><br />
                            <span class="font-weight-bold">Chi Tiết: </span><br /><span><?= $data['sp_mota_chitiet'] ?></span><br />
                            <form name="frmCreate" if="frmCreate" method="post" action="/project-D20085/frontend/api/giohang-themsanpham.php">
                                <input type="number" name="soluong" id="soluong" value="1" min="1" max="99" /><br />
                                <input type="hidden" name="sp_ma" id="sp_ma" value="<?= $sp_ma ?>" />
                                <input type="hidden" name="sp_ten" id="sp_ten" value="<?= $data['sp_ten'] ?>" />
                                <input type="hidden" name="sp_gia" id="sp_gia" value="<?= $data['sp_gia'] ?>" />
                                <input type="hidden" name="hinhdaidien" id="hinhdaidien" value="<?= $data['hsp_tentaptin']; ?>" />
                                <button name="btnSave" class="btn btn-primary my-2">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--Footer-->
    <?php include_once(__DIR__ . '/../partials/footer.php'); ?>

    <!--SCRIPT-->
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>

</body>

</html>