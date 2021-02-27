<?php
if (session_id() == null) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once(__DIR__ . '/../layouts/config.php'); ?>

<head>
    <?php include_once(__DIR__ . '/../layouts/head.php'); ?>
    <style>
        .address {
            text-align: left;
        }

        .address a {
            color: black;
            text-decoration: none;
        }

        .address a:hover {
            color: #007bff;
        }

        .car {
            border: 1px solid gray;
            border-radius: 5px;
            height: auto;
        }

        .i-less {
            transform: rotate(45deg);
        }

        img {
            transition: transform 0.4s;
        }

        img:hover {
            transform: scale(1.2);
            transition: transform 0.4s;
        }

        .input-color {
            display: none;
        }

        .h2 {
            text-shadow: 1px 1px 2px darkgray;
        }

        .radio-group li label:hover {
            cursor: pointer;
        }

        .color label i:hover {
            cursor: pointer;
        }

        #rgRight {
            transform: rotate(180deg);
        }

        .my-range {
            width: 40%;
        }

        .txtGia {
            width: 45px;
            font-size: 1em;
        }
    </style>
</head>

<body>
    <?php include_once(__DIR__ . '/../partials/header.php') ?>
    <!-- main content-------------------------------------------------------------------------------- -->
    <div id="app">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <!-- address -->
                    <div class="col-12 py-2">
                        <span class="address">
                            <a href="../index.html"><u>Trang chủ</u></a>
                            <span> <i class="fa fa-angle-right" aria-hidden="true"></i> </span>
                            <span style="color:rgba(0, 0, 0, .4);">Ô tô</span>
                        </span>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-3" id="top-side-menu">
                        <h5>Lọc sản phẩm</h5>
                    </div>

                </div>
            </div>
        </div>
        <?php
        include_once(__DIR__ . '/../../dbconnect.php');
        $count = 1;
        $sql  = <<<EOT
                SELECT sp.sp_ma, sp_ten, sp_gia, sp_giacu, sp_mota_ngan, lsp_ma, nsx_ma,
                    hsp_tentaptin
                    FROM sanpham sp 
                    LEFT JOIN hinhsanpham hsp ON sp.sp_ma = hsp.sp_ma
EOT;
        $data = [];
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = array(
                'sp_ma' => $row['sp_ma'],
                'sp_ten' => $row['sp_ten'],
                'sp_gia' => $row['sp_gia'],
                'sp_mota_ngan' => $row['sp_mota_ngan'],
                'lsp_ma' => $row['lsp_ma'],
                'nsx_ma' => $row['nsx_ma'],
                'hsp_tentaptin' => $row['hsp_tentaptin'],
            );
        }
        $sql_lsp = <<<EOT
        SELECT lsp_ma, lsp_ten
	        FROM loaisanpham
EOT;
        $result_lsp = mysqli_query($conn, $sql_lsp);
        $data_lsp = [];
        while ($row_lsp = mysqli_fetch_array($result_lsp, MYSQLI_ASSOC)) {
            $data_lsp[] = array(
                'lsp_ma' => $row_lsp['lsp_ma'],
                'lsp_ten' => $row_lsp['lsp_ten'],
            );
        }
        $sql_nsx = <<<EOT
        SELECT nsx_ma, nsx_ten
	        FROM nhasanxuat
