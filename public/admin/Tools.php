<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'QUẢN LÝ NHÓM | '.$NNL->site('tenweb');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_POST['ThemTool']) && $getUser['level'] == 'admin' )
{
    if($NNL->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $rand = random("QWERTYUIOPASDFGHJKLZXCVBNM0123456789", 6);
    if(check_img('img') == true)
    {
        $uploads_dir = '../../assets/storage/images';
        $tmp_name = $_FILES['img']['tmp_name'];
        $url_img = "/account_".$rand.".png";
        move_uploaded_file($tmp_name, $uploads_dir.$url_img);
    }
        $NNL->insert("tool", array(
        'bidanh'      =>check_string($_POST['bidanh']),
        'toolname'           => check_string($_POST['name']),
        'image'       => BASE_URL('assets/storage/images'.$url_img),
        'price'       => check_string($_POST['price']),
        'link'       => $_POST['link'],
        'version'       => check_string($_POST['version']),
        'chucnang'         => NULL
        ));
    admin_msg_success("Thêm Tool thành công", '', 500);
}
if(isset($_POST['delete']) && $getUser['level'] == 'admin' )
{
    if($NNL->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $NNL->query("DELETE from `tool` where `tool_id`='".check_string($_POST['id_tool'])."'");
    admin_msg_success("Xóa tool thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách Tool</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM TOOL NRO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên tool</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thumnail</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="form-control" id="exampleInputFile" name="img"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Bí danh</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="bidanh" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giá</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="price" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Link tải</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="link" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Phiên bản</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="version" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="ThemTool" class="btn btn-primary btn-block">
                                <span>THÊM NGAY</span></button>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH TOOL</h3>
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
                                        <th>IMAGE</th>
                                        <th>BÍ DANH</th>
                                        <th>PHIÊN BẢN</th>
                                        <th>GIÁ</th>
                                        <th>LINK</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach($NNL->get_list(" SELECT * FROM `tool` ORDER BY tool_id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td width="5%"><?=$i++;?></td>
                                        <td><?=$row['toolname'];?></td>
                                        <td width="8%"><img width="100%" src="<?=$row['image'];?>" /></td>
                                        <td><?=$row['bidanh'];?></td>
                                        <td><?=$row['version'];?></td>
                                        <td><?=$row['price'];?></td>
                                        <td><?=$row['link'];?></td>
                                        <td>
                                            <form action="#" method="post">
                                                <input type="hidden" name="id_tool" value="<?=$row['tool_id']?>">
                                                <a class="btn btn-primary"
                                                    href="<?=BASE_URL('Admin/Tool/Edit/'.$row['tool_id']);?>"><i
                                                        class="fas fa-edit"></i>
                                                    <span>EDIT</span></a>
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