<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'THÔNG TIN | '.$NNL->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
    CheckLogin();
?>

<div class="lq-content uk-position-relative" style="margin-top: 20px !important;">
    <div class="uk-container" id="category">
        <div class="lq-catalog-txt uk-flex uk-flex-middle uk-flex-column uk-flex-center uk-text-center uk-text-uppercase uk-height-medium uk-background-norepeat uk-background-center-center"
            data-src="<?=BASE_URL('template/envilthemes');?>/imgs/bg3.png" uk-img=""
            style="background-image: url(&quot;<?=BASE_URL('template/envilthemes');?>/imgs/bg3.png&quot;);">
            <span>NẠP TIỀN</span>
            <div>NẠP QUA THẺ CÀO</div>
        </div>
        <?php if($NNL->site('luuy_naptien') != NULL) { ?>
        <div class="alert alert-info">
            <?=$NNL->site('luuy_naptien');?>
        </div>
        <?php }?>
        <div class="lq-block1 uk-padding-large uk-height-viewport uk-background-norepeat"
            style="background-size: 100%; background-image: url(&quot;<?=BASE_URL('template/envilthemes');?>/imgs/bg2.png&quot;);"
            data-src="<?=BASE_URL('template/envilthemes');?>/imgs/bg2.png" uk-img="">
            <div>
                <div id="thongbao"></div>
                <form class="uk-form-horizontal uk-margin-large setting_form">
                    <div class="uk-margin">
                        <label class="uk-form-label uk-text-bold uk-text-warning uk-text-uppercase " for="card_code">Mã
                            thẻ</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" id="pin" type="text" placeholder="Mã thẻ">
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label uk-text-bold uk-text-warning uk-text-uppercase" for="serial">Serial
                            thẻ</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" id="seri" type="text" placeholder="Serial thẻ">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label uk-text-bold uk-text-warning uk-text-uppercase " for="type">Loại
                            thẻ</label>
                        <div class="uk-form-controls">
                            <select class="uk-select" id="loaithe" required="">
                                <?=file_get_contents("https://card24h.com/api/loaithe2.php");?>
                            </select>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label uk-text-bold uk-text-warning uk-text-uppercase " for="amount">Mệnh
                            giá thẻ</label>
                        <div class="uk-form-controls">
                            <select class="uk-select" name="amount" id="menhgia">
                                <?=file_get_contents("https://card24h.com/api/menhgia2.php");?>
                            </select>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <div class="uk-form-controls">
                            <button id="NapThe" type="submit"
                                class="uk-button lq-btn1 uk-button-default uk-width-3-3 uk-background-norepeat uk-background-contain"
                                style="background-image: url('<?=BASE_URL('template/envilthemes/imgs/bg_btn1.png');?>';);"
                                data-src="<?=BASE_URL('template/envilthemes/imgs/bg_btn1.png');?>" uk-img=""><span>NẠP
                                    NGAY</span></button>

                        </div>
                    </div>
                </form>
                <br>
                <div class="table-responsive">
                    <table id="datatable" style="color: white;" class="table table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>SERI</th>
                                <th>PIN</th>
                                <th>LOẠI THẺ</th>
                                <th>MỆNH GIÁ</th>
                                <th>THỰC NHẬN</th>
                                <th>THỜI GIAN</th>
                                <th>TRẠNG THÁI</th>
                                <th>GHI CHÚ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $i = 0;
                                    foreach($NNL->get_list(" SELECT * FROM `cards` WHERE `username` = '".$getUser['username']."'  ORDER BY id DESC ") as $row){
                                    ?>
                            <tr>
                                <td><?=$i++;?></td>
                                <td><?=$row['seri'];?></td>
                                <td><?=$row['pin'];?></td>
                                <td><span class="badge badge-danger"><?=$row['loaithe'];?></span></td>
                                <td><?=format_cash($row['menhgia']);?></td>
                                <td><?=format_cash($row['thucnhan']);?></td>
                                <td><span class="badge badge-dark"><?=$row['createdate'];?></span></td>
                                <td><?=status($row['status']);?></td>
                                <td><?=$row['note'];?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
$("#NapThe").on("click", function() {
    $('#NapThe').html('ĐANG XỬ LÝ').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/NapThe.php");?>",
        method: "POST",
        data: {
            loaithe: $("#loaithe").val(),
            menhgia: $("#menhgia").val(),
            seri: $("#seri").val(),
            pin: $("#pin").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#NapThe').html(
                    'NẠP NGAY')
                .prop('disabled', false);
        }
    });
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
<script>
$(function() {
    $("#datatable1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>
<script>
$(function() {
    $("#datatable2").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>
<?php 
    require_once("../../public/client/Footer.php");
?>