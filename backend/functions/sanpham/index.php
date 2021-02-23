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
                    <h1 class="h2">Danh sách các Loại sản phẩm</h1>
                </div>
                <a href="create.php" class="btn btn-primary">
                    <span data-feather="create">Thêm mới</span>
                </a>
                <?php
                //1. ket noi csdl
                include_once(__DIR__ . '/../../../dbconnect.php');
                //2. cau lenh sql 
                $sql = <<<EOT
                SELECT *
                FROM sanpham AS sp
                JOIN loaisanpham AS lsp ON sp.lsp_ma = lsp.lsp_ma
                JOIN nhasanxuat AS nsx ON sp.nsx_ma = nsx.nsx_ma
                LEFT JOIN khuyenmai AS km on sp.km_ma = km.km_ma;
EOT;
                $result = mysqli_query($conn, $sql);
                $data = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $km_thongtin = 'Không';
                    if (!empty($row['km_ma'])) {
                        $km_thongtin = sprintf(
                            "Khuyến mãi %s, nội dung %s, thời gian: %s-%s",
                            $row['km_ten'],
                            $row['kh_noidung'],
                            date('d/m/Y', strtotime($row['kh_tungay'])),
                            date('d/m/Y', strtotime($row['km_denngay']))
                        );
                    }
                    $data[] = array(
                        'sp_ma' => $row['sp_ma'],
                        'sp_ten' => $row['sp_ten'],
                        // Sử dụng hàm number_format(số tiền, số lẻ thập phân, dấu phân cách số lẻ, dấu phân cách hàng nghìn) 
                        // để định dạng số khi hiển thị trên giao diện. 
                        // Vd: 15800000 -> format thành 15,800,000.66 vnđ
                        'sp_gia' => number_format($row['sp_gia'], 2, ".", ",") . ' VNĐ',
                        'sp_giacu' => number_format($row['sp_giacu'], 2, ".", ",") . ' VNĐ',
                        'sp_mota_ngan' => $row['sp_mota_ngan'],
                        'sp_mota_chitiet' => $row['sp_mota_chitiet'],
                        'sp_ngaycapnhat' => date('d/m/Y H:i:s', strtotime($row['sp_ngaycapnhat'])),
                        'sp_soluong' => number_format($row['sp_soluong'], 0, ".", ","),
                        'lsp_ma' => $row['lsp_ma'],
                        'nsx_ma' => $row['nsx_ma'],
                        'km_ma' => $row['km_ma'],
                        // Các cột dữ liệu lấy từ liên kết khóa ngoại
                        'lsp_ten' => $row['lsp_ten'],
                        'nsx_ten' => $row['nsx_ten'],
                        'km_thongtin' => $km_thongtin,
                    );
                }
                ?>
                <div class="table-responsive">
                    <table id="tableSP" class="table table-bordered table-hover mt-2 table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>STT</th>
                                <th>Mã</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Giá cũ</th>
                                <th>Mô tả ngắn</th>
                                <th>Mô tả chi tiết</th>
                                <th>Ngày cập nhật</th>
                                <th>SL</th>
                                <th>Loại sản phẩm</th>
                                <th>Nhà sản xuất</th>
                                <th>Khuyến mãi</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($data as $sp) : ?>
                                <tr>
                                    <td><?=
                                        $count++ ?></td>
                                    <td><?= $sp['sp_ma'] ?></td>
                                    <td><?= $sp['sp_ten'] ?></td>
                                    <td><?= $sp['sp_gia'] ?></td>
                                    <td><?= $sp['sp_giacu'] ?></td>
                                    <td><?= $sp['sp_mota_ngan'] ?></td>
                                    <td><?= $sp['sp_mota_chitiet'] ?></td>
                                    <td><?= $sp['sp_ngaycapnhat'] ?></td>
                                    <td><?= $sp['sp_soluong'] ?></td>
                                    <td><?= $sp['lsp_ten'] ?></td>
                                    <td><?= $sp['nsx_ten'] ?></td>
                                    <td><?= $sp['km_thongtin'] ?></td>
                                    <td>
                                        <a href="edit.php?sp_ma=<?= $sp['sp_ma'] ?>" class="btn btn-warning">Sửa</a>
                                        <a href="delete.php?sp_ma=<?= $sp['sp_ma'] ?>" class="btn btn-danger">Xoá</a>
                                    </td>
                                </tr>
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