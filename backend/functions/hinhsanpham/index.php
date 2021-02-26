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
                    <h1 class="h2">Danh sách Hình sản phẩm </h1>
                </div>
                <a href="create.php" class="btn btn-primary">
                    <span data-feather="create">Thêm mới</span>
                </a>
                <?php
                // ket noi csdl
                include_once(__DIR__ . '/../../../dbconnect.php');
                // cau lenh sql 
                $sqlSelect = <<<EOT
                SELECT hsp.hsp_ma, hsp.hsp_tentaptin, sp.sp_ten, sp.sp_gia
                    FROM hinhsanpham hsp
                    LEFT JOIN sanpham sp ON sp.sp_ma = hsp.sp_ma 
EOT;
                $result = mysqli_query($conn, $sqlSelect);
                $data = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $data[] = array(
                        'hsp_ma' => $row['hsp_ma'],
                        'hsp_tentaptin' => $row['hsp_tentaptin'],
                        'sp_tt' => sprintf(
                            "Sản phẩm %s, giá: %s",
                            $row['sp_ten'],
                            number_format($row['sp_gia'], 2, ".", ",") . ' vnđ'
                        )
                    );
                }


                ?>
                <table class="table mt-2">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mã</th>
                            <th scope="col">Tên tập tin</th>
                            <th scope="col">Mã sản phẩm</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($data as $hsp) : ?>
                            <tr>
                                <td scope="row"><?= $count++; ?></td>
                                <td><?= $hsp['hsp_ma']; ?></td>
                                <td>
                                    <img src="/project-D20085/assets/uploads/products/<?= $hsp['hsp_tentaptin'] ?>" class="img-fluid" width="100px" />
                                </td>
                                <td><?= $hsp['sp_tt']; ?></td>
                                <td>
                                    <a href="edit.php?hsp_ma=<?= $hsp['hsp_ma'] ?>" class="btn btn-warning">
                                        <span data-feather="edit">Sửa</span>
                                    </a>
                                    <a href="delete.php?hsp_ma=<?= $hsp['hsp_ma'] ?>" class="btn btn-danger">
                                        <span data-feather="edit">Xoá</span>
                                    </a>
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