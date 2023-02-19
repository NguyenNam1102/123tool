<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'CHỈNH SỬA TÀI KHOẢN | '.$NNL->site('tenweb');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
<?php
if(isset($_GET['id']) && $getUser['level'] == 'ctv')
{
    $row = $NNL->get_row(" SELECT * FROM `pk` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row)
    {
        admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 500);
    }
}
else
{
    admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
}
if($row['ketqua'] == '1' ||$row['ketqua'] == '2' )
{
        admin_msg_warning("Đã trả kèo, không thể điều chỉnh trạng thái khác",  BASE_URL('Ctv/OrderSolo'), 2000);
}
if(isset($_POST['LuuKQ']) && $getUser['level'] == 'ctv' )
{
    if($NNL->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $NNL->update("pk", array(
        'ketqua'       =>1
    ), " `id` = '".$row['id']."' ");
    admin_msg_success("Đã trả kèo thành công", BASE_URL('Ctv/OrderSolo'), 500);
}
if(isset($_POST['LuuKQ1']) && $getUser['level'] == 'ctv' )
{
    if($NNL->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $NNL->update("pk", array(
        'ketqua'       =>2
    ), " `id` = '".$row['id']."' ");
    admin_msg_success("Đã trả kèo thành công", BASE_URL('Ctv/OrderSolo'), 500);
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
           
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">TRẢ KẾT QUẢ TRẬN SOLO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">KHÁCH HÀNG</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" value="<?=$row['user'];?>" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TÊN NHÂN VẬT GAME</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="money" value="<?=$row['nv'];?>" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TIỀN CƯỢC</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="money" value="<?=$row['cuoc'];?>" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">LOẠI SOLO</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="money" value="<?=$row['type'];?>" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">TƯỚNG</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="money" value="<?=$row['tuong'];?>" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="LuuKQ" class="btn btn-success btn-block">
                                <span>KHÁCH THẮNG</span></button>
                            <button type="submit" name="LuuKQ1" class="btn btn-danger btn-block">
                                <span>KHÁCH THUA</span></button>
                            <a type="button" href="<?=BASE_URL('Ctv/OrderSolo');?>"
                                class="btn btn-primary btn-block waves-effect">
                                <span>TRỞ LẠI</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CHI TIẾT TÀI KHOẢN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <img width="100%" src="<?=$row['img'];?>" />
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    require_once(__DIR__."/Footer.php");
?>