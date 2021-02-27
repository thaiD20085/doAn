<?php
// var_dump($_SERVER["SCRIPT_NAME"]);die;

// Biến $_SERVER là biến hệ thống do PHP quản lý, dùng để lưu trữ các thông tin về Request gởi đến Server
// Trong đó key: $_SERVER['SCRIPT_NAME']
// Dùng để lưu trữ giá trị thông tin đường dẫn URL
// Tùy theo đường dẫn URL, set giá trị Tên trang và Tiêu đề phù hợp
$PAGE_TITLE = "ĐỒ ÁN WEB 2 - TRANG CHỦ" ;
if (isset($direct))
  switch ($direct) {
      // CRUD Danh mục Loại sản phẩm
    case "linhkien":
      $PAGE_TITLE = "ĐỒ ÁN WEB2 - LINH KIỆN";
      break;
    case "dangnhap":
      $PAGE_TITLE = "ĐỒ ÁN WEB2 - ĐĂNG NHẬP";
      break;
    case "hotro":
      $PAGE_TITLE = "ĐỒ ÁN WEB2 - HỖ TRỢ";
      break;
    case "timcuahang":
      $PAGE_TITLE = "ĐỒ ÁN WEB2 - TÌM CỬA HÀNG";
      break;
    case "dangky":
      $PAGE_TITLE = "ĐỒ ÁN WEB2 - ĐĂNG LÝ";
      break;
    case "giohang":
      $PAGE_TITLE = "ĐỒ ÁN WEB2 - GIỎ HÀNG";
      break;
  }

