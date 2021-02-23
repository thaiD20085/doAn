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
          <h1 class="h2">Thêm mới</h1>
        </div>
        <?php 
        include_once(__DIR__. '/../../../dbconnect.php');

        $sqlSelectKH = <<<EOT
        SELECT kh_tendangnhap,kh_ten, kh_dienthoai
        FROM khachhang
EOT;

        $resultKH = mysqli_query($conn, $sqlSelectKH);
        $dataKH = []; 
        while ( $row = mysqli_fetch_array($resultKH, MYSQLI_ASSOC)){
          $dataKH[] = array(
            'kh_tendangnhap' => $row['kh_tendangnhap'],
            'kh_ten' => $row['kh_ten'],
            'kh_dienthoai' => $row['kh_dienthoai'],
          );
        };
        $sqlHTTT= <<<EOT
        SELECT httt_ma, httt_ten
        FROM hinhthucthanhtoan  
EOT;
        $resultHTTT = mysqli_query($conn, $sqlHTTT);
        $dataHTTT = [];
        while ($row = mysqli_fetch_array($resultHTTT, MYSQLI_ASSOC)){
          $dataHTTT[] = array(
            'httt_ma' => $row['httt_ma'],
            'httt_ten' => $row['httt_ten'],
          );
        }
        $sqlSP= <<<EOT
        SELECT sp_ma, sp_ten, sp_gia
        FROM sanpham
