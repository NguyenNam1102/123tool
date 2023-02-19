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
   
        $NNL->insert("captcha", array(
        'keycaptcha'      =>$_POST['key'],
        ));
    admin_msg_success("Thêm Key thành công", '', 500);
}
if(isset($_POST['delete']) && $getUser['level'] == 'admin' )
{
    if($NNL->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }
    $NNL->query("DELETE from `captcha` where `id`='".check_string($_POST['id_tool'])."'");
    admin_msg_success("Xóa key thành công", '', 500);
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách key captcha</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THÊM KEY CAPTCHA</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">KEY</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="key" class="form-control" required>
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
                        <h3 class="card-title">DANH SÁCH KEY CAPTCHA</h3>
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
                                        <th>KEY</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach($NNL->get_list(" SELECT * FROM `captcha` ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td width="5%"><?=$i++;?></td>
                                        <td><?=$row['keycaptcha'];?></td>
                                        <td>
                                            <form action="#" method="post">
                                                <input type="hidden" name="id_tool" value="<?=$row['id']?>">
                                                <!--<a class="btn btn-primary"-->
                                                <!--    href="<?=BASE_URL('Admin/Tool/Edit/'.$row['tool_id']);?>"><i-->
                                                <!--        class="fas fa-edit"></i>-->
                                                <!--    <span>EDIT</span></a>-->
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