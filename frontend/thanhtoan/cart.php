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
        .hinhdaidien {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <!-- header -->
    <?php include_once(__DIR__ . '/../partials/header.php') ?>
    <!-- end header -->

    <main role="main" class="mb-2">
        <!-- Block content -->
        <?php
        // Truy vấn database để lấy danh sách
        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
        include_once(__DIR__ . '/../../dbconnect.php');

        // Kiểm tra dữ liệu trong session
        $giohangdata = [];
        if (isset($_SESSION['giohangdata'])) {
            $giohangdata = $_SESSION['giohangdata'];
        } else {
            $giohangdata = [];
        }
        ?>

        <div class="container mt-4">
            <!-- Vùng ALERT hiển thị thông báo -->
            <div id="alert-container" class="alert alert-warning alert-dismissible fade d-none" role="alert">
                <div id="thongbao">&nbsp;</div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <h1 class="text-center">Giỏ hàng</h1>
            <div class="row">
                <div class="col col-md-12">
                    <?php if (!empty($giohangdata)) : ?>
                        <table id="tblGioHang" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="datarow">
                                <?php $stt = 1; ?>
                                <?php foreach ($giohangdata as $sanpham) : ?>
                                    <tr>
                                        <td><?= $stt ?></td>
                                        <td>
                                            <?php if (empty($sanpham['hinhdaidien'])) : ?>
                                                <img src="/project-D20085/assets/shared/img/default-image_600.png" class="img-fluid hinhdaidien" />
                                            <?php else : ?>
                                                <img src="/project-D20085/assets/uploads/products/<?= $sanpham['hinhdaidien'] ?>" class="img-fluid hinhdaidien" />
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $sanpham['sp_ten'] ?></td>
                                        <td>
                                            <form action="/project-D20085/frontend/api/giohang-capnhatsanpham.php" method="post" name="frmUpdate">
                                                <input type="number" class="form-control" id="soluong_<?= $sanpham['sp_ma'] ?>" name="soluong" value="<?= $sanpham['soluong'] ?>" />
                                                <input type="hidden" name="sp_ma" value="<?= $sanpham['sp_ma'] ?>" />
                                                <button name="btnUpdate" class="btn btn-primary">Cập nhật</button>
                                            </form>
                                        </td>
                                        <td><?= number_format($sanpham['gia'], 2, ".", ",") ?> vnđ</td>
                                        <td><?= number_format($sanpham['soluong'] * $sanpham['gia'], 2, ".", ",") ?> vnđ</td>
                                        <td>
                                            <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `sp_ma` -->
                                            <form action="/project-D20085/frontend/api/giohang-xoasanpham.php" method="post" name="frmDelete" id="frmDelete">
                                                <input type="hidden" name="sp_ma" value="<?= $sanpham['sp_ma'] ?>" />
                                                <button name="btnDelete" class="btn btn-danger">Xoá</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <h2>Giỏ hàng rỗng!!!</h2>
                    <?php endif; ?>
                    <a href="/project-D20085/" class="btn btn-warning btn-md"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay
                        về trang chủ</a>
                    <?php if (!empty($giohangdata)) : ?>
                        <a href="/project-D20085/index.php?direct=dathang" class="btn btn-primary btn-md"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Đặt hàng</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- End block content -->
    </main>

    <!-- footer -->
    <!--Footer-->
    <?php include_once(__DIR__ . '/../partials/footer.php'); ?>

    <!--SCRIPT-->
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>

</body>

</html>