<?php
        require_once("../../config/config.php");
        require_once("../../config/function.php");
        $title = 'THANH TOÁN | '.$NNL->site('tenweb');
        require_once("../../public/client/Header.php");
        require_once("../../public/client/Nav.php");
?>
<?php
if(isset($_GET['id']))
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
?>
<div class="pb-10">
    <div class="mt-12 relative w-full max-w-6xl mx-auto text-gray-800 pb-8 px-2 md:px-4 bg-box-dark">
        <div
            class="fade-in mb-2 py-2 md:mb-4 block uppercase md:py-4 text-center text-yellow-400 md:text-3xl text-2xl font-extrabold text-fill ">
            CHI TIẾT TOOL GAME
        </div>
        <div class="col-span-12 grid grid-cols-10 gap-2 select-none py-2 px-2 color-grant text-xl font-bold rounded"
            style="background: rgb(37 37 37); top: 60px; index: 98;">
            <div class="col-span-10 md:col-span-5">
                <div class="flex items-center flex-wrap text-yellow-500 pt-3">
                    <div class="relative">
                        <?=format_cash($row['price']);?>đ/1 tháng
                        <span class="absolute" style="top: -18px; left: 1px; font-size: 0.7rem;">
                            GIÁ BÁN
                        </span>
                    </div>
                </div>
            </div>
            <div class="v-skull-top col-span-10 md:col-span-5 text-yellow-500 flex justify-end items-center flex-wrap">
                <input type="text" placeholder="Mã giảm giá (nếu có)" id="magiamgia"
                    class="border border-gray-400 rounded bg-white text-gray-800 appearance-none py-2 px-3 leading-tight focus:outline-none">
                <button
                    class="ml-4 flex bg-red-500 text-white items-center justify-center h-10 text-2xl rounded focus:outline-none px-4 text-center"
                    id="btnThanhToan">
                    MUA NGAY
                </button>
            </div>
        </div>
        <div class="mt-4">

            <div class="v-account-detail p-2 md:px-0 mt-4">
                <div class="v-account-detail-1" id="taikhoan">
                    <div class="mb-10">
                        <?=$row['chucnang']?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
$("#btnThanhToan").on("click", function() {
    $('#btnThanhToan').html('ĐANG XỬ LÝ').prop('disabled',
        true);

    Swal.fire({
        title: 'Xác Nhận Thanh Toán',
        text: "Bạn có đồng ý mua tool này không ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Mua ngay'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?=BASE_URL("assets/ajaxs/Nro.php");?>",
                method: "POST",
                data: {
                    magiamgia: $("#magiamgia").val(),
                    id: <?=$row['tool_id'];?>
                },
                success: function(response) {
                    $("#thongbao").html(response);
                    $('#btnThanhToan').html(
                            'THANH TOÁN')
                        .prop('disabled', false);
                }
            });
        } else {
            $('#btnThanhToan').html(
                    'THANH TOÁN')
                .prop('disabled', false);
        }
    })



});
</script>
<?php 
    require_once("../../public/client/Footer.php");
?>