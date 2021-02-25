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
                    <h1 class="h2">Danh sách Khuyến mãi</h1>
                </div>
                <a href="create.php" class="btn btn-primary">
                    <span data-feather="create">Thêm mới</span>
                </a>
                <?php
                // ket noi csdl
                include_once(__DIR__ . '/../../../dbconnect.php');
                // cau lenh sql 
                $sqlSelect = <<<EOT
                SELECT km_ma, km_ten, km_noidung, km_tungay, km_denngay
	                FROM khuyenmai
EOT;
                $result = mysqli_query($conn, $sqlSelect);
                $data = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $data[] = array(
                        'km_ma' => $row['km_ma'],
                        'km_ten' => $row['km_ten'],
                        'km_noidung' => $row['km_noidung'],
                        'km_tungay' => $row['km_tungay'],
                        'km_denngay' => $row['km_denngay']
                    );
                }
                ?>
                <table class="table mt-2">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mã Khuyến mãi</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Nội dung</th>
                            <th scope="col">Từ ngày</th>
                            <th scope="col">Ngày kết thúc</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($data as $km) : ?>
                            <tr>
                                <td scope="row"><?= $count++; ?></td>
                                <td><?= $km['km_ma']; ?></td>
                                <td><?= $km['km_ten']; ?></td>
                                <td><?= $km['km_noidung']; ?></td>
                                <td><?= $km['km_tungay']; ?></td>
                                <td><?= $km['km_denngay']; ?></td>
                                <td>
                                    <a href="edit.php?km_ma=<?= $km['km_ma'] ?>" class="btn btn-warning">
                                        <span data-feather="edit">Sửa</span>
                                    </a>
                                    <a href="delete.php?km_ma=<?= $km['km_ma'] ?>" class="btn btn-danger">
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