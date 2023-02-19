<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'THÔNG TIN | '.$NNL->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
    CheckLogin();
?>

<div class="w-full max-w-6xl mx-auto pt-6 md:pt-8 pb-8">
    <div class="grid grid-cols-8 gap-4 md:p-4 bg-box-dark">
        <div class="col-span-8 mb-4">
            <div class="v-infomation relative h-40 lg:h-48" style="margin: 0px 0.15rem;">
                <div class="w-full relative text-center">
                    <img class="mx-auto shadow border-2 border-gray-800 w-32 h-32 object-cover object-center"
                        src="<?=BASE_URL('assets/img/avt.jpg');?>" alt="">
                    <h4 class="my-1 font-bold text-lg lg:text-2xl flex justify-center px-5 text-gray-900">
                        <span class="inline-block truncate mr-1 text-white"
                            style="max-width: 9.5rem;"><?=$getUser['username'];?></span>
                    </h4>
                </div>
            </div>
            <div class="my-1"><span class="block mx-auto w-1/5 border-b border-gray-200"></span></div>
        </div>

        <?php require_once('Sidebar.php');?>

        <div class="col-span-8 sm:col-span-5 md:col-span-6 lg:col-span-6 xl:col-span-6 px-2 md:px-0">
            <div class="v-bg w-full mb-5">
                <h2 class="v-title border-l-4 border-red-800 px-3 select-none text-white text-xl md:text-2xl font-bold">
                    THÔNG TIN TÀI KHOẢN</h2>
                <div class="v-table-content-2">
                    <div class="py-3 px-4">
                        <table class="table-auto w-full">
                            <tbody class="text-sm select-text">
                                <tr class="v-border-hr-2 rounded-none py-10">
                                    <td class="v-account-text py-2 font-bold text-white">ID TÀI KHOẢN</td>
                                    <td class="v-table-title font-bold px-2 py-2 text-white uppercase"><span
                                            class="py-1 px-3 bg-red-600 text-white rounded"><?=$getUser['id'];?></span>
                                    </td>
                                </tr>
                                <tr class="v-border-hr-2 rounded-none py-10">
                                    <td class="v-account-text py-2 font-bold text-white">TÊN TÀI KHOẢN</td>
                                    <td class="v-table-title px-2 py-2 text-white"><?=$getUser['username'];?></td>
                                </tr>
                                <tr class="v-border-hr-2 rounded-none py-10">
                                    <td class="v-account-text py-2 font-bold text-white">SỐ DƯ</td>
                                    <td class="px-2 py-2 text-white"><b
                                            class="text-red-500"><?=format_cash($getUser['money']);?> VNĐ</b></td>
                                </tr>
                                <tr class="v-border-hr-2 rounded-none py-10">
                                    <td class="v-account-text py-2 font-bold text-white">NHÓM TÀI KHOẢN</td>
                                    <td class="v-table-title px-2 py-2 text-white">THÀNH VIÊN</td>
                                </tr>
                                <tr class="v-border-hr-2 rounded-none py-10">
                                    <td class="v-account-text py-2 font-bold text-white">NGÀY THAM GIA</td>
                                    <td class="v-table-title px-2 py-2 text-white">
                                        <?=$getUser['createdate'];?> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php 
    require_once("../../public/client/Footer.php");
?>