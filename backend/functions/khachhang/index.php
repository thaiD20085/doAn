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
                    <h1 class="h2">Danh sách Khách hàng</h1>
                </div>
                <a href="create.php" class="btn btn-primary">
                    <span data-feather="create">Thêm mới</span>
                </a>
                <?php
                // ket noi csdl
                include_once(__DIR__ . '/../../../dbconnect.php');
                // cau lenh sql 

                $sql = <<<EOT
                SELECT kh_tendangnhap, kh_matkhau, kh_ten, kh_gioitinh, kh_diachi, kh_dienthoai, kh_email, kh_ngaysinh, kh_thangsinh, kh_namsinh, kh_cmnd, kh_trangthai, kh_quantri
	                FROM khachhang
EOT;
                $result = mysqli_query($conn, $sql);
                $data = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $data[] = array(
                        'kh_tendangnhap' => $row['kh_tendangnhap'],
                        'kh_matkhau' => $row['kh_matkhau'],
                        'kh_ten' => $row['kh_ten'],
                        'kh_gioitinh' => $row['kh_gioitinh'],
                        'kh_diachi' => $row['kh_diachi'],
                        'kh_dienthoai' => $row['kh_dienthoai'],
                        'kh_email' => $row['kh_email'],
                        'kh_ngay_sinh' => $row['kh_ngaysinh'] .'/'. $row['kh_thangsinh'] .'/'. $row['kh_namsinh'] ,
                        'kh_cmnd' => $row['kh_cmnd'],
                        'kh_trangthai' => $row['kh_trangthai'],
                        'kh_quantri' => $row['kh_quantri']
                    );
                }
                ?>
                <table class="table mt-2">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên đăng nhập</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Giới tính</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Điện thoại</th>
                            <th scope="col">Email</th>
                            <th scope="col">Ngày sinh</th>
                            <th scope="col">CMND</th>
                            <th scope="col">Trạng Thái</th>
                            <th scope="col">Quản trị</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($data as $kh) : ?>
                            <tr>
                                <td scope="row"><?= $count++; ?></td>
                                <td><?= $kh['kh_tendangnhap']; ?></td>
                                <td><?= $kh['kh_ten']; ?></td>
                                <td><?= $kh['kh_gioitinh']; ?></td>
                                <td><?= $kh['kh_diachi']; ?></td>
                                <td><?= $kh['kh_dienthoai']; ?></td>
                                <td><?= $kh['kh_email']; ?></td>
                                <td><?= $kh['kh_ngay_sinh']; ?></td>
                                <td><?= $kh['kh_cmnd']; ?></td>
                                <td><?= $kh['kh_trangthai']; ?></td>
                                <td><?= $kh['kh_quantri']; ?></td>
                                <td>
                                    <a href="edit.php?kh_tendangnhap=<?= $kh['kh_tendangnhap'] ?>" class="btn btn-warning">
                                        <span data-feather="edit">Sửa</span>
                                    </a>
                                    <a href="delete.php?kh_tendangnhap=<?= $kh['kh_tendangnhap'] ?>" class="btn btn-danger">
                                        <span data-feather="delete">Xóa</span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>
    <!-- FOOTER -->
    <?php include_once(__DIR__ . '/../../partials/footer.php'); ?>

    <?php include_once(__DIR__ . '/../../../backend/layouts/scripts.php'); ?>
</body>

</html>