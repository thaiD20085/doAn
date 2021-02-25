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
                    <h1 class="h2">Danh sách Hình thức thanh toán</h1>
                </div>
                <a href="create.php" class="btn btn-primary">
                    <span data-feather="create">Thêm mới</span>
                </a>
                <?php
                // ket noi csdl
                include_once(__DIR__ . '/../../../dbconnect.php');
                // cau lenh sql 
                $sqlSelect = <<<EOT
                SELECT httt_ma, httt_ten
	                FROM hinhthucthanhtoan;
EOT;
                $result = mysqli_query($conn, $sqlSelect);
                $data = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $data[] = array(
                        'httt_ma' => $row['httt_ma'],
                        'httt_ten' => $row['httt_ten']
                    );
                }
                ?>
                <table class="table table-hover mt-2">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mã</th>
                            <th scope="col">Tên</th>
                            <th scope="col" style="width: 15%">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($data as $httt) : ?>
                            <tr>
                                <td scope="row"><?= $count++; ?></td>
                                <td><?= $httt['httt_ma']; ?></td>
                                <td><?= $httt['httt_ten']; ?></td>
                                <td>
                                    <a href="edit.php?httt_ma=<?= $httt['httt_ma'] ?>" class="btn btn-warning">
                                        <span data-feather="edit">Sửa</span>
                                    </a>
                                    <a href="delete.php?httt_ma=<?= $httt['httt_ma'] ?>" class="btn btn-danger">
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