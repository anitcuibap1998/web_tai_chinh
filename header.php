<header class="main-header clearfix" role="header">
    <div class="logo">
        <a href="index.php"><em>Vay Tiền</em> Nhanh</a>
    </div>
    <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
    <nav id="menu" class="main-nav" role="navigation">
        <ul class="main-menu">
            <li><a href="index.php">Trang Chủ</a></li>
            <li class="has-submenu"><p>Đầu Tư</p>
                <ul class="sub-menu">
                    <li><a href="dau_tu_gold.php">Đầu Tư GOLD</a></li>
                    <li><a href="dau_tu_diamond.php">Đầu Tư DIAMOND</a></li>
                </ul>
            </li>
            <li><a href="vay_tien.php">Vay Tiền</a></li>
            <?php if(isset($_SESSION['username'])){ ?>
            <li class="has-submenu"><p><i class="fas fa-user"></i> User</p>
                <ul class="sub-menu">
                    <li><a target="_blank" href="chi_tiet_user.php">Thông Tin User</a></a></li>
                    <li><a href="ql_vay_tien.php">Quản Lý Vay Tiền</a></li>
                    <li><a href="ql_gui_tiet_kiem.php">Quản Lý Đẩu Tư</a></li>
                </ul>
            </li>
            <?php }?>
            <?php if(!isset($_SESSION['username'])){ ?>
            <li><a href="dangky.php" class="external">Đăng Ký</a></li>
            <li><a href="login.php" class="external">Đăng Nhập</a></li>
            <?php }?>
            <?php if(isset($_SESSION['username'])){ ?>
                <li><a href="logout.php" class="external">Đăng Xuất</a></li>
            <?php }?>
        </ul>
    </nav>
</header>