<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'NẠP THẺ CÀO | '.$NNL->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
    CheckLogin();
?>
<div class="w-full max-w-6xl mx-auto pt-6 md:pt-8 pb-8">
    <div class="grid grid-cols-8 gap-4 md:p-4 bg-box-dark">
        <?php require_once('Sidebar.php');?>
        <div class="col-span-8 sm:col-span-5 md:col-span-6 lg:col-span-6 xl:col-span-6 px-2 md:px-0">
            <div class="w-full mb-2">
                <div class="rounded w-full">
                    <span>
                        <form method="POST" class="w-full">
                            <h2
                                class="v-title border-l-4 border-red-800 px-3 select-none text-white text-xl md:text-2xl font-bold">
                                NẠP THẺ CÀO AUTO
                            </h2>
                            <div class="mt-4 text-white">
                                <div class="p-2 border border-gray-300 mb-4">
                                    <div class="flex justify-between items-center cursor-pointer">
                                        <div class="flex select-none"><img src="<?=BASE_URL('assets/img/');?>bank.png"
                                                class="h-10 w-10 rounded">
                                            <div class="ml-2 text-left">
                                                <h2 class="font-bold text-base">
                                                    Nạp thẻ cào tự động
                                                </h2>
                                                <p class="text-xs">Siêu nhanh nhận tiền trong vài giây</p>
                                            </div>
                                        </div> <button
                                            class="select-none focus:outline-none bg-pink-600 text-white text-xs inline-block h-5 flex items-center justify-center font-semibold px-2 rounded">
                                            Auto
                                        </button>
                                    </div>
                                    <div>
                                        <div class="border-t border-gray-200 mt-2 p-2 select-text">
                                            <div class="relative">
                                                <?=$NNL->site('luuy_naptien');?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="py-3 px-5">
                                <span class="mb-2 block">
                                    <div class="flex items-center relative">
                                        <select id="loaithe"
                                            class="border border-gray-500 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">
                                        </select>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                class="fill-current h-4 w-4">
                                                <path
                                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </span>
                                <span class="mb-2 block">
                                    <div class="flex items-center relative">
                                        <select id="menhgia"
                                            class="border border-gray-500 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">

                                        </select>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                class="fill-current h-4 w-4">
                                                <path
                                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </span>
                                <span class="mb-2 block">
                                    <div class="flex items-center relative"><input type="number" id="pin"
                                            placeholder="Mã số thẻ"
                                            class="border border-gray-500 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none" />
                                    </div>
                                </span>
                                <span class="mb-2 block">
                                    <div class="flex items-center relative"><input type="number" id="seri"
                                            placeholder="Số serial"
                                            class="border border-gray-500 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none" />
                                    </div>
                                </span>
                                <div class="mt-4 text-center">
                                    <button type="button" id="NapThe"
                                        class="uppercase flex w-40 font-semibold rounded items-center justify-center h-10 text-white text-xl rounded-none focus:outline-none px-4 text-center bg-red-500 hover:bg-red-600">
                                        Nạp Thẻ
                                    </button>
                                </div>
                                <div class="mt-2 text-red-500 font-semibold text-sm">
                                </div>
                            </div>
                        </form>
                    </span>
                    <!---->
                </div>
            </div>
            <div class="v-bg w-full mb-2 px-2">
                <h2 class="v-title border-l-4 border-red-800 px-3 select-none text-white text-xl md:text-2xl font-bold">
                    LỊCH SỬ NẠP THẺ
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
                                        NHÀ MẠNG
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        M.GIÁ/T.NHẬN
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        MÃ THẺ
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        SERIAL THẺ
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        TRẠNG THÁI
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        NẠP LÚC
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-semibold">
                                <?php $i = 1; foreach($NNL->get_list("SELECT * FROM `cards` WHERE `username` = '".$getUser['username']."' order by `id` desc ") as $cards) { ?>
                                <tr style="background-color: transparent;">
                                    <td class="text-sm text-white text-left px-1 py-1"><?=$i++;?></td>
                                    <td class="text-sm text-white text-left px-1 py-1">
                                        <?=$cards['loaithe'];?></td>
                                    <td class="text-sm text-white text-left px-1 py-1">
                                        <?=format_cash($cards['menhgia']);?> VNĐ</td>
                                    <td class="text-sm text-white text-left px-1 py-1"><?=$cards['seri'];?>
                                    </td>
                                    <td class="text-sm text-white text-left px-1 py-1"><?=$cards['pin'];?>
                                    </td>
                                    <td class="text-sm text-white text-left px-1 py-1">
                                        <?=status($cards['status']);?>
                                    </td>
                                    <td class="text-sm text-white text-left px-1 py-1 border-b">
                                        <?=$cards['createdate'];?></td>
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
$("#NapThe").on("click", function() {
    $('#NapThe').html('ĐANG XỬ LÝ').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/NapThe.php");?>",
        method: "POST",
        data: {
            type:"Napthe",
            loaithe: $("#loaithe").val(),
            menhgia: $("#menhgia").val(),
            seri: $("#seri").val(),
            pin: $("#pin").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#NapThe').html(
                    'Nạp Thẻ')
                .prop('disabled', false);
        }
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#datatable').DataTable();
});

$(document).ready(function() {
    setTimeout(e => {
        GetCard24()
    }, 0)
});

function GetCard24() {
    $.ajax({
        url: "<?=BASE_URL('api/loaithe.php');?>",
        method: "GET",
        success: function(response) {
            $("#loaithe").html(response);
        }
    });
    $.ajax({
        url: "<?=BASE_URL('api/menhgia.php');?>",
        method: "GET",
        success: function(response) {
            $("#menhgia").html(response);
        }
    });

}
</script>
<?php 
    require_once("../../public/client/Footer.php");
?>