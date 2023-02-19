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
    $row = $NNL->get_row(" SELECT * FROM `tool` WHERE `tool_id` = '".check_string($_GET['id'])."'  ");
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
    if(check_img('img') == true)
    {
        $rand = random("QWERTYUIOPASDFGHJKLZXCVBNM0123456789", 12);
        $uploads_dir = '../../assets/storage/images';
        $tmp_name = $_FILES['img']['tmp_name'];
        $url_img = "/account_".$rand.".png";
        $create = move_uploaded_file($tmp_name, $uploads_dir.$url_img);
        $NNL->update("tool", array(
            'image'       => BASE_URL('assets/storage/images'.$url_img)
        ), " `tool_id` = '".$row['tool_id']."' ");
    }
    $NNL->update("tool", array(
        'bidanh'       => check_string($_POST['bidanh']),
        'toolname'       => check_string($_POST['name']),
        'price'         => check_string($_POST['money']),
        'link'         => $_POST['link'],
        'version'         => check_string($_POST['version']),
        'chucnang'         => $_POST['chucnang']
    ), " `tool_id` = '".$row['tool_id']."' ");
    admin_msg_success("Lưu tool thành công", BASE_URL('Admin/Tool'), 500);
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa tool</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CHỈNH SỬA TOOL</h3>
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
                                        <input type="text" name="name" value="<?=$row['toolname'];?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Thumnail</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="form-control" id="exampleInputFile"
                                                    name="img">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Bí danh</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="bidanh" value="<?=$row['bidanh'];?>" class="form-control"
                                            >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giá</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="number" name="money" value="<?=$row['price'];?>" class="form-control"
                                            >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Link</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="link" value="<?=$row['link'];?>" class="form-control"
                                            >
                                    </div>
                                </div>
                            </div>
                           <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Phiên bản</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="version" value="<?=$row['version'];?>" class="form-control"
                                            >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Chức năng</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <textarea class="textarea" name="chucnang"
                                            rows="6"><?=$row['chucnang']?></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="LuuTool" class="btn btn-primary btn-block">
                                <span>LƯU NGAY</span></button>
                           
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