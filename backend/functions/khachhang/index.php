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
                // ket noi csdl
                include_once(__DIR__ . '/../../../dbconnect.php');
                // cau lenh sql 
                $stt = 1;
                $sql = <<<EOT
                SELECT *
                FROM sanpham AS sp
                JOIN loaisanpham AS lsp ON sp.lsp_ma = lsp.lsp_ma
                JOIN nhasanxuat AS nsx ON sp.nsx_ma = nsx.nsx_ma
                LEFT JOIN khuyenmai AS km on sp.km_ma = km.km_ma;
EOT;
                $result = mysqli_query($conn, $sqlSelect);
                $data = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $data[] = array(
                        'lsp_ma' => $row['lsp_ma'],
                        'lsp_ten' => $row['lsp_ten'],
                        'lsp_mota' => $row['lsp_mota']
                    );
                }
                ?>
                <table class="table mt-2">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mã Loại sản phẩm</th>
                            <th scope="col">Tên Loại sản phẩm</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($data as $nsx) : ?>
                            <tr>
                                <td scope="row"><?= $count++; ?></td>
                                <td><?= $nsx['lsp_ma']; ?></td>
                                <td><?= $nsx['lsp_ten']; ?></td>
                                <td><?= $nsx['lsp_mota']; ?></td>
                                <td>
                                    <a href="edit.php?lsp_ma=<?= $nsx['lsp_ma'] ?>" class="btn btn-warning">
                                        <span data-feather="edit">Sửa</span>
                                    </a>
                                    <a href="delete.php?lsp_ma=<?= $nsx['lsp_ma'] ?>" class="btn btn-danger">
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