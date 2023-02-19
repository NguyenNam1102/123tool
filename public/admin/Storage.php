<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if(isset($_POST['type']) && $getUser['level'] == 'admin')
    {
        if($_POST['type'] == 'Delete' && isset($_POST['path']))
        {
            $isDelete = unlink(check_string($_POST['path']));
            if($isDelete)
            {
                admin_msg_success("Xóa thành công", '', 500);
            }
            else
            {
                admin_msg_warning("Xóa thất bại", "", 2000);
            }
        }
    }
    
    $title = 'LƯU TRỮ | '.$NNL->site('tenweb');
    require_once(__DIR__."/Header.php");
    require_once(__DIR__."/Sidebar.php");
?>

<?php
if(isset($_POST['UploadIMG']) && $getUser['level'] == 'admin')
{
    if($_FILES['listimg']['name'])
    {
        foreach($_FILES['listimg']['name'] as $name => $value)
        {
            $rand = random("QWERTYUIOPASDFGHJKLZXCVBNM0123456789", 12);
            $uploads_dir = '../../assets/storage/images';
            $tmp_name = $_FILES['listimg']['tmp_name'][$name];
            $url_img = "/upload_".$rand.".png";
            move_uploaded_file($tmp_name, $uploads_dir.$url_img);
        }
    }
    admin_msg_success("Tải lên thành công !", '', 500);
}
?>
<div class="content-wrapper">
    <div id="thongbao"></div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lưu trữ</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH FILE ẢNH</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                                data-target="#modal-default">
                                Tải ảnh lên
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>FILE</th>
                                        <th>FILE NAME</th>
                                        <th>URL</th>
                                        <th>SIZE</th>
                                        <th>CREATEDATE</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = COUNT(dirToArray('../../assets/storage/images/')); foreach(dirToArray('../../assets/storage/images/') as $row){ ?>
                                    <tr>
                                        <td width="5%"><?=$i--;?></td>
                                        <td width="10%"><img width="100%"
                                                src="<?=BASE_URL('assets/storage/images/'.$row);?>" /></td>
                                        <td width="10%"><input type="text" value="<?=$row;?>" class="form-control"
                                                readonly></td>
                                        <td width="30%"><input type="text"
                                                value="<?=BASE_URL('assets/storage/images/'.$row);?>"
                                                class="form-control" readonly></td>
                                        <td width="5%">
                                            <b><?=FileSizeConvert(realFileSize('../../assets/storage/images/'.$row));?></b>
                                        </td>
                                        <td width="5%">
                                            <i><?=timeAgo(GetCorrectMTime('../../assets/storage/images/'.$row));?></i>
                                        </td>
                                        <td><button class="btn btn-danger Delete" data-path="../../assets/storage/images/<?=$row;?>">DELETE</button></td>
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


<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload ảnh</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Chọn list ảnh</label>
                        <div class="col-sm-9">
                            <div class="form-line">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="form-control" id="exampleInputFile" name="listimg[]"
                                            multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ĐÓNG</button>
                    <button type="submit" name="UploadIMG" class="btn btn-primary">TẢI LÊN</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<script type="text/javascript">
$(".Delete").on("click", function() {
    Swal.fire({
        title: 'Xóa tệp',
        text: "Bạn có đồng ý xóa tệp này không?",
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
                url: "<?=BASE_URL("public/admin/Storage.php");?>",
                method: "POST",
                data: {
                    type: 'Delete',
                    path: $(this).attr("data-path")
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
});
</script>



<?php 
    require_once(__DIR__."/Footer.php");
?>