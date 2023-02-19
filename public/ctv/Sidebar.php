<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?=BASE_URL('');?>" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="https://www.cmsnt.co/" class="nav-link">Liên hệ</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?=BASE_URL('Admin/Home');?>" class="brand-link">
                <img src="<?=BASE_URL('template/');?>dist/img/AdminLTELogo.png" alt="<?=$NNL->site('tenweb');?>"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?=$NNL->site('tenweb');?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?=BASE_URL('template/');?>dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            alt="CMSNT">
                    </div>
                    <div class="info">
                        <a href="<?=BASE_URL('Ctv/Home');?>" class="d-block"><?=$getUser['username'];?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item has-treeview menu-open">
                            <a href="<?=BASE_URL('Ctv/Home');?>" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Thông Tin
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">ĐƠN HÀNG</li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Ctv/DonCayThue');?>" class="nav-link">
                                <i class="nav-icon fas fa-cart-plus"></i>
                                <p>
                                    Đơn hàng cày thuê <span
                                        class="badge badge-info right"><?=$NNL->num_rows("SELECT * FROM `orders_caythue` WHERE `status` = 'xuly' ");?></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">QUẢN LÝ</li>
                        
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Ctv/Accounts');?>" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Đăng bán tài khoản game
                                </p>
                            </a>
                        </li>
 
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Ctv/Account-Sold');?>" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Tài khoản đã bán
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?=BASE_URL('Ctv/Donhang');?>" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Đơn hàng của bạn
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">Solo liên quân</li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Ctv/Solo');?>" class="nav-link">
                                <i class="nav-icon fas fa-cart-plus"></i>
                                <p>
                                    Yêu cầu solo <span
                                        class="badge badge-info right"><?=$NNL->num_rows("SELECT * FROM `pk` WHERE `status` = '0' ");?></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Ctv/OrderSolo');?>" class="nav-link">
                                <i class="nav-icon fas fa-cart-plus"></i>
                                <p>
                                    Đơn hàng solo
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>