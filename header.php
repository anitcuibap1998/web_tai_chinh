<header class="main-header clearfix" role="header">
    <div class="logo">
        <a href="index.php"><em>Vay Tiền</em> Nhanh</a>
    </div>
    <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
    <nav id="menu" class="main-nav" role="navigation">
        <ul class="main-menu">
            <li><a href="index.php">Trang Chủ</a></li>
            <li class="has-submenu"><p>Gửi Tiết Kiệm</p>
                <ul class="sub-menu">
                    <li><a href="gui_tiet_kiem_an_toan.php">An Toàn</a></li>
                    <li><a href="gui_tiet_kiem_trung_binh.php">Trung Bình</a></li>
                    <li><a href="gui_tiet_kiem_rui_ro.php">Rũi Ro</a></li>
                </ul>
            </li>
            <li><a href="vay_tien.php">Vay Tiền</a></li>
            <?php if(1==2){ ?>
            <li class="has-submenu"><p><i class="fas fa-user"></i>User</p>
                <ul class="sub-menu">
                    <li><a href="chi_tiet_user.php">Thông Tin User</a></a></li>
                    <li><a href="ql_vay_tien.php">Quản Lý Vay Tiền</a></li>
                    <li><a href="ql_gui_tiet_kiem.php">Quản Lý Gửi Tiết Kiệm</a></li>
                </ul>
            </li>
            <?php }?>
            <li><a href="lien_he.php">Liện Hệ</a></li>
            <li><a href="dangky.php" class="external">Đăng Ký</a></li>
            <li><a href="login.php" class="external">Đăng Nhập</a></li>
            <?php if(1==2){ ?>
                <li><a href="logout.php" class="external">Đăng Xuất</a></li>
            <?php }?>
        </ul>
    </nav>
</header>