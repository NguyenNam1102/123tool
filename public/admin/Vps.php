<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'QUẢN LÝ NHÓM | '.$NNL->site('tenweb');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_POST['ThemTaiKhoan']) && $getUser['level'] == 'admin' )
{
    if($NNL->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
        $NNL->insert("vps", array(
        'name'      =>check_string($_POST['name']),
        'cpu'           => check_string($_POST['cpu']),
        'ram'       => check_string($_POST['ram']),
        'address'       => check_string($_POST['address']),
        'price'       => check_string($_POST['money']),
        'mota'         => check_string($_POST['mota']),
        ));
    admin_msg_success("Thêm vps thành công", '', 500);
}
if(isset($_POST['SaveVps']) && $getUser['level'] == 'admin' )
{
    if($NNL->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $NNL->update("vps", array(
        'name'       => check_string($_POST['name']),
        'cpu'       => check_string($_POST['cpu']),
        'ram'         => check_string($_POST['ram']),
        'address'         => check_string($_POST['address']),
        'price'         => check_string($_POST['money']),
        'mota'         => check_string($_POST['mota'])
    ), " `id` = '".$_POST['id_update']."' ");
    admin_msg_success("Lưu vps thành công", '', 500);
}
if(isset($_POST['end']) && $getUser['level'] == 'admin' )
{
    if($NNL->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $NNL->update("vps", array(
        'status'         => 1
    ), " `id` = '".$_POST['id_update']."' ");
    admin_msg_success("Đã thao tác", '', 500);
}
if(isset($_POST['on']) && $getUser['level'] == 'admin' )
{
    if($NNL->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $NNL->update("vps", array(
        'status'         => 0
    ), " `id` = '".$_POST['id_update']."' ");
    admin_msg_success("Đã thao tác", '', 500);
}
if(isset($_POST['delete']) && $getUser['level'] == 'admin' )
{
    if($NNL->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $NNL->query("DELETE from `vps` where `id`='".check_string($_POST['id_vps'])."'");
    admin_msg_success("Xóa vps thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách Vps</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM VPS</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên vps</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CPU</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="cpu" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">RAM</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="ram" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">VỊ TRÍ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="address" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giá bán</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="money" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mô tả</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="mota" rows="6"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="ThemTaiKhoan" class="btn btn-primary btn-block">
                                <span>THÊM NGAY</span></button>

                        </form>
                    </div>
                </div>
            </div>
            <?php if(isset($_POST['edit']) && $getUser['level'] == 'admin' )
            {
                $value=$NNL->get_row(" SELECT * FROM `vps` WHERE `id` = '".check_string($_POST['id_vps'])."'");
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
                                <label class="col-sm-3 col-form-label">Tên vps</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="name" value="<?=$value['name']?>" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">CPU</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="cpu" value="<?=$value['cpu']?>" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">RAM</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="ram" value="<?=$value['ram']?>" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">VỊ TRÍ</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="address" value="<?=$value['address']?>"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giá bán</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="money" value="<?=$value['price']?>"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mô tả</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="mota" rows="6"><?=$value['mota']?></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="SaveVps" class="btn btn-primary btn-block">
                                <span>UPDATE NGAY</span></button>
                                <button type="submit" name="on" class="btn btn-success btn-block">
                                <span>CÒN HÀNG</span></button>
                             <button type="submit" name="end" class="btn btn-danger btn-block">
                                <span>HẾT HÀNG</span></button>

                        </form>
                    </div>
                </div>
            </div>
            <?php }?>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH VPS</h3>
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
                                        <th>LOẠI</th>
                                        <th>CPU</th>
                                        <th>RAM</th>
                                        <th>VỊ TRÍ</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach($NNL->get_list(" SELECT * FROM `vps` ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td width="5%"><?=$i++;?></td>

                                        <td><?=$row['name'];?></td>
                                        <td><?=$row['cpu'];?></td>
                                        <td><?=$row['ram'];?></td>
                                        <td><?=$row['address'];?></td>
                                        <td><?php if($row['status'] == 0) { echo 'Còn Hàng';} else if($row['status'] == 1) { echo 'Hết hàng';};?>
                                        </td>
                                        <td>
                                            <form action="#" method="post">
                                                <input type="hidden" name="id_vps" value="<?=$row['id']?>">
                                                <button type="submit" name="edit" class="btn btn-primary"><i
                                                        class="fas fa-edit"></i>
                                                    <span>EDIT</span></button>
                                                <button type="submit" name="delete" onclick="return confirm('Có muốn xóa không?')" name="delete" class="btn btn-danger">
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

<script>
$(function() {
    $('.textarea').summernote()
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