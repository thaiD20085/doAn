<?php
// var_dump($_SERVER["SCRIPT_NAME"]);die;

// Biến $_SERVER là biến hệ thống do PHP quản lý, dùng để lưu trữ các thông tin về Request gởi đến Server
// Trong đó key: $_SERVER['SCRIPT_NAME']
// Dùng để lưu trữ giá trị thông tin đường dẫn URL
// Tùy theo đường dẫn URL, set giá trị Tên trang và Tiêu đề phù hợp
if (!isset($_SESSION['kh_quantri']))
  die;
switch ($_SERVER['SCRIPT_NAME']) {
    // CRUD Danh mục Loại sản phẩm
  case "/project-D20085/backend/functions/shop_categories/index.php":
    $CURRENT_PAGE = "backend.shop_categories.index";
    $PAGE_TITLE = "Danh sách";
    break;
  case "/project-D20085/backend/functions/shop_categories/create.php":
    $CURRENT_PAGE = "backend.shop_categories.create";
    $PAGE_TITLE = "Thêm mới";
    break;
  case "/project-D20085/backend/functions/shop_categories/edit.php":
    $CURRENT_PAGE = "backend.shop_categories.edit";
    $PAGE_TITLE = "Sửa";
    break;

    // Tên trang và Tiêu đề mặc định
  default:
    $CURRENT_PAGE = "backend.index";
    $PAGE_TITLE = "Chào mừng các bạn đến với Nền tảng.VN!";
}