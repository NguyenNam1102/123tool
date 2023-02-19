<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'MÃ GIẢM GIÁ | '.$NNL->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
    CheckLogin();
?>
<div class="w-full max-w-6xl mx-auto pt-6 md:pt-8 pb-8">
    <div class="grid grid-cols-8 gap-4 md:p-4 bg-box-dark">
        <?php require_once('Sidebar.php');?>
        <div class="col-span-8 sm:col-span-5 md:col-span-6 lg:col-span-6 xl:col-span-6 px-2 md:px-0">
            <div class="v-bg w-full mb-2 px-2">
            <h2 class="v-title border-l-4 border-red-800 px-3 select-none text-white text-xl md:text-2xl font-bold">
                    DANH SÁCH MÃ GIẢM GIÁ
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
                                        MÃ CODE
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        GIẢM THEO PHẦN TRĂM
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        SỐ LƯỢNG CÒN
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        TRẠNG THÁI
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        ĐÃ THÊM VÀO LÚC
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-semibold">
                            <?php $i = 1; foreach($NNL->get_list("SELECT * FROM `giftcode`") as $gift) { ?>
                                <tr style="background-color: transparent;">
                                    <td class="text-sm text-white text-left px-1 py-1"><?=$i++;?></td>
                                    <td class="text-sm text-white text-left px-1 py-1"><div class="my-2 items-center w-full text-center"><span
                                            class="font-bold border-dashed border border-red-600 rounded inline-flex justify-center text-center text-red-500 py-1 rounded px-4">
                                            <b id="copyNoiDung"><?=$gift['code'];?></b>
                                        </span></div></td>
                                    <td class="text-sm text-white text-left px-1 py-1"><?=$gift['phantram'];?></td>
                                    <td class="text-sm text-white text-left px-1 py-1"><?=$gift['soluong'];?></td>
                                    <td class="text-sm text-white text-left px-1 py-1"><?php if($gift['status'] == 0) { echo '<span
                                            class="py-1 px-3 bg-green-600 text-white rounded">Hoạt động</span>';} else { echo '<span
                                                class="py-1 px-3 bg-red-600 text-white rounded">Hết lượt</span>';};?></td>
                                    </td>
                                    <td class="text-sm text-red-500 text-left px-1 py-1"><?=$gift['time'];?></td>
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
</script>
<?php 
    require_once("../../public/client/Footer.php");
?>