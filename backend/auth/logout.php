<?php
if (session_id() === '') {
    session_start();
}

if(isset($_SESSION['kh_tendangnhap_logged'])) {
    unset($_SESSION['kh_tendangnhap_logged']);
    if(isset($_SESSION['kh_quantri'])){
        unset($_SESSION['kh_quantri']);
    }
    echo '<script>location.href = "/project-D20085/index.php?direct=dangnhap";</script>';
}
else {
    echo 'Người dùng chưa đăng nhập. Không thể đăng xuất dược!'; die;
}