EOT;
        $result_nsx = mysqli_query($conn, $sql_nsx);
        $data_nsx = [];
        while ($row_nsx = mysqli_fetch_array($result_nsx, MYSQLI_ASSOC)) {
            $data_nsx[] = array(
                'nsx_ma' => $row_nsx['nsx_ma'],
                'nsx_ten' => $row_nsx['nsx_ten'],
            );
        }

        ?>
        <div class="container">
            <div class="row">
                <!-- side menu --------------------------------------------------------------------------- -->
                <div class="col-md-3" id="menu-side">
                    <div class="input-group mb-3">
                        <div class="form-group w-100">
                            <input type="text" class="form-control search" name="txtTimKiem" id="txtTimKiem" placeholder="Tìm kiếm">

                        </div>
                        <ul class="brand list-nonestyle w-100">
                            <!-- Nhà sản xuất ----------------------------------------->
                            <li class="side-catalog w-100">
                                <div class="btn btn-outline-secondary w-100 btn-menu">
                                    Nhà sản xuất
                                    <i class="fa fa-plus px-1" aria-hidden="true"></i>
                                </div>
                                <ul class="list-nonestyle radio-group hide">
                                    <li class="pt-2">
                                        <input type="radio" name="rdthuongHieu" id="rdthuongHieu0" data-filter="" checked />
                                        <label for="rdthuongHieu0">Any</label>
                                    </li>
                                    <?php foreach ($data_nsx as $nsx) : ?>
                                        <li class="pt-2">
                                            <input type="radio" name="rdthuongHieu" id="rdthuongHieu<?= $nsx['nsx_ma']; ?>" data-filter="<?= $nsx['nsx_ma']; ?>" />
                                            <label for="rdthuongHieu<?= $nsx['nsx_ma']; ?>"><?=$nsx['nsx_ten']; ?></label>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <!-- Loại ----------------------------------------->
                            <li class="side-catalog w-100">
                                <div class="btn btn-outline-secondary w-100 btn-menu">
                                    Loại sản phẩm
                                    <i class="fa fa-plus px-1" aria-hidden="true"></i>
                                </div>
                                <ul class="list-nonestyle radio-group hide" data-filter-group="dongXe">
                                    <li class="pt-2">
                                        <input type="radio" name="rdLoaisanpham" id="rdLoaisanpham0" data-filter="" checked />
                                        <label for="rdLoaisanpham0">Any</label>
                                        <?php foreach ($data_lsp as $lsp) : ?>
                                        <li class="pt-2">
                                            <input type="radio" name="rdLoaisanpham" id="rdLoaisanpham<?= $lsp['lsp_ma']; ?>" data-filter="<?= $lsp['lsp_ma']; ?>" />
                                            <label for="rdLoaisanpham<?= $lsp['lsp_ma']; ?>"><?=$lsp['lsp_ten']; ?></label>
                                        </li>
                                    <?php endforeach; ?>
                                    </li>

                                </ul>
                            </li>


                        </ul>
                    </div>

                </div>
                <!-- products ---------------------------------------------------------------------------- -->

                <div class="col-md-9">
                    <div class=" grid row row-cols-2 row-cols-md-3" id="products-area">
                        <div class="col item" v-for="sp in sanpham" v-bind:class="[sp.loai,sp.nsx]">
                            <product-item v-bind:obj="sp" v-bind:key="sp.id"></product-item>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Footer-->
    <?php include_once(__DIR__ . '/../partials/footer.php'); ?>

    <!--SCRIPT-->
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
    <script>
        $(document).ready(function() {
            $('.hide').hide();

            $('.btn-menu').click(function() {
                $(this).parent().children('ul').toggle(500);
                $(this).children('i').toggleClass('i-less');
            });

            $('.input-color').on('click', function() {
                var test = $(this).prop("checked");
                $('.input-color').each(function() {
                    var chk = $(this).is(":checked");
                    if (chk) {
                        $(this).parent().children().children('.fa-circle').removeClass('d-none');
                        $(this).parent().children().children('.fa-dot-circle-o').addClass('d-none');
                    } else {
                        $(this).parent().children().children('.fa-circle').addClass('d-none');
                        $(this).parent().children().children('.fa-dot-circle-o').removeClass('d-none');
                    }
                });
            });
        })
        Vue.component("product-item", {
            props: ["obj"],
            template: `
                <div >
                    <div class="w-100 d-flex justify-content-center">
                        <img :src="obj.hinh" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title" style="height: 1.55rem; overflow: hidden;">{{obj.ten}}</h5>
                        <small><span class="card-text">{{obj.gia}}</span></small>
                        <a  v-bind:href="'/project-D20085/index.php?direct=chitiet&sp_ma='+obj.ma">Chi tiết</a>
                    </div>
                </div>
            `,
        });
        var app = new Vue({
            el: '#app',
            data: {
                sanpham: [
                    <?php foreach ($data as $sp) : ?> {
                            id: '<?= $count++; ?>',
                            hinh: '/project-D20085/assets/uploads/products/<?php echo $sp['hsp_tentaptin']; ?>',
                            ma: '<?= $sp['sp_ma']; ?>',
                            ten: '<?= $sp['sp_ten']; ?>',
                            gia: '<?php echo number_format($sp['sp_gia'], 2, ".", ",") . "VNĐ"; ?>',
                            nsx: '<?= $sp['nsx_ma']; ?>',
                            lsp: '<?= $sp['lsp_ma']; ?>',
                            motangan: '<?= $sp['sp_mota_ngan']; ?>',
                        },
                    <?php endforeach; ?>
                ],

            },

        });
    </script>
</body>

</html>