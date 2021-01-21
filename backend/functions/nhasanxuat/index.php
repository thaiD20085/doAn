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
    <?php include_once(__DIR__.'/../../partials/header.php')?>
    <main role="main">
        <div>
            <h1 class="h2">Danh sách các Nhà sản xuất</h1>
        </div>
        <?php
        // ket noi csdl
        include_once(__DIR__ . '/../../../dbconnect.php');
        // cau lenh sql 
        $sqlSelect = <<<EOT
        SELECT nsx_id, nxs_ten
        FROM nhasanxuat;
EOT;
        $result = mysqli_query($conn, $sqlSelect);
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = array(
                'nsx_id' => $row['nsx_id'],
                'nxs_ten' => $row['nxs_ten']
            );
        }
        ?>
        <table>
            <thead>
                <tr>
                    <th>Mã nhà sản xuất</th>
                    <th>Tên nhà sản xuất</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $nsx) : ?>
                    <tr>
                        <td><?= $nsx['nsx_id']; ?></td>
                        <td><?= $nsx['nxs_ten']; ?></td>
                        <td>
                            <a href="edit.php?lsp_ma=<?= $loaisanpham['lsp_ma'] ?>" class="btn btn-warning">
                                <span data-feather="edit"></span> Sửa
                            </a>
                            <a href="delete.php?lsp_ma=<?= $loaisanpham['lsp_ma'] ?>" class="btn btn-danger">
                                <span data-feather="delete"></span> Xóa
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>