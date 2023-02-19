<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'DANH SÁCH MUA VPS';
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_POST['SaveVps']) && $getUser['level'] == 'admin' )
{
    if($NNL->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $NNL->update("historyvps", array(
        'ip'       => check_string($_POST['ip']),
        'taikhoan'       => check_string($_POST['tk']),
        'matkhau'         => check_string($_POST['mk']),
        'status'=>1
    ), " `id` = '".$_POST['id_update']."' ");
    admin_msg_success("Lưu vps thành công", '', 500);
}
if(isset($_POST['Over']) && $getUser['level'] == 'admin' )
{
    if($NNL->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
     $id = check_string($_POST['id_update']);
    $row = $NNL->get_row("SELECT * FROM `historyvps` WHERE `id` = '$id' ");
    if(!$row)
    {
        admin_msg_warning("Đơn hàng không hợp lệ", "", 2000);
    }
    if($row['status'] == '2' )
    {
            admin_msg_warning("Đã hủy, không thể điều chỉnh trạng thái khác",  BASE_URL('Admin/HistoryVps'), 2000);
    }
    $NNL->update("historyvps", array(
        'status'=>2
    ), " `id` = '".$_POST['id_update']."' ");
     $get = $NNL->get_row("SELECT * FROM `users` WHERE `username` = '".$row['username']."' ");
            $m=$get['money'];
    $isMoney = $NNL->cong("users", "money", $row['price'], " `username` = '".$row['username']."' ");
        if($isMoney)
        {
        
            /* GHI LOG DÒNG TIỀN */
            $NNL->insert("dongtien", array(
                'sotientruoc'   => $m,
                'sotienthaydoi' => $row['price'],
                'sotiensau'     =>  $get['money']+$row['price'],
                'thoigian'      => gettime(),
                'noidung'       => 'Hoàn tiền vì hết hàng vps ('.$row['name'].')',
                'username'      => $row['username']
            ));
        }
        else
        {
            admin_msg_warning("Không thể xử lý giao dịch vui lòng thử lại", "", 2000);
        }
    admin_msg_success("Đã xử lý", '', 500);
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách đang yêu cầu mua vps</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <?php if(isset($_POST['edit']) && $getUser['level'] == 'admin' )
            {
                $value=$NNL->get_row(" SELECT * FROM `historyvps` WHERE `id` = '".check_string($_POST['id_vps'])."'");
            ?>
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">EDIT VPS</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_update" value="<?=$value['id']?>" class="form-control" required>
                           <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Người mua</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="user" value="<?=$value['username']?>" readonly class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên vps</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="name" value="<?=$value['name']?>" readonly class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CPU</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="cpu" value="<?=$value['cpu']?>" readonly class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">RAM</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="ram" value="<?=$value['ram']?>" readonly class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">IP</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="ip" value="<?=$value['ip']?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TÀI KHOẢN</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="tk"
                                            class="form-control" value="<?=$value['taikhoan']?>">
                                    </div>
                                </div>
                            </div>
                           <div class="form-group row">
                                <label class="col-sm-3 col-form-label">MẬT KHẨU</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="mk"
                                            class="form-control" value="<?=$value['matkhau']?>">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="SaveVps" class="btn btn-primary btn-block">
                                <span>UPDATE NGAY</span></button>
                            <button type="submit" name="Over" class="btn btn-danger btn-block">
                                <span>HẾT HÀNG RỒI</span></button>

                        </form>
                    </div>
                </div>
            </div>
            <?php }?>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH ĐANG YÊU CẦU MUA VPS</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>TÀI KHOẢN</th>
                                        <th>LOẠI VPS</th>
                                        <th>CPU</th>
                                        <th>RAM</th>
                                        <th>SỐ TIỀN</th>
                                        <th>IP</th>
                                        <th>USERNAME</th>
                                        <th>PASSWORD</th>
                                         <th>STATUS</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($NNL->get_list(" SELECT * FROM `historyvps` ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$row['username'];?></td>
                                        <td><?=$row['name'];?></td>
                                        <td><?=$row['cpu'];?></td>
                                        <td><?=$row['ram'];?></td>
                                        <td><?=format_cash($row['price']);?>đ</td>
                                        <td><?=$row['ip'];?></td>
                                        <td><?=$row['taikhoan'];?></td>
                                        <td><?=$row['matkhau'];?></td>
                                        <td><?php if($row['status'] == 0) { echo 'Đang xử lý';} else if($row['status'] == 2) { echo 'Hết hàng';}else { echo 'Hoạt động';};?>
                                        </td>
                                        <td>
                                            <form action="#" method="post">
                                                <input type="hidden" name="id_vps" value="<?=$row['id']?>">
                                                <button type="submit" name="edit" class="btn btn-primary"><i
                                                        class="fas fa-edit"></i>
                                                    <span>EDIT</span></button>
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