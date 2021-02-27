<?php
if (session_id() === '') {
  session_start();
}
?>
<?php include_once(__DIR__ . '/../layouts/config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once(__DIR__ . '/../layouts/head.php'); ?>
</head>

<body>
  <?php include_once(__DIR__ . '/../partials/header.php') ?>
  <div class="container-fluid">
    <div class="row">
      <?php include_once(__DIR__ . '/../partials/sidebar.php') ?>
      <main role="main" class="col-md-10 ml-sm-auto px-4 mb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Bảng tin DASHBOARD</h1>
        </div>

        <!-- Block content -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-primary mb-2">
                <div class="card-body pb-0">
                  <div class="text-value" id="baocaoSanPham_SoLuong">
                    <h1>0</h1>
                  </div>
                  <div>Tổng số mặt hàng</div>
                </div>
              </div>
              <button class="btn btn-primary btn-sm form-control" id="refreshBaoCaoSanPham">Refresh dữ liệu</button>
            </div> <!-- Tổng số mặt hàng -->
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-success mb-2">
                <div class="card-body pb-0">
                  <div class="text-value" id="baocaoKhachHang_SoLuong">
                    <h1>0</h1>
                  </div>
                  <div>Tổng số khách hàng</div>
                </div>
              </div>
              <button class="btn btn-success btn-sm form-control" id="refreshBaoCaoKhachHang">Refresh dữ liệu</button>
            </div> <!-- Tổng số khách hàng -->
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-warning mb-2">
                <div class="card-body pb-0">
                  <div class="text-value" id="baocaoDonHang_SoLuong">
                    <h1>0</h1>
                  </div>
                  <div>Tổng số đơn hàng</div>
                </div>
              </div>
              <button class="btn btn-warning btn-sm form-control" id="refreshBaoCaoDonHang">Refresh dữ liệu</button>
            </div> <!-- Tổng số đơn hàng -->
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-danger mb-2">
                <div class="card-body pb-0">
                  <div class="text-value" id="baocaoGopY_SoLuong">
                    <h1>0</h1>
                  </div>
                  <div>Tổng số góp ý</div>
                </div>
              </div>
              <button class="btn btn-danger btn-sm form-control" id="refreshBaoCaoGopY">Refresh dữ liệu</button>
            </div> <!-- Tổng số góp ý -->
            <div id="ketqua"></div>
          </div><!-- row -->
          <div class="row">
            <!-- Biểu đồ thống kê loại sản phẩm -->
            <div class="col-sm-6 col-lg-6">
              <canvas id="chartOfobjChartThongKeLoaiSanPham"></canvas>
              <button class="btn btn-outline-primary btn-sm form-control" id="refreshThongKeLoaiSanPham">Refresh dữ liệu</button>
            </div><!-- col -->

          </div><!-- row -->
        </div>
        <!-- End block content -->
      </main>
    </div>
  </div>
  <!-- FOOTER -->
  <?php include_once(__DIR__ . '/../partials/footer.php'); ?>

  <?php include_once(__DIR__ . '/../../backend/layouts/scripts.php'); ?>

  <script src="/project-D20085/assets/vendor/Chart.js/Chart.min.js"></script>
  <script>
    $(document).ready(function() {
      // ----------------- Tổng số mặt hàng --------------------------
      function getDuLieuBaoCaoTongSoMatHang() {
        $.ajax('/project-D20085/backend/api/baocao-tongsomathang.php', {
          success: function(data) {
            var dataObj = JSON.parse(data);
            var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
            $('#baocaoSanPham_SoLuong').html(htmlString);
          },
          error: function() {
            var htmlString = `<h1>Không thể xử lý</h1>`;
            $('#baocaoSanPham_SoLuong').html(htmlString);
          }
        });
      }
      $('#refreshBaoCaoSanPham').click(function(event) {
        event.preventDefault();
        getDuLieuBaoCaoTongSoMatHang();
      });

      // ----------------- Tổng số khách hàng --------------------------
      function getDuLieuBaoCaoTongSoKhachHang() {
        $.ajax('/project-D20085/backend/api/baocao-tongsokhachhang.php', {
          success: function(data) {
            var dataObj = JSON.parse(data);
            var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
            $('#baocaoKhachHang_SoLuong').html(htmlString);
          },
          error: function() {
            var htmlString = `<h1>Không thể xử lý</h1>`;
            $('#baocaoKhachHang_SoLuong').html(htmlString);
          }
        });
      }
      $('#refreshBaoCaoKhachHang').click(function(event) {
        event.preventDefault();
        getDuLieuBaoCaoTongSoKhachHang();
      });

      // ----------------- Tổng số đơn hàng --------------------------
      function getDuLieuBaoCaoTongSoDonHang() {
        $.ajax('/project-D20085/backend/api/baocao-tongsodonhang.php', {
          success: function(data) {
            var dataObj = JSON.parse(data);
            var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
            $('#baocaoDonHang_SoLuong').html(htmlString);
          },
          error: function() {
            var htmlString = `<h1>Không thể xử lý</h1>`;
            $('#baocaoDonHang_SoLuong').html(htmlString);
          }
        });
      }
      $('#refreshBaoCaoDonHang').click(function(event) {
        event.preventDefault();
        getDuLieuBaoCaoTongSoDonHang();
      });

      // ----------------- Tổng số Góp ý --------------------------
      function getDuLieuBaoCaoTongSoGopY() {
        $.ajax('/project-D20085/backend/api/baocao-tongsogopy.php', {
          success: function(data) {
            var dataObj = JSON.parse(data);
            var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
            $('#baocaoGopY_SoLuong').html(htmlString);
          },
          error: function() {
            var htmlString = `<h1>Không thể xử lý</h1>`;
            $('#baocaoGopY_SoLuong').html(htmlString);
          }
        });
      }
      $('#refreshBaoCaoGopY').click(function(event) {
        event.preventDefault();
        getDuLieuBaoCaoTongSoGopY();
      });


      // ------------------ Vẽ biểu đồ thống kê Loại sản phẩm -----------------
      // Vẽ biểu đổ Thống kê Loại sản phẩm sử dụng ChartJS
      var $objChartThongKeLoaiSanPham;
      var $chartOfobjChartThongKeLoaiSanPham = document.getElementById("chartOfobjChartThongKeLoaiSanPham").getContext(
        "2d");

      function renderChartThongKeLoaiSanPham() {
        $.ajax({
          url: '/project-D20085/backend/api/baocao-thongkeloaisanpham.php',
          type: "GET",
          success: function(response) {
            var data = JSON.parse(response);
            var myLabels = [];
            var myData = [];
            $(data).each(function() {
              myLabels.push((this.TenLoaiSanPham));
              myData.push(this.SoLuong);
            });
            myData.push(0); // tạo dòng số liệu 0
            if (typeof $objChartThongKeLoaiSanPham !== "undefined") {
              $objChartThongKeLoaiSanPham.destroy();
            }
            $objChartThongKeLoaiSanPham = new Chart($chartOfobjChartThongKeLoaiSanPham, {
              // Kiểu biểu đồ muốn vẽ. Các bạn xem thêm trên trang ChartJS
              type: "pie",
              data: {
                labels: myLabels,
                datasets: [{
                  data: myData,
                  borderWidth: 1,
                  backgroundColor: ["#FF6384", "#FFCD56", "#36A2EB","#FFAD5C","#E1D1FF","#FF6384", "#FFCD56", "#36A2EB","#FFAD5C"], 
                }]
              },
              // Cấu hình dành cho biểu đồ của ChartJS
              options: {
                legend: {
                  display: false
                },
                title: {
                  display: true,
                  text: "Thống kê Loại sản phẩm"
                },
                responsive: true
              }
            });
          }
        });
      };
      $('#refreshThongKeLoaiSanPham').click(function(event) {
        event.preventDefault();
        renderChartThongKeLoaiSanPham();
      });

      // Mới mở web (khi trang web load xong)
      // thì sẽ gọi lập tức một số hàm AJAX gọi API lấy dữ liệu
      getDuLieuBaoCaoTongSoMatHang();
      getDuLieuBaoCaoTongSoKhachHang();
      getDuLieuBaoCaoTongSoDonHang();
      getDuLieuBaoCaoTongSoGopY();
      renderChartThongKeLoaiSanPham();

    });
  </script>
</body>

</html>