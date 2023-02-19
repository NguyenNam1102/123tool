<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'Key';
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
<?php
if(isset($_POST['delete']) && $getUser['level'] == 'admin' )
{
    if($NNL->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $NNL->query("DELETE from `license` where `id`='".check_string($_POST['id'])."'");
    admin_msg_success("Xóa key thành công", '', 500);
}

?>

<?php

if(isset($_POST['deletekeyhethan']) && $getUser['level'] == 'admin' )
{
    $sk = 0;
                                    foreach($NNL->get_list(" SELECT * FROM `license` ORDER BY id DESC ") as $row2){
                                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                                        $exptool2;
                                        $now2 = time();
                                        if ($row2['time'] != "") {
                                            $time2 = $row2['time'];//lấy thời gian của csdl ra
                                        
                                            $time2 = date_parse_from_format('Y-m-d H:i:s', $time2);
                                            $time_stamp2 = mktime($time2['hour'], $time2['minute'], $time2['second'], $time2['month'], $time2['day'], $time2['year']);
                                            $exptool2=($now2 - $time_stamp2) / 86400;
                                            $hsd2 =(int)$row2['day'] - (int)$exptool2;
                                            if($hsd2 > 0)
                                            {
                                            }
                                            else
                                            {   
                                                $NNL->query("DELETE from `license` where `id`='".$row2['id']."'");
                                                $sk++;
                                            }
                                        }
                                    }
    admin_msg_success("Đã xóa ".$sk." key hết hạn", '', 500);
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách key</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH KEY CỦA KHÁCH</h3>
                        
                                          
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                             <form action="#" method="post">
                          <button type="submit" name="deletekeyhethan"
                                                    onclick="return confirm('Có muốn xóa không?')" name="deletekeyhethan"
                                                    class="btn btn-danger">
                                                    <span>DELETE KEY HẾT HẠN</span></button>
                      </form>
                                                  
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                         <th>ID</th>
                                        <th>TÀI KHOẢN</th>
                                        <th>TYPE</th>
                                        <th>GIÁ</th>
                                        <th>KEY</th>
                                        <th>DAY</th>
                                        <th>HSD</th>
                                        <th>THỜI GIAN MUA</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($NNL->get_list(" SELECT * FROM `license` ORDER BY id DESC ") as $row){
                                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                                        $exptool;
                                        $now = time();
                                        $status = "";
                                        $h = "";
                                        if ($row['time'] != "") {
                                            $time = $row['time'];//lấy thời gian của csdl ra
                                        
                                            $time = date_parse_from_format('Y-m-d H:i:s', $time);
                                            $time_stamp = mktime($time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year']);
                                            $exptool=($now - $time_stamp) / 86400;
                                            $hsd =(int)$row['day'] - (int)$exptool;
                                            if($hsd > 0)
                                            {
                                                $status = "Còn ".$hsd." ngày";
                                                
                                            }
                                            else
                                            {
                                                $status = "Hết Hạn";                     
                                            }
                                        }
                                   ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                         <td><?=$row['id'];?></td>
                                        <td><?=$row['user'];?></td>
                                        <td><?=$row['nameTool'];?></td>
                                        <td><?=format_cash($row['price']);?>đ</td>
                                        <td><?=$row['keytool'];?></td>
                                        <td class="text-center"><?php echo $row['day'];?></td>
                                        <td class="text-center">
                                            <?php 
                                                if($status=="Hết Hạn")
                                                {
                                            ?>
                                            <p style="color:red;font-weight:bold"><?php echo $status;?></p>
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                            <p style="color:green;font-weight:bold"><?php echo $status;?></p>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $row['time'];?></td>
                                        <td>  
                                        <form action="#" method="post">
                                                <input type="hidden" name="id" value="<?=$row['id']?>">
                                            <a type="button" class="btn btn-default"
                                                href="<?=BASE_URL('Admin/Editday/')?><?=$row["id"];?>" class="btn btn-info"><i
                                                    class="fas fa-edit"></i> Edit</a>
                                          <button type="submit" name="delete"
                                                    onclick="return confirm('Có muốn xóa không?')" name="delete"
                                                    class="btn btn-danger">
                                                    <span>DELETE</span></button>
                                                     </form>
                                        </td>
                                          
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>



<!-- Modal -->
<div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">EDIT NHÓM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tên nhóm</label>
                        <div class="col-sm-8">
                            <div class="form-line">
                                <input type="hidden" name="id" id="id" class="form-control" required>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Hiển thị</label>
                        <div class="col-sm-8">
                            <select class="form-control show-tick" id="display" name="display" required>
                                <option value="SHOW">SHOW</option>
                                <option value="HIDE">HIDE</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="LuuChuyenMuc" class="btn btn-danger">Lưu ngay</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->

<script type="text/javascript">
$('.btnEdit').on('click', function(e) {
    var btn = $(this);
    $("#title").val(btn.attr("data-title"));
    $("#display").val(btn.attr("data-display"));
    $("#id").val(btn.attr("data-id"));
    $("#staticBackdrop").modal();
    return false;
});
</script>
<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $("#datatable1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $("#datatable2").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>



<?php 
    require_once(__DIR__."/Footer.php");
?>