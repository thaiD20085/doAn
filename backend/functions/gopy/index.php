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
                    <h1 class="h2">Danh sách các Góp ý</h1>
                </div>
                <?php
                //1. ket noi csdl
                include_once(__DIR__ . '/../../../dbconnect.php');
                //2. cau lenh sql 
                $sql = <<<EOT
                SELECT gy_ma, gy_hoten, gy_email, gy_diachi, gy_dienthoai, gy_tieude, gy_noidung, gy_ngaygopy, cdgy.cdgy_ma, cdgy.cdgy_ten
	                FROM gopy gy
                    JOIN chudegopy cdgy ON cdgy.cdgy_ma = gy.cdgy_ma
EOT;
                $result = mysqli_query($conn, $sql);
                $data = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $data[] = array(
                        'gy_ma' => $row['gy_ma'],
                        'gy_hoten' => $row['gy_hoten'],
                        'gy_lienlac' => $row['gy_email'].'<br />'.$row['gy_email'].'<br />'.$row['gy_diachi'],
                        'gy_dienthoai' => $row['gy_dienthoai'],
                        'gy_tieude' => $row['gy_tieude'],
                        'gy_noidung' => $row['gy_noidung'],
                        'gy_ngaygopy' => date('d/m/Y H:i:s', strtotime($row['gy_ngaygopy'])),
                        'cdgy_tt' => $row['cdgy_ma'].'-'.$row['cdgy_ten'],
                    );
                }
                ?>
                <div class="table-regyonsive">
                    <table id="tableSP" class="table table-bordered table-hover mt-2 table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>STT</th>
                                <th>Mã</th>
                                <th>Họ tên</th>
                                <th>Liên lạc</th>
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                                <th>Ngày góp ý</th>
                                <th>Chủ đề góp ý</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($data as $gy) : ?>
                                <tr>
                                    <td><?=
                                        $count++ ?></td>
                                    <td><?= $gy['gy_ma'] ?></td>
                                    <td><?= $gy['gy_hoten'] ?></td>
                                    <td><?= $gy['gy_email'] ?></td>
                                    <td><?= $gy['gy_diachi'] ?></td>
                                    <td><?= $gy['gy_dienthoai'] ?></td>
                                    <td><?= $gy['gy_tieude'] ?></td>
                                    <td><?= $gy['gy_noidung'] ?></td>
                                    <td><?= $gy['gy_ngaygopy'] ?></td>
                                    <td><?= $gy['cdgy_tt'] ?></td>
                                    <td>
                                        <a href="edit.php?gy_ma=<?= $gy['gy_ma'] ?>" class="btn btn-warning">Sửa</a>
                                        <a href="delete.php?gy_ma=<?= $gy['gy_ma'] ?>" class="btn btn-danger">Xoá</a>
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