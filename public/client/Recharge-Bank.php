<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'NẠP ATM/MOMO TỰ ĐỘNG| '.$NNL->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
    CheckLogin();
?>
<div class="w-full max-w-6xl mx-auto pt-6 md:pt-8 pb-8">
    <div class="grid grid-cols-8 gap-4 md:p-4 bg-box-dark">
        <?php require_once('Sidebar.php');?>
        <div class="col-span-8 sm:col-span-5 md:col-span-6 lg:col-span-6 xl:col-span-6 px-2 md:px-0">
            <div class="w-full mb-10">
                <h2 class="v-title border-l-4 border-red-800 px-3 select-none text-white text-xl md:text-2xl font-bold">
                    Nạp tiền qua ATM/MOMO
                </h2>
                <div class="mt-4 text-white">
                    <div class="p-2 border border-gray-300 mb-4">
                        <div class="flex justify-between items-center cursor-pointer">
                            <div class="flex select-none"><img src="<?=BASE_URL('assets/img/');?>bank.png"
                                    class="h-10 w-10 rounded">
                                <div class="ml-2 text-left">
                                    <h2 class="font-bold text-base">
                                        Chuyển khoản qua Ngân hàng & Ví điện tử
                                    </h2>
                                    <p class="text-xs">Chuyển khoản ngân hàng online.</p>
                                </div>
                            </div> <button
                                class="select-none focus:outline-none bg-pink-600 text-white text-xs inline-block h-5 flex items-center justify-center font-semibold px-2 rounded">
                                Auto
                            </button>
                        </div>
                        <div>
                            <div class="border-t border-gray-200 mt-2 p-2 select-text">
                                <div class="relative">
                                    <?=$NNL->site('luuy_napbank');?>
                                    <p style="margin-left: 0px;">&nbsp;</p>
                                    <p>&nbsp;</p>
                                    <p><strong>THÔNG TIN TÀI KHOẢN NGÂN HÀNG</strong></p>
                                    <?php foreach($NNL->get_list("SELECT * FROM `bank` ") as $bank) { ?>
                                    <p style="margin-left: 0px;"><span style="color: rgb(43, 0, 254);"><strong>✔ :&nbsp;
                                                <?=$bank['name'];?></strong></span></p>
                                    <p style="margin-left: 0px;"><strong>Chủ tài khoản:
                                            <?=$bank['bank_name'];?></strong>
                                    </p>
                                    <p style="margin-left: 0px;"><strong>STK/SDT: </strong><span
                                            style="color: red;"><strong><?=$bank['stk'];?></strong></span></p>
                                    <p style="margin-left: 0px;"><strong><?=$bank['ghichu'];?></strong></p>
                                    <p style="margin-left: 0px;">&nbsp;</p>
                                    <?php }?>

                                </div>
                                <div class="py-3 pt-5">

                                    <form accept-charset="UTF-8" class="form-charge">
                                        <input id="magdtsr" type="text" placeholder="Mã giao dịch" required="required"
                                            class="mb-2 py-1 rounded-sm px-3 text-gray-800 focus:outline-none font-semibold border border-gray-500 bg-white" />
                                        <button type="button" id="NapTsr"
                                            class="py-1 text-white border border-red-600 px-3 bg-red-600 hover:bg-red-500 hover:border-red-500 font-semibold focus:outline-none"
                                            data-loading-text="<box-icon name='loader'></box-icon>">
                                            XÁC NHẬN NẠP TSR
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="border-t border-gray-200 w-full select-text">
                                <div class="p-2">
                                    <div>Nội dung chuyển khoản của bạn:</div>
                                    <div class="my-2 items-center w-full text-center"><span
                                            class="font-bold border-dashed border border-red-600 rounded inline-flex justify-center text-center text-red-500 py-1 rounded px-4">
                                            <b id="copyNoiDung"><?=$NNL->site('noidung_naptien').$getUser['username'];?></b>
                                        </span> <button type="button"
                                            class="copy ml-1 bg-gray-500 font-semibold text-white rounded focus:outline-none py-1 px-3"
                                            data-clipboard-target="#copyNoiDung">
                                            Sao chép
                                        </button></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="v-bg w-full mb-2 px-2">
                <h2 class="v-title border-l-4 border-red-800 px-3 select-none text-white text-xl md:text-2xl font-bold">
                    LỊCH SỬ NẠP TSR
                </h2>
                <div class="v-table-content select-text">
                    <div class="py-2 overflow-x-auto scrolling-touch max-w-400">
                        <table id="datatable" class="table-auto w-full scrolling-touch min-w-850">
                            <thead>
                                <tr class="v-border-hr select-none border-b-2 border-gray-300">
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        STT
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        MÃ GD
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        TIỀN
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        KHUYẾN MÃI
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        T.NHẬN
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        THỜI GIAN
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        TRẠNG THÁI
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-semibold">
                                <?php $i = 1; foreach($NNL->get_list("SELECT * FROM `thesieure` WHERE `user` = '".$getUser['username']."' order by `id` desc ") as $cards) { ?>
                                <tr style="background-color: transparent;">
                                    <td class="text-sm text-white text-left px-1 py-1"><?=$i++;?></td>
                                    <td class="text-sm text-white text-left px-1 py-1">
                                        <?=$cards['magd'];?></td>
                                    <td class="text-sm text-white text-left px-1 py-1 b">
                                        <?=format_cash($cards['price']);?> VNĐ</td>
                                    <td class="text-sm text-white text-left px-1 py-1">
                                        <?=$cards['khuyenmai'];?>%
                                    </td>
                                    <td class="text-sm text-white text-left px-1 py-1">
                                        <?=format_cash($cards['thucnhan']);?> VNĐ
                                    </td>
                                    <td class="text-sm text-white text-left px-1 py-1">
                                        <?=$cards['time'];?></td>
                                    <td class="text-sm text-white text-left px-1 py-1 ">
                                        <?=status($cards['status']);?>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="v-bg w-full mb-2 px-2">
                <h2 class="v-title border-l-4 border-red-800 px-3 select-none text-white text-xl md:text-2xl font-bold">
                    LỊCH SỬ NẠP MOMO
                </h2>
                <div class="v-table-content select-text">
                    <div class="py-2 overflow-x-auto scrolling-touch max-w-400">
                        <table id="datatable" class="table-auto w-full scrolling-touch min-w-850">
                            <thead>
                                <tr class="v-border-hr select-none border-b-2 border-gray-300">
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        STT
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        MÃ GD
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        TIỀN
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        KHUYẾN MÃI
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        T.NHẬN
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        THỜI GIAN
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        TRẠNG THÁI
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-semibold">
                                <?php $i = 1; foreach($NNL->get_list("SELECT * FROM `momo` WHERE `user` = '".$getUser['username']."' order by `id` desc ") as $cards) { ?>
                                <tr style="background-color: transparent;">
                                    <td class="text-sm text-white text-left px-1 py-1"><?=$i++;?></td>
                                    <td class="text-sm text-white text-left px-1 py-1">
                                        <?=$cards['magd'];?></td>
                                    <td class="text-sm text-white text-left px-1 py-1 b">
                                        <?=format_cash($cards['price']);?> VNĐ</td>
                                    <td class="text-sm text-white text-left px-1 py-1">
                                        <?=$cards['khuyenmai'];?>%
                                    </td>
                                    <td class="text-sm text-white text-left px-1 py-1">
                                        <?=format_cash($cards['thucnhan']);?> VNĐ
                                    </td>
                                    <td class="text-sm text-white text-left px-1 py-1">
                                        <?=$cards['time'];?></td>
                                    <td class="text-sm text-white text-left px-1 py-1 ">
                                        <?=status($cards['status']);?>
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
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#datatable').DataTable();
});
$("#Napmomo").on("click", function() {
    $('#Napmomo').html('ĐANG XỬ LÝ').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/NapMomo.php");?>",
        method: "POST",
        data: {
            magd: $("#magd").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#Napmomo').html(
                    'NẠP NGAY')
                .prop('disabled', false);
        }
    });
});
$("#NapTsr").on("click", function() {
    $('#NapTsr').html('ĐANG XỬ LÝ').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/NapTsr.php");?>",
        method: "POST",
        data: {
            magd: $("#magdtsr").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#NapTsr').html(
                    'NẠP NGAY')
                .prop('disabled', false);
        }
    });
});
</script>


<?php 
    require_once("../../public/client/Footer.php");
?>