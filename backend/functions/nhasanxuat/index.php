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
                    <h1 class="h2">Danh sách các Nhà sản xuất</h1>
                </div>
                <a href="create.php" class="btn btn-primary">
                    <span data-feather="create">Thêm mới</span>
                </a>
                <?php
                // ket noi csdl
                include_once(__DIR__ . '/../../../dbconnect.php');
                // cau lenh sql 
                $sqlSelect = <<<EOT
                    SELECT nsx_ma, nsx_ten
                    FROM nhasanxuat;
EOT;
                $result = mysqli_query($conn, $sqlSelect);
                $data = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $data[] = array(
                        'nsx_ma' => $row['nsx_ma'],
                        'nsx_ten' => $row['nsx_ten']
                    );
                }
                ?>
                <table class="table mt-2">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mã nhà sản xuất</th>
                            <th scope="col">Tên nhà sản xuất</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($data as $nsx) : ?>
                            <tr>
                                <td scope="row"><?= $count++; ?></td>
                                <td><?= $nsx['nsx_ma']; ?></td>
                                <td><?= $nsx['nsx_ten']; ?></td>
                                <td>
                                    <a href="edit.php?nsx_ma=<?= $nsx['nsx_ma'] ?>" class="btn btn-warning">
                                        <span data-feather="edit">Sửa</span>
                                    </a>
                                    <a href="delete.php?nsx_ma=<?= $nsx['nsx_ma'] ?>" class="btn btn-danger">
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