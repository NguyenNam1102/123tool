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
                    <a href="https://www.facebook.com/nguyennhatloc" class="nav-link">Liên hệ</a>
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
                            alt="">
                    </div>
                    <div class="info">
                        <a href="<?=BASE_URL('Admin/Home');?>" class="d-block"><?=$getUser['username'];?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item has-treeview menu-open">
                            <a href="<?=BASE_URL('Admin/Home');?>" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Thông Tin
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">DANH MỤC TOOL</li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Tool');?>" class="nav-link">
                                <i class="nav-icon fas fa-cart-plus"></i>
                                <p>
                                    Thêm tool <span
                                        class="badge badge-info right"></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">QUẢN LÝ</li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Users');?>" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Thành viên
                                </p>
                            </a>
                        </li>
                       
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Key');?>" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Danh sách key
                                </p>
                            </a>
                        </li>
                        
                        
                        <li class="nav-header">KHYẾN MÃI</li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Gift');?>" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    MÃ GIẢM GIÁ
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">NẠP TIỀN</li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Cards');?>" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Nạp thẻ cào
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Bank');?>" class="nav-link">
                                <i class="nav-icon fas fa-university"></i>
                                <p>
                                    Ngân hàng
                                </p>
                            </a>
                        </li>
                       
                        <li class="nav-header">CÀI ĐẶT</li>
                        <li class="nav-item">
                            <a href="<?=BASE_URL('Admin/Setting');?>" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Cấu hình
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>