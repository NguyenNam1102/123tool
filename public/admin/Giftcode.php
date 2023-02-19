<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'QUẢN LÝ NHÓM | '.$NNL->site('tenweb');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_POST['delete']) && isset($_POST['code']))
        {
            $NNL->query("DELETE from `giftcode` where `code`='".$_POST['code']."'");;
            admin_msg_success("Xóa code thành công", '', 500);
        }

if(isset($_POST['ThemGift']) && $getUser['level'] == 'admin' )
{
    if($NNL->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
       $gia=$_POST['phantram'];
        $NNL->insert("giftcode", array(
        'code'      =>check_string($_POST['codegift']),
        'phantram'           =>$gia,
        'soluong'       => check_string($_POST['soluong'])
        ));
    admin_msg_success("Thêm mã giảm thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách mã giảm giá</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM MÃ MỚI</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mã code</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="codegift" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Phầm trăm giảm</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="phamtram" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số lượt dùng</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="soluong" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="ThemGift" class="btn btn-primary btn-block">
                                <span>THÊM NGAY</span></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH MÃ CODE</h3>
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
                                        <th>MÃ CODE</th>
                                        <th>PHẦM TRĂM GIẢM</th>
                                        <th>SỐ LƯỢT DÙNG</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($NNL->get_list(" SELECT * FROM `giftcode` ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td width="5%"><?=$i++;?></td>
                                        <td width="8%"><?=$row['code'];?></td>
                                        <td><?=$row['phantram'];?></td>
                                        <td><?=$row['soluong'];?></td>
                                        <td><?php if($row['status'] == 0) { echo '<span class="badge badge-success">Hoạt động</span>';} else { echo '<span class="badge badge-danger">Hết lượt</span>';};?>
                                        </td>
                                        <td>
                                              <form action="#" method="post">
                                                <input type="hidden" name="code" value="<?=$row['code']?>">
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



<script type="text/javascript">
$(".Delete").on("click", function() {
    Swal.fire({
        title: 'Xóa Giftcode',
        text: "Bạn có đồng ý xóa mã này không?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa ngay',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            $('.Delete').html('ĐANG XỬ LÝ').prop('disabled',
                true);
            $.ajax({
                url: "<?=BASE_URL("public/admin/Giftcode.php");?>",
                method: "POST",
                data: {
                    type: 'Delete',
                    path: $(this).attr("code")
                },
                success: function(response) {
                    $("#thongbao").html(response);
                    $('.Delete').html('DELETE').prop('disabled', false);
                }
            });
        }
    })
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