<!-- Nhúng file cấu hình để xác định được Tên và Tiêu đề của trang hiện tại người dùng đang truy cập -->
<?php include_once(__DIR__ . '/../../layouts/config.php'); ?>

<!DOCTYPE html>
<html>

<head>
  <!-- Nhúng file quản lý phần HEAD -->
  <?php include_once(__DIR__ . '/../../layouts/head.php'); ?>
</head>

<body class="d-flex flex-column h-100">
  <!-- header -->
  <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
  <!-- end header -->

  <div class="container-fluid">
    <div class="row">
      <!-- sidebar -->
      <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
      <!-- end sidebar -->

      <main role="main" class="col-md-10 ml-sm-auto px-4 mb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Đơn hàng</h1>
        </div>
        <?php 
        include_once(__DIR__. '/../../../dbconnect.php');

        $sqlSelectDDH = <<<EOT
        SELECT  ddh.dh_ma, kh.kh_ten, ddh.dh_ngaylap, ddh.dh_ngaygiao, ddh.dh_noigiao, ddh.dh_trangthaithanhtoan, 
            httt.httt_ten , SUM(spddh.sp_dh_soluong* spddh.sp_dh_dongia) AS tongthanhtien
        FROM dondathang ddh
        JOIN sanpham_dondathang spddh ON spddh.dh_ma = ddh.dh_ma
        JOIN khachhang kh ON kh.kh_tendangnhap = ddh.kh_tendangnhap
        JOIN hinhthucthanhtoan httt ON httt.httt_ma = ddh.httt_ma
        GROUP BY kh.kh_ten ,ddh.dh_ma, ddh.dh_ngaylap, ddh.dh_ngaygiao, ddh.dh_noigiao, ddh.dh_trangthaithanhtoan, 
            httt.httt_ten
EOT;

        $result = mysqli_query($conn, $sqlSelectDDH);
        $data = []; 
        while ( $row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
          $data[] = array(
            'dh_ma' => $row['dh_ma'],
            'kh_ten' => $row['kh_ten'],
            'dh_ngaylap' => $row['dh_ngaylap'],
            'dh_ngaygiao' => $row['dh_ngaygiao'],
            'dh_noigiao' => $row['dh_noigiao'],
            'dh_trangthaithanhtoan' => $row['dh_trangthaithanhtoan'],
            'httt_ten' => $row['httt_ten'],
            'tongthanhtien' => $row['tongthanhtien']
          );
        };
        ?>
        <a href="./create.php" class="btn btn-primary">
          Thêm mới
        </a>
        <table id="tblDanhSach" class="table table-bordered table-hover table-sm table-responsive mt-2">
          <thead>
            <tr>
              <th>Mã đơn hàng</th>
              <th>Tên khách hàng</th>
              <th>Ngày lập</th>
              <th>Ngày giao</th>
              <th>Nơi giao</th>
              <th>Hình thức thanh toán</th>
              <th>Tổng thành tiền</th>
              <th>Trạng thái thanh toán</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($data as $dondathang) : ?>
            <tr>
                <td><?= $dondathang['dh_ma'] ?></td>
                <td><b><?= $dondathang['kh_ten'] ?></td>
                <td><?= $dondathang['dh_ngaylap'] ?></td>
                <td><?= $dondathang['dh_ngaygiao'] ?></td>
                <td><?= $dondathang['dh_noigiao'] ?></td>
                <td><span class="badge badge-primary"><?= $dondathang['httt_ten'] ?></span></td>
                <td><?= $dondathang['tongthanhtien'] ?></td>
                <td>
                    <?php if ($dondathang['dh_trangthaithanhtoan'] == 0) : ?>
                        <span class="badge badge-danger">Chưa xử lý</span>
                    <?php else : ?>
                        <span class="badge badge-success">Đã giao hàng</span>
                    <?php endif; ?>
                </td>
                <td>
                    <!-- Đơn hàng nào chưa thanh toán thì được phép phép Xóa, Sửa -->
                    <?php if ($dondathang['dh_trangthaithanhtoan'] == 0) : ?>
                        <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `dh_ma` -->
                        <a href="edit.php?dh_ma=<?= $dondathang['dh_ma'] ?>" class="btn btn-warning">
                            Sửa
                        </a>
                        <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `dh_ma` -->
                        <a href="delete.php?dh_ma=<?= $dondathang['dh_ma'] ?>" class="btn btn-danger btnDelete" data-dh_ma="<?= $dondathang['dh_ma'] ?>">
                            Xóa
                        </a>
                    <?php else : ?>
                        <!-- Đơn hàng nào đã thanh toán rồi thì không cho phép Xóa, Sửa (không hiển thị 2 nút này ra giao diện) 
                        - Cho phép IN ấn ra giấy
                        -->
                        <!-- Nút in, bấm vào sẽ hiển thị mẫu in thông tin dựa vào khóa chính `dh_ma` -->
                        <a href="print.php?dh_ma=<?= $dondathang['dh_ma'] ?>" class="btn btn-success">
                            In
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
          </tbody>
        </table>
      </main>
    </div>
  </div>

  <!-- footer -->
  <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
  <!-- end footer -->

  <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
  <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>

  <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
  <!-- <script src="..."></script> -->
  
</body>

</html>