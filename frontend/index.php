<?php
if (session_id() == null) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once(__DIR__ . '/layouts/config.php'); ?>

<head>
    <?php include_once(__DIR__ . '/layouts/head.php'); ?>
    <link href="/project-D20085/assets/frontend/css/index.css" rel="stylesheet" type="text/css" />
    <style>
    </style>
</head>

<body>
    <!--Navigation bar-->
    <?php include_once(__DIR__ . '/partials/header.php') ?>
    <div id="app">
        <!--Slide show-->
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/project-D20085/assets/frontend/img/slider/slider-1.jpg" class="d-block w-100 img-fluid" alt="..." />
                </div>

                <div class="carousel-item">
                    <img src="/project-D20085/assets/frontend/img/slider/slider-2.jpg" class="d-block w-100 img-fluid" alt="..." />
                </div>
                <div class="carousel-item">
                    <img src="/project-D20085/assets/frontend/img/slider/slider-3.jpg" class="d-block w-100 img-fluid" alt="..." />
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="container-fluid">
            <div class="container pt-4">
                <!--Title -->
                <div class="row pt-4">
                    <div class="col-md-12 text-center">
                        <h3 class="font-weight-bolder" id="title">
                            CÁC DÒNG SẢN PHẨM
                        </h3>
                        <h6>TÌM SỰ LỰA CHỌN CỦA BẠN</h6>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" width="100%">
                        <div class="text-center">
                            <button type="button" class="btnLuachon font-weight-bold" id="btnLuachon1">
                                LINH KIỆN
                            </button>
                            <button type="button" class="btnLuachon font-weight-bold" id="btnLuachon2">
                                THIẾT BỊ
                            </button>
                        </div>
                    </div>
                </div>
                <!--car-->
                <div id="linhkien">
                    <div class="row row-cols-1 row-cols-md-3">
                        <div class="col d-flex align-items-center product-card" v-for="lk in linhkien" v-if="lk.id < 4">
                            <img :src="lk.hinh" class="w-100 img-fluid" :alt="lk.ten" />
                            <h2 class="product-title">{{lk.ten}}</h2>
                        </div>
                    </div>
                </div>

                <!-- news  -->

            </div>
        </div>
        <div class="container-fluid" id="news-con">
            <div class="row mp-4">
                <div class="col-md-12 text-center">
                    <h3 class="font-weight-bolder" id="title">TIN TỨC</h3>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2">
                <div class="cols newscol ">
                    <div class="news-border">
                        <div class="imgBox">
                            <img src="/project-D20085/assets/frontend/img/news/hot_news.jpg" class="img-fluid" />
                        </div>
                        <h5 class="text-center">VINFAST PRESIDENT V8 SUV REVEALED</h5>
                        <a href="#" class="btn text-right w-100">Xem thêm <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="cols newscol">
                    <div class="row row-cols-2">
                        <div class="col" v-for="nw in news">
                            <div class="news-border">
                                <div class="imgBox">
                                    <img :src="nw.hinh" class="img-fluid" />
                                </div>
                                <p class="news-text">{{nw.chitiet}}</p>
                                <a href="#" class="btn text-right w-100">Xem thêm <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Footer-->
    <?php include_once(__DIR__ . '/partials/footer.php'); ?>

    <!--SCRIPT-->
    <?php include_once(__DIR__ . '/layouts/scripts.php'); ?>
    <script>
        $(document).ready(function() {
            $('#btnLuachon1').css('color', '#007bff');
            $('#btnLuachon1').click(function() {
                $('#linhkien').show(500);
                $(this).css('color', '#007bff');
                $('#btnLuachon2').css('color', '#000');
                $('#bike').hide(500);
            });
            $('#btnLuachon2').click(function() {
                $('#linhkien').hide(500);
                $(this).css('color', '#007bff');
                $('#btnLuachon1').css('color', '#000');
                $('#bike').show(500);
            });

        });
        var app = new Vue({
            el: '#app',
            data: {
                linhkien: [{
                        id: '1',
                        hinh: '/project-D20085/assets/frontend/img/mathang/mainboard.webp',
                        ten: 'Mainboard',
                    },
                    {
                        id: '2',
                        hinh: '/project-D20085/assets/frontend/img/mathang/vga.webp',
                        ten: 'VGA',
                    },
                    {
                        id: '3',
                        hinh: '/project-D20085/assets/frontend/img/mathang/cpu.webp',
                        ten: 'CPU',
                    },
                ],
                news: [{
                        id: '1',
                        hinh: '/project-D20085/assets/frontend/img/news/new_1.jpg',
                        chitiet: 'Sở hữu ngay bộ phụ kiện siêu "chất" của Vespa.',
                    },
                    {
                        id: '2',
                        hinh: '/project-D20085/assets/frontend/img/news/new_2.jpg',
                        chitiet: 'GIÁ TỐT XE SANG - NHẬN ƯU ĐÃI VÀNG: RINH VINFAST CHỈ TỪ 37 TRIỆU ĐỒNG',
                    },
                    {
                        id: '3',
                        hinh: '/project-D20085/assets/frontend/img/news/new_3.jpg',
                        chitiet: 'Honda Việt Nam giới thiệu phiên bản hoàn toàn mới mẫu xe Sh mode 125cc',
                    },
                    {
                        id: '4',
                        hinh: '/project-D20085/assets/frontend/img/news/new_4.jpg',
                        chitiet: 'Honda Việt Nam giới thiệu hai mẫu xe phân khối lớn hoàn toàn mới CBR1000RR-R Fireblade & CBR1000RR-R Fireblade SP',
                    },

                ],
            },

        });
    </script>
</body>

</html>