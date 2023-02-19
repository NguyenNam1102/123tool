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
    $row = $NNL->get_row(" SELECT * FROM `vps` WHERE `id` = '".check_string($_GET['id'])."'  ");
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


<div class="mt-12 relative w-full max-w-6xl mx-auto text-gray-800 pb-8 px-2 md:px-0">
    <div class="dark:text-white md:ml-0 mb-4 text-left inline-block uppercase py-1 md:text-2xl text-xl font-extrabold">
        #<?=$row['name'];?> </div>
    <div class="sticky col-span-12 grid grid-cols-10 gap-2 select-none py-2 px-2 color-grant text-xl font-bold rounded"
        style="background: rgb(37 37 37); top: 60px; index: 98;">
        <div class="col-span-10 md:col-span-5">
            <div class="flex items-center flex-wrap text-yellow-500 pt-3">
                <div class="relative">
                    <?=format_cash($row['price']);?> đ
                    <span class="absolute" style="top: -18px; left: 1px; font-size: 0.7rem;">
                        GIÁ BÁN
                    </span>
                </div>
            </div>
        </div>
        <div class="v-skull-top col-span-10 md:col-span-5 text-yellow-500 flex justify-end items-center flex-wrap">
            <button
                class="ml-4 flex bg-red-500 text-white items-center justify-center h-10 text-2xl rounded focus:outline-none px-4 text-center"
                id="btnThanhToan">
                MUA NGAY
            </button>
        </div>
    </div>
    <div class="mt-4">
        <div class="v-account-detail p-2 md:px-0 mt-5">
            <div class="v-infomations border-t border-b border-gray-700 py-4 mb-10">
                <div class="w-full grid grid-cols-12 gap-4">
                    <div class="uppercase col-span-6 md:col-span-3 text-base md:text-xl font-semibold text-center"><span
                            class="text-gray-700">CPU: </span> <b class="text-red-600"> <?=$row['cpu']?></b></div>
                    <div class="uppercase col-span-6 md:col-span-3 text-base md:text-xl font-semibold text-center"><span
                            class="text-gray-700">RAM: </span> <b class="text-red-600"> <?=$row['ram']?></b></div>
                    <div class="uppercase col-span-6 md:col-span-3 text-base md:text-xl font-semibold text-center"><span
                            class="text-gray-700">VỊ TRÍ: </span> <b class="text-red-600"> <?=$row['address']?></b></div>
                </div>
            </div>
        </div>
        <div class="v-account-detail p-2 md:px-0 mt-4">
            <div class="v-account-detail-1" id="taikhoan">
                <div class="mb-10">
                   <?=$row['mota']?>
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
        text: "Bạn có đồng ý mua Vps này không ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Mua ngay'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?=BASE_URL("assets/ajaxs/Vps.php");?>",
                method: "POST",
                data: {
                    id: <?=$row['id'];?>
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