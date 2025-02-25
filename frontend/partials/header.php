<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark pb-1 d-tablet-none">
        <div class="container w-100">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto nav-top">
                    <li class="nav-item">
                        <a href="tel:0706823275" class="px-2 py-3">Hotline: 0706 823 275 (8h- 11h, 13h30- 17h)</a>
                    </li>
                    <li class="nav-item">
                        <a href="/project-D20085/index.php?direct=timcuahang" class="px-2 py-3">Tìm cửa hàng</a>
                    </li>
                </ul>

                <?php if (!isset($_SESSION['kh_tendangnhap_logged'])) : ?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item pl-4">
                            <a class="nav-link btn btn-sm font-weight-bold py-1" href="/project-D20085/index.php?direct=dangnhap">ĐĂNG NHẬP </a>
                        </li>
                        <li class="nav-item d-tablet-none">
                            <a class="nav-link btn btn-primary btn-sm font-weight-bold py-1" style="color:white;" href="/project-D20085/index.php?direct=dangky">ĐĂNG KÝ</a>
                        </li>
                    </ul>
                <?php else : ?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item pl-4">
                            <a class="nav-link btn btn-sm font-weight-bold py-1" href="/project-D20085/index.php?direct=dangxuat">ĐĂNG XUẤT</a>
                        </li>
                        <?php if (isset($_SESSION['kh_quantri'])):?>
                        <li class="nav-item d-tablet-none">
                            <a class="nav-link btn btn-primary btn-sm font-weight-bold py-1" style="color:white;" href="/project-D20085/index.php?direct=quanly">QUẢN LÝ</a>
                        </li>
                        <?php endif;?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container w-100">
            <a class="navbar-brand" href="/project-D20085/index.php">
                <h2 class="font-weight-bold" style="color:#FCA311">Linh kiện vi tính</h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ml-3" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto font-weight-bold nav-bottom">
                    <li class="nav-item active">
                        <a class="nav-link" href="/project-D20085/index.php">TRANG CHỦ<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project-D20085/index.php?direct=linhkien">LINH KIỆN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/project-D20085/frontend/pages/hotro.php">HỖ TRỢ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-tablet-block" href="/project-D20085/frontend/pages/signin.php">ĐĂNG NHẬP </a>
                    </li>
                    <li class="nav-item d-tablet-block">
                        <a class="nav-link d-tablet-block" href="/project-D20085/frontend/pages/signup.php">ĐĂNG KÝ</a>
                    </li>
                </ul>
                <form id="search" class="d-tablet-none">
                    <label for="txtSearch"><button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button></label>
                    <input type="text" name="txtSearch" id="txtSearch" placeholder="Tìm kiếm" readonly/>
                    <button type="reset"><i class="fa fa-times-circle text-danger" aria-hidden="true"></i></button>
                </form>
                <a href="/project-D20085/index.php?direct=giohang" id="cart"><i class="fa fa-shopping-cart " aria-hidden="true"></i></a>
            </div>
        </div>
    </nav>
</header>