EOT;
        $resultSP = mysqli_query($conn, $sqlSP);
        $dataSP = [];
        while ($row = mysqli_fetch_array($resultSP, MYSQLI_ASSOC)){
          $dataSP[] = array(
            'sp_ma' => $row['sp_ma'],
            'sp_ten' => $row['sp_ten'],
            'sp_gia' => $row['sp_gia'],
          );
        }
        ?>
        <form name ="frmdh" id="frmdh" method="post" action="">
          <fieldset id="donHangContainer">
            <legend>Thông tin đơn hàng</legend>
            <div class="form-row">
              <div class="col">
                <div class="form-group">
                  <label>Khách hàng</label>
                  <select class="form-control" name="kh_tendangnhap" id="kh_tendangnhap">
                  <?php foreach($dataKH as $KH):?>
                    <option value="<?= $KH['kh_tendangnhap']?>"><?=$KH['kh_ten']?> - <?=$KH['kh_dienthoai']?></option>

                  <?php endforeach;?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <div class="form-group">
                  <label>Ngày lập</label>
                  <input type="text" class="form-control" name="dh_ngaylap" id="dh_ngaylap"/>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Ngày giao</label>
                  <input type="text" class="form-control" name="dh_ngaygiao" id="dh_ngaygiao"/>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Nơi giao</label>
                  <input type="text" class="form-control" name="dh_noigiao" id="dh_noigiao"/>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <div class="form-group">
                  <label>Trạng thái thanh toán</label><br />
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan-1" class="custom-control-input" value="0" checked>
                    <label class="custom-control-label" for="dh_trangthaithanhtoan-1">Chưa thanh toán</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan-2" class="custom-control-input" value="0" >
                    <label class="custom-control-label" for="dh_trangthaithanhtoan-2">Đã thanh toán</label>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>Hình thức thanh toán</label><br />
                  <select name="httt_ma" id="httt_ma" class="form-control">
                  <option value="">Vui lòng chọn Hình thức thanh toán</option>
                      <?php foreach ($dataHTTT as $httt) : ?>
                          <option value="<?= $httt['httt_ma'] ?>"><?= $httt['httt_ten'] ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </fieldset>
          <fieldset id="chiTietDonHangContainer">
            <legend>Thông tin Chi tiết Đơn hàng</legend>
            <div class="form-row">
              <div class="col">
                  <div class="form-group">
                      <label for="sp_ma">Sản phẩm</label>
                      <select class="form-control" id="sp_ma" name="sp_ma">
                          <option value="">Vui lòng chọn Sản phẩm</option>
                          <?php foreach ($dataSP as $sanpham) : ?>
                              <option value="<?= $sanpham['sp_ma'] ?>" data-sp_gia="<?= $sanpham['sp_gia'] ?>"><?= $sanpham['sp_ten'] ?></option>
                          <?php endforeach; ?>
                      </select>
                  </div>
              </div>
              <div class="col">
                  <div class="form-group">
                      <label>Số lượng</label>
                      <input type="text" name="soluong" id="soluong" class="form-control" />
                  </div>
              </div>
              <div class="col">
                  <div class="form-group">
                      <label>Xử lý</label><br />
                      <button type="button" id="btnThemSanPham" class="btn btn-primary">Thêm vào đơn hàng</button>
                  </div>
              </div>
            </div>
            <table id="tblChiTietDonHang" class="table table-bordered">
              <thead>
                  <th>Sản phẩm</th>
                  <th>Số lượng</th>
                  <th>Đơn giá</th>
                  <th>Thành tiền</th>
                  <th>Hành động</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </fieldset>
          <button class="btn btn-primary" name="btnSave">Lưu</button>
        </form>
        <?php
          if(isset($_POST['btnSave'])){
            $kh_tendangnhap = $_POST['kh_tendangnhap'];
            $dh_ngaylap = $_POST['dh_ngaylap'];
            $dh_ngaygiao = $_POST['dh_ngaygiao'];
            $dh_noigiao = $_POST['dh_noigiao'];
            $dh_trangthaithanhtoan = $_POST['dh_trangthaithanhtoan'];
            $httt_ma = $_POST['httt_ma'];
          
            $sqlInsertHD = <<<EOT
            INSERT INTO dondathang
              (dh_ngaylap, dh_ngaygiao, dh_noigiao, dh_trangthaithanhtoan, httt_ma, kh_tendangnhap)
              VALUES ('$dh_ngaylap', '$dh_ngaygiao', '$dh_noigiao', $dh_trangthaithanhtoan, $httt_ma, '$kh_tendangnhap')
EOT;
            mysqli_query($conn, $sqlInsertHD);
            $dh_ma = $conn->insert_id;

            $arr_sp_ma = $_POST['sp_ma'];
            $arr_sp_dh_soluong = $_POST['sp_dh_soluong'];
            $arr_sp_dh_dongia = $_POST['sp_dh_dongia'];
            
            $i=0;
            for ($i=0 ; $i < count($arr_sp_ma); $i++){
              $sp_ma = $arr_sp_ma[$i];
              $sp_dh_soluong = $arr_sp_dh_soluong[$i];
              $sp_dh_dongia = $arr_sp_dh_dongia[$i];
              $sqlInsert = <<<EOT
              INSERT INTO sanpham_dondathang
              (sp_ma, dh_ma, sp_dh_soluong, sp_dh_dongia)
              VALUES ($sp_ma, $dh_ma, $sp_dh_soluong, $sp_dh_dongia);
EOT;
              mysqli_query($conn, $sqlInsert);
            }


            
          }
        ?>

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
  <script>
    $('#btnThemSanPham').click(function(){
      var sp_ma = $('#sp_ma').val();
      var soluong = $('#soluong').val();
      if(sp_ma != '' && soluong >0 ){
        var sp_gia = $('#sp_ma option:selected').data('sp_gia');
        var sp_ten = $('#sp_ma option:selected').text();
        var thanhtien = (soluong * sp_gia);
      var tmp = '<tr>'; 
          tmp += '<td>' + sp_ten + '<input type="hidden" name="sp_ma[]" value="' + sp_ma + '"/></td>';
          tmp += '<td>' + soluong + '<input type="hidden" name="sp_dh_soluong[]" value="' + soluong + '"/></td>';
          tmp += '<td>' + sp_gia + '<input type="hidden" name="sp_dh_dongia[]" value="' + sp_gia + '"/></td>';
          tmp += '<td>' + thanhtien + '</td>';
          tmp += '<td><button type="button" class="btn btn-danger btn-delete-row">Xóa</button></td>';
          tmp += '</tr>';

      $('#tblChiTietDonHang tbody').append(tmp);

      $('#sp_ma').val('');
      $('#soluong').val('');
      }
    })
    $('#chiTietDonHangContainer').on('click', '.btn-delete-row', function() {
      $(this).parent().parent()[0].remove();
    });
    $(".totalSum").text('$' + parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
  </script>
</body>

</html>