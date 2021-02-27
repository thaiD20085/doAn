<?php
include_once(__DIR__ . '/dbconnect.php');
if (!isset($_GET['direct'])) {
    include_once(__DIR__ . '/frontend/index.php');
} else {
    $direct = $_GET['direct'];
    switch ($direct) {
        case 'home':
            include_once(__DIR__ . '/frontend/index.php');
            break;
        case 'linhkien':
            include_once(__DIR__ . '/frontend/pages/linhkien.php');
            break;
        case 'chitiet':
            $sp_ma = $_GET['sp_ma'];
            echo '<script>location.href = "/project-D20085/frontend/pages/chitiet.php?sp_ma='.$sp_ma.'";</script>';
            break;
        case 'giohang':
            include_once(__DIR__ . '/frontend/thanhtoan/cart.php');
            break;
        case 'dathang':
            include_once(__DIR__ . '/frontend/thanhtoan/oder.php');
            break;
        case 'quanly':
            include_once(__DIR__ . '/backend/index.php');
            break;
        case 'timcuahang':
            include_once(__DIR__ . '/frontend/pages/timcuahang.php');
            break;
        case 'hotro':
            include_once(__DIR__ . '/frontend/pages/hotro.php');
            break;
        case 'dangnhap':
            include_once(__DIR__ . '/backend/auth/signin.php');
            break;
        case 'dangky':
            include_once(__DIR__ . '/backend/auth/signup.php');
            break;
        case 'dangxuat':
            include_once(__DIR__ . '/backend/auth/logout.php');
            break;
        default:
            echo "không có đường dẫn";
            break;
    };

}
