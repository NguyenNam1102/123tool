<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'LỊCH SỬ MUA NICK | '.$NNL->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
    CheckLogin();
?>

<div class="w-full max-w-6xl mx-auto pt-6 md:pt-8 pb-8">
    <div class="grid grid-cols-8 gap-4">
        <?php require_once('Sidebar.php');?>
        <div class="col-span-8 sm:col-span-5 md:col-span-6 lg:col-span-6 xl:col-span-6 px-2 md:px-0">
            <div class="v-bg w-full mb-2 px-2">
                <h2
                    class="v-title border-l-4 border-gray-800 px-3 select-none text-gray-800 text-xl md:text-2xl font-bold">
                    LỊCH SỬ MUA TOOL
                </h2>

                <div class="v-table-content select-text">
                    <div class="py-2 overflow-x-auto scrolling-touch max-w-400">
                        <table id="datatable" class="table-auto w-full scrolling-touch min-w-850">
                            <thead>
                                <tr class="v-border-hr select-none border-b-2 border-gray-300">
                                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                                        STT
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                                        LOẠI
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                                        CPU
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                                        RAM
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                                        MONEY
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                                        IP
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                                        USERNAME
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                                        PASSWORD
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                                        STATUS
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                                        TIME
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-semibold">
                                <?php $i = 1; foreach($NNL->get_list(" SELECT * FROM `historyvps` WHERE `username` = '".$getUser['username']."' ORDER BY id DESC ") as $tool){ 
                                ?>
                                <tr>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><?=$i++;?></td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
                                        <?=$tool['name'];?></td>

                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
                                        <?=$tool['cpu'];?></td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><?=$tool['ram'];?>
                                    </td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
                                        <?=format_cash($tool['price']);?>đ
                                    </td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
                                        <?=$tool['ip'];?>
                                    </td>

                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><span
                                            class="badge badge-danger"><?=$tool['taikhoan'];?></span></td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><span
                                            class="badge badge-danger"><?=$tool['matkhau'];?></span></td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
                                        <?php
                                                if($tool['status']==0)
                                                {
                                        ?>
                                        <span
                                            class="ml-2 inline-flex items-center font-bold text-white bg-red-600 w-full justify-center h-6 text-md rounded focus:outline-none px-2 text-center">
                                            Đang xử lý
                                        </span>
                                        <?php
                                                }
                                                else{
                                        ?>
                                        <span
                                            class="ml-2 inline-flex items-center font-bold text-white bg-green-600 justify-center h-6 text-md rounded focus:outline-none px-2 text-center">
                                            Hoạt động
                                        </span>
                                        <?php
                                                }
                                        ?>
                                    </td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><span
                                            class="badge badge-danger"><?=$tool['time'];?></span></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="v-table-note mt-1 py-1 font-semibold text-gray-800 text-sm">
                        Dùng điện thoại <i class="bx bxs-mobile"></i>, hãy vuốt bảng từ phải qua trái (<i
                            class="bx bxs-arrow-from-right"></i>) để xem đầy đủ thông tin!
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
</script>


<?php 
    require_once("../../public/client/Footer.php");
?>