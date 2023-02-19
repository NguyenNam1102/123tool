<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'DASHBROAD | '.$NNL->site('tenweb');
    require_once("../../public/ctv/Header.php");
    require_once("../../public/ctv/Sidebar.php");
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thống Kê</h1>
                </div>
                <div class="col-sm-6">
                   
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-check-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tổng Đơn cày thuê của bạn</span>
                        <span class="info-box-number">
                           <?=$NNL->num_rows("SELECT * FROM `orders_caythue` where `nguoinhan`='".$_SESSION['username']."' ");?>                          
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-money-check-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tổng Đơn cày thuê đang cày</span>
                        <span class="info-box-number">
                        <?=$NNL->num_rows("SELECT * FROM `orders_caythue` where `nguoinhan`='".$_SESSION['username']."' AND `status`='xuly' ");?>                            
                        </span>
                    </div>
                </div>
            </div>
           <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-check-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tổng Đơn cày thuê hoàn tất</span>
                        <span class="info-box-number">
                            <?=$NNL->num_rows("SELECT * FROM `orders_caythue` where `nguoinhan`='".$_SESSION['username']."' AND `status`='hoantat' ");?>                            
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-check-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tổng tiền Đơn cày thuê đã hoàn thành</span>
                        <span class="info-box-number">
                           <?=format_cash($NNL->get_row("SELECT SUM(`money`) FROM `orders_caythue` where `nguoinhan`='".$_SESSION['username']."' and `status`='hoantat'")['SUM(`money`)']);?>đ
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-check-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tổng tiền đã bán acc</span>
                        <span class="info-box-number">
                           <?=format_cash($NNL->get_row("SELECT SUM(`money`) FROM `accounts` where `userport`='".$_SESSION['username']."' and `username` IS NOT NULL")['SUM(`money`)']);?>đ
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DÒNG TIỀN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>USERNAME</th>
                                        <th>SỐ TIỀN TRƯỚC</th>
                                        <th>SỐ TIỀN THAY ĐỔI</th>
                                        <th>SỐ TIỀN HIỆN TẠI</th>
                                        <th>THỜI GIAN</th>
                                        <th>NỘI DUNG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($NNL->get_list(" SELECT * FROM `dongtien` ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><a href="<?=BASE_URL('Admin/User/Edit/'.$NNL->getUser($row['username'])['id']);?>"><?=$row['username'];?></a></td>
                                        <td><?=format_cash($row['sotientruoc']);?></td>
                                        <td><?=format_cash($row['sotienthaydoi']);?></td>
                                        <td><?=format_cash($row['sotiensau']);?></td>
                                        <td><span class="badge badge-dark"><?=$row['thoigian'];?></span></td>
                                        <td><?=$row['noidung'];?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>USERNAME</th>
                                        <th>SỐ TIỀN TRƯỚC</th>
                                        <th>SỐ TIỀN THAY ĐỔI</th>
                                        <th>SỐ TIỀN HIỆN TẠI</th>
                                        <th>THỜI GIAN</th>
                                        <th>NỘI DUNG</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>





<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>

<?php 
    require_once("../../public/ctv/Footer.php");
?>