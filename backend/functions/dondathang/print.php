<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Paper CSS -->
    <link rel="stylesheet" href="/hocphp-cp20scf26/assets/vendor/paper-css/paper.css" type="text/css" />
    <style>
        @page {
            size: A4
        }
    </style>
</head>
<body class="A4">
<section class="sheet padding-10mm">
    <table border="0" width="100%" cellspacing="0">
        <tbody>
            <tr>
                <td align="center"><img src="/project-D20085/assets/shared/img/logo.webp" width="100px" height="100px" /></td>
                <td align="center">
                    <b style="font-size: 2em;">Project - D20085</b><br />
                    <small>Cung cấp kiến thức nền tảng về Lập trình, Thiết kế Web, Cơ sở dữ liệu</small><br />
                    <small>Giúp các bạn có niềm tin, hành trang kiến thức vững vàng trên con đường trở thành Nhà phát
                        triển
                        Phần mềm</small>
                </td>
            </tr>
        </tbody>                                                                
    </table>
<?php 
        include_once(__DIR__. '/../../../dbconnect.php');
        $dh_ma = $_GET['dh_ma'];

        $sqlSelectDDH = <<<EOT
        SELECT  ddh.dh_ma, kh.kh_ten, ddh.dh_ngaylap, ddh.dh_ngaygiao, ddh.dh_noigiao, ddh.dh_trangthaithanhtoan, 
                httt.httt_ten , SUM(spddh.sp_dh_soluong* spddh.sp_dh_dongia) AS tongthanhtien
        FROM dondathang ddh
        JOIN sanpham_dondathang spddh ON spddh.dh_ma = ddh.dh_ma
        JOIN khachhang kh ON kh.kh_tendangnhap = ddh.kh_tendangnhap
        JOIN hinhthucthanhtoan httt ON httt.httt_ma = ddh.httt_ma
        WHERE ddh.dh_ma = $dh_ma
        GROUP BY kh.kh_ten ,ddh.dh_ma, ddh.dh_ngaylap, ddh.dh_ngaygiao, ddh.dh_noigiao, ddh.dh_trangthaithanhtoan, 
                httt.httt_ten;
EOT;

        $result = mysqli_query($conn, $sqlSelectDDH);
        $dataDonDatHang = []; 
        while ( $row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
          $dataDonDatHang = array(
            'dh_ma' => $row['dh_ma'],
            'kh_ten' => $row['kh_ten'],
            'dh_ngaylap' => $row['dh_ngaylap'],
            'dh_ngaygiao' => $row['dh_ngaygiao'],
            'dh_noigiao' => $row['dh_noigiao'],
            'dh_trangthaithanhtoan' => $row['dh_trangthaithanhtoan'],
            'httt_ten' => $row['httt_ten'],
            'tongthanhtien' => number_format($row['tongthanhtien'], 0,".",",")." vnđ",
          );
        };
        // Lấy dữ liệu Sản phẩm đơn đặt hàng
    $sqlSelectSanPham = <<<EOT
    SELECT 
        sp.sp_ma, sp.sp_ten, spddh.sp_dh_dongia, spddh.sp_dh_soluong
        , lsp.lsp_ten, nsx.nsx_ten,
        (spddh.sp_dh_dongia*spddh.sp_dh_soluong) as thanhtien
    FROM `sanpham_dondathang` spddh
    JOIN `sanpham` sp ON spddh.sp_ma = sp.sp_ma
    JOIN `loaisanpham` lsp ON sp.lsp_ma = lsp.lsp_ma
    JOIN `nhasanxuat` nsx ON sp.nsx_ma = nsx.nsx_ma
    WHERE spddh.dh_ma=$dh_ma
EOT;
    
        // Thực thi câu truy vấn SQL để lấy về dữ liệu ban đầu của record cần update
        $resultSelectSanPham = mysqli_query($conn, $sqlSelectSanPham);
        $dataSanPham = [];
        while ($row = mysqli_fetch_array($resultSelectSanPham, MYSQLI_ASSOC)) {
            $dataSanPham[] = array(
                'sp_ma' => $row['sp_ma'],
                'sp_ten' => $row['sp_ten'],
                'sp_dh_dongia' => number_format($row['sp_dh_dongia'], 0,".",",")." vnđ",
                'sp_dh_soluong' => $row['sp_dh_soluong'],
                'lsp_ten' => $row['lsp_ten'],
                'nsx_ten' => $row['nsx_ten'],
                'thanhtien' => number_format($row['thanhtien'], 0,".",",")." vnđ",
            );
        }
        /* --- End Truy vấn dữ liệu Chi tiết Đơn hàng --- */
    
        // 4. Hiệu chỉnh dữ liệu theo cấu trúc để tiện xử lý
        $dataDonDatHang['danhsachsanpham'] = $dataSanPham;
        ?>
        <p><i><u>Thông tin Đơn hàng</u></i></p>
        <table border="0" width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <td width="30%">Khách hàng:</td>
                    <td><b><?= $dataDonDatHang['kh_ten'] ?>
                            </b></td>
                </tr>
                <tr>
                    <td>Ngày lập:</td>
                    <td><b><?= $dataDonDatHang['dh_ngaylap'] ?></b></td>
                </tr>
                <tr>
                    <td>Hình thức thanh toán:</td>
                    <td><b><?= $dataDonDatHang['httt_ten'] ?></b></td>
                </tr>
                <tr>
                    <td>Tổng thành tiền:</td>
                    <td><b><?= $dataDonDatHang['tongthanhtien'] ?></b></td>
                </tr>
            </tbody>
        </table>
        <p><i><u>Chi tiết đơn hàng</u></i></p>
        <table border="1" width="100%" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1;?>
                <?php foreach($dataSanPham as $sp): ?>
                <tr>
                    <td style="text-align:center"><?= $i++; ?></td>
                    <td>
                        <b><?= $sp['sp_ten']; ?></b><br />
                        <?= $sp['lsp_ten']; ?><br />
                        <?= $sp['nsx_ten']; ?>
                    </td>
                    <td style="text-align:right; padding-right:5px;"><?= $sp['sp_dh_soluong']; ?></td>
                    <td style="text-align:right; padding-right:5px;"><?= $sp['sp_dh_dongia']; ?></td>
                    <td style="text-align:right; padding-right:5px;"><?= $sp['thanhtien']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" align="right"><b>Tổng thành tiền</b></td>
                    <td align="right"><b><?= $dataDonDatHang['tongthanhtien'] ?></b></td>
                </tr>
            </tfoot>
        </table>

        <!-- Thông tin Footer -->
        <br />
        <table border="0" width="100%">
            <tbody>
                <tr>
                    <td align="center">
                        <small>Xin cám ơn Quý khách đã ủng hộ Cửa hàng, Chúc Quý khách An Khang, Thịnh Vượng!</small>
                    </td>
                </tr>
            </tbody>
        </table>
</section>
</body>
</html>