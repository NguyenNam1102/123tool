<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'DANH SÁCH ĐƠN HÀNG | '.$NNL->site('tenweb');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
 if(isset($_POST['type']) && $getUser['level'] == 'ctv')
 {
     if($_POST['type'] == 'xacnhan' && isset($_POST['id']))
     {
         $is = $_POST['id'];
         $isNhan=$NNL->update("orders_caythue", [
            'status'      =>'hoantat'
        ], " `id` = '".$is."' ");
         if($isNhan)
         {
             admin_msg_success("Đã nhận đơn hàng thành công", '', 500);
         }
         else
         {
             admin_msg_warning("Nhận thất bại", "", 2000);
         }
     }
 }
if(isset($_POST['Save']) && $getUser['level'] == 'ctv' )
{
    if($NNL->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $status = check_string($_POST['status']);
    $id = check_string($_POST['id']);
    $row = $NNL->get_row("SELECT * FROM `orders_caythue` WHERE `id` = '$id' ");
    if(!$row)
    {
        admin_msg_warning("Đơn hàng không hợp lệ", "", 2000);
    }
    if(empty($status))
    {
        admin_msg_warning("Vui lòng chọn trạng thái", "", 2000);
    }
    if($row['status'] == 'huy')
    {
        admin_msg_warning("Đơn hàng nãy đã hoàn tiền, không thể điều chỉnh trạng thái khác", "", 2000);
    }
    if($status == 'huy')
    {
        // refund
        $isMoney = $NNL->cong("users", "money", $row['money'], " `username` = '".$row['username']."' ");
        if($isMoney)
        {
            $getUser = $NNL->get_row("SELECT * FROM `users` WHERE `username` = '".$row['username']."' ");
            /* GHI LOG DÒNG TIỀN */
            $NNL->insert("dongtien", array(
                'sotientruoc'   => $getUser['money'] + $row['money'],
                'sotienthaydoi' => $row['money'],
                'sotiensau'     => $getUser['money'],
                'thoigian'      => gettime(),
                'noidung'       => 'Hoàn tiền gói ('.$row['dichvu'].')',
                'username'      => $row['username']
            ));
        }
        else
        {
            admin_msg_warning("Không thể xử lý giao dịch vui lòng thử lại", "", 2000);
        }
    }
    $NNL->update("orders_caythue", array(
        'status' => $status
    ), " `id` = '".check_string($_POST['id'])."' ");

    admin_msg_success("Lưu thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách đơn hàng cày thuê</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH ĐƠN HÀNG CÀY THUÊ</h3>
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
                                        <th>DỊCH VỤ</th>
                                        <th>TK|MK</th>
                                        <th>GHI CHÚ</th>
                                        <th>THANH TOÁN</th>
                                        <th>CREATEDATE</th>
                                        <th>UPDATEDATE</th>
                                        <th>STATUS</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($NNL->get_list(" SELECT * FROM `orders_caythue` where `nguoinhan`='".$_SESSION['username']."' ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$row['dichvu'];?></td>
                                        <td><?=$row['tk'];?>|<?=$row['mk'];?></td>
                                        <td><textarea class="form-control"readonly><?=$row['ghichu'];?></textarea></td>
                                        <td><?=format_cash($row['money']);?></td>
                                        <td><?=$row['createdate'];?></td>
                                        <td><?=$row['updatedate'];?></td>
                                        <td><?=status($row['status']);?></td>
                                        <td>
                                            <button class="btn btn-success NhanHang"
                                            onclick="nhan(<?php echo $row['id'];?>)">
                                                <span>Hoàn Thành Đơn Hàng</span></button>
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

<script type="text/javascript">
        const nhan = (type) => {
            Swal.fire({
        title: 'Xóa nhận',
        text: "Bạn đã hoàn thành đơn hàng này chưa?",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xong rồi',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            $('.NhanHang').html('ĐANG XỬ LÝ').prop('disabled',
                true);
            $.ajax({
                url: "<?=BASE_URL("public/ctv/Caythue.php");?>",
                method: "POST",
                data: {
                    type: 'xacnhan',
                    id: type
                },
                success: function(response) {
                    $("#thongbao").html(response);
                    $('.NhanHang').html('Nhận Đơn').prop('disabled', false);
                }
            });
        }
    })
                 
            }
</script>
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