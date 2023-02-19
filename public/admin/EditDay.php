<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'CHỈNH SỬA TÀI KHOẢN | '.$NNL->site('tenweb');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>
<?php
if(isset($_GET['id']) && $getUser['level'] == 'admin')
{
    $row = $NNL->get_row(" SELECT * FROM `license` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row)
    {
        admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 500);
    }
}
else
{
    admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
}
if(isset($_POST['LuuTool']) && $getUser['level'] == 'admin' )
{
    if($NNL->site('status_demo') == 'ON')
    {
        admin_msg_warning("Chức năng này không khả dụng trên trang web DEMO!", "", 2000);
    }

    $NNL->update("license", array(
        'day'       => check_string($_POST['day'])
    ), " `id` = '".$row['id']."' ");
    admin_msg_success("Update ngày thành công", BASE_URL('Admin/Key'), 500);
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cập nhập ngày cho key</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">UPDATE DAY</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số ngày</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="day" value="<?=$row['day'];?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" name="LuuTool" class="btn btn-primary btn-block">
                                <span>UPDATE</span></button>
                           
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</div>
<script>
$(function() {
    $('.textarea').summernote()
     //Colorpicker
     $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>






<?php 
    require_once(__DIR__."/Footer.php");
?>