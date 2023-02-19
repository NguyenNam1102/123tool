<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'DASHBROAD | '.$NNL->site('tenweb');
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Tổng thành viên</span>
                        <span class="info-box-number"><?=$NNL->num_rows("SELECT * FROM `users` ");?></span>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-12">

                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-money-bill-alt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Tổng số dư thành viên</span>
                        <span
                            class="info-box-number"><?=format_cash($NNL->get_row("SELECT SUM(`money`) FROM `users` WHERE `level`IS NULL OR `level`!='admin'")['SUM(`money`)']);?>đ</span>
                    </div>

                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Thẻ sai</span>
                        <span
                            class="info-box-number"><?=$NNL->num_rows("SELECT * FROM `cards` where `status`='thatbai'");?></span>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Thẻ đang xử lý</span>
                        <span
                            class="info-box-number"><?=$NNL->num_rows("SELECT * FROM `cards` where `status`='xuly'");?></span>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-store"></i></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Thẻ đúng</span>
                        <span
                            class="info-box-number"><?=$NNL->num_rows("SELECT * FROM `cards` where `status`='thanhcong'");?></span>
                    </div>

                </div>

            </div>
            <div class="col-lg-4 col-12">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-money-bill-alt"></i></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Tổng bill nạp momo</span>
                        <span
                            class="info-box-number"><?=$NNL->num_rows("SELECT * FROM `momo` ");?></span>
                    </div>

                </div>

            </div>
            <div class="col-lg-3 col-6">
            <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?=format_cash($NNL->get_row("SELECT SUM(`price`) FROM `license` Where Date(time) = CURDATE() AND `user`!='tranvlnh' AND `user`!='namnguyen1911'")['SUM(`price`)']);?>đ<sup style="font-size: 20px"></sup></h3>
    
                    <p>Doanh Thu Hôm Nay</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer">Xem Thêm <i class="fas fa-arrow-circle-right"></i></a>
                </div>
          </div>
           <div class="col-lg-3 col-6">
            <!-- small box -->
                <div class="small-box bg-warning ">
                  <div class="inner">
                    <h3><?=format_cash($NNL->get_row("SELECT SUM(`price`) FROM `license` Where MONTH(time) = MONTH(CURDATE()) AND YEAR(time) = YEAR(CURDATE()) AND `user`!='tranvlnh' AND `user`!='namnguyen1911'")['SUM(`price`)']);?>đ<sup style="font-size: 20px"></sup></h3>
    
                    <p>Doanh Thu Tháng Này</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer">Xem Thêm <i class="fas fa-arrow-circle-right"></i></a>
                </div>
          </div>
           <div class="col-lg-3 col-6">
            <!-- small box -->
                <div class="small-box bg-warning ">
                  <div class="inner">
                    <h3><?=format_cash($NNL->get_row("SELECT SUM(`price`) FROM `license` Where MONTH(time) = MONTH(CURDATE()) - 1 AND YEAR(time) = YEAR(CURDATE()) AND `user`!='tranvlnh' AND `user`!='namnguyen1911'")['SUM(`price`)']);?>đ<sup style="font-size: 20px"></sup></h3>
    
                    <p>Doanh Thu Tháng Trước</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer">Xem Thêm <i class="fas fa-arrow-circle-right"></i></a>
                </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?=$NNL->num_rows("Select * From `license` Where Date(time) = CURDATE()");?></h3>

                <p>Số Tool Đã Bán Hôm Nay</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">Xem Thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- <div class="col-lg-3 col-6">
            <!-- small box -->
            <!-- <div class="small-box bg-info">
            <!--   <div class="inner">
            <!--     <h3><?=$NNL->num_rows("Select * From `momo` Where Date(time) = CURDATE()");?></h3>

                <p>Nạp Momo Hôm Nay</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">Xem Thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <div class="col-lg-3 col-6">
            <!-- small box -->
          <!--   <div class="small-box bg-danger">
              <div class="inner">
                <h3><?=$NNL->num_rows("Select * From `cards` Where Date(createdate) = CURDATE()");?></h3>

                <p>Thẻ Nạp Hôm Nay</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">Xem Thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>-->
           <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THỐNG KÊ NẠP MOMO TỪNG THÁNG, NĂM</h3>
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
                                        <th>THÁNG</th>
                                        <th>NĂM</th>
                                        <th>TỔNG TIỀN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($NNL->get_list("Select Month(time), sum(price),year(time) From momo Where date(curdate()) = Date(time) OR Date(Curdate()) - interval 1 month Group by month(time)") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        
                                        <td><?=$row['Month(time)'];?></td>
                                        <td><?=$row['year(time)'];?></td>
                                        <td><?=format_cash($row['sum(price)']);?>đ</td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                         <th>STT</th>
                                        <th>THÁNG</th>
                                        <th>NĂM</th>
                                        <th>TỔNG TIỀN</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THỐNG KÊ NẠP THẺ CÀO TỪNG THÁNG, NĂM</h3>
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
                                        <th>THÁNG</th>
                                        <th>NĂM</th>
                                        <th>TỔNG TIỀN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($NNL->get_list("Select Month(createdate), sum(thucnhan),year(createdate) From cards Where status='thanhcong' and date(curdate()) = Date(createdate) OR Date(Curdate()) - interval 1 month Group by month(createdate)") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        
                                        <td><?=$row['Month(createdate)'];?></td>
                                        <td><?=$row['year(createdate)'];?></td>
                                        <td><?=format_cash($row['sum(thucnhan)']);?>đ</td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                         <th>STT</th>
                                        <th>THÁNG</th>
                                        <th>NĂM</th>
                                        <th>TỔNG TIỀN</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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
                                        <td><a
                                                href="<?=BASE_URL('Admin/User/Edit/'.$NNL->getUser($row['username'])['id']);?>"><?=$row['username'];?></a>
                                        </td>
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



<script type="text/javascript">
$("#balance").on("click", function() {

    $('#balance').html('Đang xử lý...').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/API.php");?>",
        method: "POST",
        data: {
            type: 'LSGD',
        },
        success: function(response) {
            $('#balance').html(
                    'Reset')
                .prop('disabled', false);
        }
    });
});
</script>

<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>

<?php 
    require_once("../../public/admin/Footer.php");
?>