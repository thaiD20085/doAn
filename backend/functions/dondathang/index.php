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
                    <h1 class="h2">Danh sách các Sản phẩm</h1>
                </div>
                <a href="create.php" class="btn btn-primary">
                    <span data-feather="create">Thêm mới</span>
                </a>
                <?php
                //1. ket noi csdl
                include_once(__DIR__ . '/../../../dbconnect.php');
                //2. cau lenh sql 
                $sql = <<<EOT
                SELECT 
                        ddh.dh_ma, ddh.dh_ngaylap, ddh.dh_ngaygiao, ddh.dh_noigiao, ddh.dh_trangthaithanhtoan, httt.httt_ten, kh.kh_ten, kh.kh_dienthoai
                    , SUM(spddh.sp_dh_soluong * spddh.sp_dh_dongia) AS TongThanhTien
                    FROM `dondathang` ddh
                    JOIN `sanpham_dondathang` spddh ON ddh.dh_ma = spddh.dh_ma
                    JOIN `khachhang` kh ON ddh.kh_tendangnhap = kh.kh_tendangnhap
                    JOIN `hinhthucthanhtoan` httt ON ddh.httt_ma = httt.httt_ma
                    GROUP BY ddh.dh_ma, ddh.dh_ngaylap, ddh.dh_ngaygiao, ddh.dh_noigiao, ddh.dh_trangthaithanhtoan, httt.httt_ten, kh.kh_ten, kh.kh_dienthoai
EOT;
                $result = mysqli_query($conn, $sql);
                $data = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $data[] = array(
                        'dh_ma' => $row['dh_ma'],
                        'dh_ngaylap' => date('d/m/Y H:i:s', strtotime($row['dh_ngaylap'])),
                        'dh_ngaygiao' => empty($row['dh_ngaygiao']) ? '' : date('d/m/Y H:i:s', strtotime($row['dh_ngaygiao'])),
                        'dh_noigiao' => $row['dh_noigiao'],
                        'dh_trangthaithanhtoan' => $row['dh_trangthaithanhtoan'],
                        'httt_ten' => $row['httt_ten'],
                        'kh_ten' => $row['kh_ten'],
                        'kh_dienthoai' => $row['kh_dienthoai'],
                        'TongThanhTien' => number_format($row['TongThanhTien'], 2, ".", ",") . ' vnđ',
                    );
                }
                ?>
                <div class="table-responsive">
                    <table id="tableSP" class="table table-bordered table-hover mt-2 table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Mã</th>
                                <th>Khách hàng</th>
                                <th>Ngày lập</th>
                                <th>Ngày giao</th>
                                <th>Nơi giao</th>
                                <th>HTTT</th>
                                <th>Tổng thành tiền</th>
                                <th>Trạng thái thanh toán</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($data as $ddh) : ?>
                                <tr>
                                    <td><?= $count++; ?></td>
                                    <td><?= $ddh['dh_ma'] ?></td>
                                    <td><b><?= $ddh['kh_ten'] ?></b><br />(<?= $ddh['kh_dienthoai'] ?>)</td>
                                    <td><?= $ddh['dh_ngaylap'] ?></td>
                                    <td><?= $ddh['dh_ngaygiao'] ?></td>
                                    <td><?= $ddh['dh_noigiao'] ?></td>
                                    <td><span class="badge badge-primary"><?= $ddh['httt_ten'] ?></span></td>
                                    <td><?= $ddh['TongThanhTien'] ?></td>
                                    <td>
                                        <?php if ($ddh['dh_trangthaithanhtoan'] == 0) : ?>
                                            <span class="badge badge-danger">Chưa xử lý</span>
                                        <?php else : ?>
                                            <span class="badge badge-success">Đã giao hàng</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- Đơn hàng nào chưa thanh toán thì được phép phép Xóa, Sửa -->
                                        <?php if ($ddh['dh_trangthaithanhtoan'] == 0) : ?>
                                            <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `dh_ma` -->
                                            <a href="edit.php?dh_ma=<?= $ddh['dh_ma'] ?>" class="btn btn-warning">
                                                Sửa
                                            </a>
                                            <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `dh_ma` -->
                                            <button type="button" class="btn btn-danger btnDelete" data-dh_ma="<?= $ddh['dh_ma'] ?>">
                                                Xóa
                                            </button>
                                        <?php else : ?>
                                            <!-- Đơn hàng nào đã thanh toán rồi thì không cho phép Xóa, Sửa (không hiển thị 2 nút này ra giao diện) 
                                        - Cho phép IN ấn ra giấy
                                        -->
                                            <!-- Nút in, bấm vào sẽ hiển thị mẫu in thông tin dựa vào khóa chính `dh_ma` -->
                                            <a href="print.php?dh_ma=<?= $ddh['dh_ma'] ?>" class="btn btn-success">
                                                In
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                <?php
                            endforeach;
                            mysqli_close($conn);
                                ?>
                        </tbody>

                    </table>
                </div>
            </main>
        </div>
    </div>
    <!-- FOOTER -->
    <?php include_once(__DIR__ . '/../../partials/footer.php'); ?>

    <?php include_once(__DIR__ . '/../../../backend/layouts/scripts.php'); ?>
</body>

</html>