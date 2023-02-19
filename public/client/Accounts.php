<?php
        require_once("../../config/config.php");
        require_once("../../config/function.php");
        $title = 'DANH SÁCH TÀI KHOẢN | '.$NNL->site('tenweb');
        require_once("../../public/client/Header.php");
        require_once("../../public/client/Nav.php");
?>
<?php

if(isset($_GET['id']))
{
    $row = $NNL->get_row(" SELECT * FROM `groups` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row)
    {
        admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 500);
    }
}
else
{
    admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
}
$sotin1trang = 16;
if(isset($_GET['page']))
{
    $page = intval($_GET['page']);
}
else
{
    $page = 1;
}
$from = ($page - 1) * $sotin1trang;
if(isset($_GET['amount']))
{
    $amount = check_string($_GET['amount']);
    if($amount == 1)
    {
        $amount = ' AND `money` <= 50000 ';
    }
    else if($amount == 2)
    {
        $amount = ' AND `money` >= 50000 AND `money` <= 100000 ';
    }
    else if($amount == 3)
    {
        $amount = ' AND `money` >= 100000 AND `money` <= 200000 ';
    }
    else if($amount == 4)
    {
        $amount = ' AND `money` >= 200000 AND `money` <= 500000 ';
    }
    else if($amount == 5)
    {
        $amount = ' AND `money` >= 50000 ';
    }
    $type_amount = check_string($_GET['amount']);
}
else
{
    $amount = '';
    $type_amount = '';
}
if(isset($_GET['id_acc']))
{
    $id_acc = check_string($_GET['id_acc']);
}
else
{
    $id_acc = NULL;
}
$listAccount = $NNL->get_list("SELECT * FROM `accounts` WHERE `groups` = '".$row['id']."' AND `id` LIKE  '%$id_acc%' AND `username` IS NULL $amount ORDER BY id DESC LIMIT $from,$sotin1trang ");
?>
<div>
    <div class="w-full max-w-6xl mx-auto v-layout-item text-gray-800 py-4 md:py-12 px-4 md:px-2">
        <div
            class="v-text-1 mb-2 text-gray-800 text-left inline-block uppercase py-1 md:text-2xl text-xl font-extrabold">
            <?=$row['title'];?>
        </div>
        <div class="v-text-1 mb-4">
            <form class="grid grid-cols-8 gap-2 md:gap-6" action="<?=BASE_URL('public/client/Accounts.php');?>"
                method="GET">
                <input value="<?=check_string($_GET['id']);?>" name="id" type="hidden">
                <div class="col-span-8 sm:col-span-2 flex">
                    <div class="flex -mr-px"><span
                            class="bg-gray-100 border border-gray-300 w-24 justify-center text-gray-800 font-medium flex items-center leading-normal rounded-none border px-3">Mã
                            số</span></div>
                    <div class="flex items-center relative w-full">
                        <input name="id_acc" placeholder="Ví dụ: 123421"
                            class="border-2 border-gray-300 rounded-none bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none" />
                    </div>
                </div>
                <div class="col-span-8 sm:col-span-2 flex">
                    <div class="flex -mr-px"><span
                            class="bg-gray-100 border border-gray-300 w-24 justify-center text-gray-800 font-medium flex items-center leading-normal rounded-none border px-3">Giá
                            từ</span></div>
                    <div class="flex items-center relative w-full">
                        <select name="amount"
                            class="border-2 border-gray-300 rounded-none bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">
                            <option value="">Tìm theo giá</option>
                            <option value="1">0 - 50.000</option>
                            <option value="2">50.000 - 100.000</option>
                            <option value="3">100.000 - 200.000</option>
                            <option value="4">200.000 - 500.000</option>
                            <option value="5">> 500.000</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current h-4 w-4">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-span-8 sm:col-span-2 flex items-center">
                    <button type="submit"
                        class="mr-1 bg-red-600 text-white w-full rounded-none font-bold py-2 px-4 rounded focus:outline-none">
                        Tìm kiếm
                    </button>
                    <a href="<?=BASE_URL('public/client/Accounts.php?id='.check_string($_GET['id']));?>"
                        class="ml-1 bg-gray-700 w-full text-white rounded-none font-bold py-2 px-4 rounded focus:outline-none">
                        <button type="button"
                            class="bg-gray-700 w-full text-white rounded-none font-bold rounded focus:outline-none">
                            Tất cả
                        </button>
                    </a>
                </div>
            </form>
        </div>
        <div class="my-2"></div>
        <div class="my-6 v-item-account">
            <div class="grid grid-cols-8 gap-2 md:gap-4">
                <?php foreach($listAccount as $acc) {?>
                <div class="fade-in col-span-8 sm:col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-2 border border-gray-300 relative"
                    style="padding: 1px;">
                    <div>
                        <div class="relative">
                            <a href="<?=BASE_URL('Orders/'.$acc['id']);?>">
                                <div class="relative">
                                    <img class="h-56 md:h-40 w-full object-fill object-center lazyLoad"
                                        data-src="<?=$acc['img'];?>" />
                                    <span
                                        class="absolute v-text-1 bg-red-700 text-white font-bold text-sm inline-block px-2 rounded-sm"
                                        style="right: 5px; top: 5px;">#<?=$acc['id'];?></span>
                                </div>
                            </a>
                            <div class="py-2 bg-gray-200 px-2"></div>
                            <div class="my-2 py-2 px-2 relative">
                                <div class="grid grid-cols-12 gap-3 text-gray-700 font-medium text-sm">
                                    <?php $a = explode(PHP_EOL, $acc['chitiet']); $i=0;
                                    foreach($a as $b) {  $c = explode(": ", $b); $i++; if($i >= 4){break;} ;?>
                                    <div class="col-span-6 text-center">
                                        <p>
                                            <?=$c[0];?>:
                                            <b class="text-gray-800"><?=$c[1];?> </b>
                                        </p>
                                    </div>
                                    <?php }?>
                                    <div class="col-span-6 text-center">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 rounded-b-sm grid grid-cols-12 gap-5 p-2">
                                <div class="col-span-6">
                                    <ul class="v-text-1 rounded-sm w-full font-medium" style="font-weight: 500;">
                                        <p
                                            class="w-full border border-red-600 text-center rounded text-red-600 block px-3 py-1">
                                            <?=format_cash($acc['money']);?> đ
                                        </p>
                                    </ul>
                                </div>
                                <div class="col-span-6">
                                    <div class="w-full">
                                        <a href="<?=BASE_URL('Orders/'.$acc['id']);?>"
                                            class="cursor-pointer border rounded w-full text-center cursor-pointer border-red-500 hover:border-yellow-500 bg-red-500 transition duration-200 hover:bg-yellow-500 text-white uppercase inline-block font-semibold py-1 px-3">
                                            Chi tiết
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
            <div class="mt-3 md:mt-6 w-full flex justify-center items-center">
                <?php
            $tong = $NNL->num_rows(" SELECT * FROM `accounts` WHERE `groups` = '".$row['id']."' AND `id` LIKE  '%$id_acc%' AND `username` IS NULL $amount ORDER BY id DESC ");
            if ($tong > $sotin1trang)
            {
                echo '<center>' . phantrang($base_url.'public/client/Accounts.php?id='.check_string($_GET['id']).'&amount='.$type_amount.'&id_acc='.$id_acc.'&', $from, $tong, $sotin1trang) . '</center>';
            }?>
            </div>
        </div>
    </div>
</div>

</div>

<?php 
    require_once("../../public/client/Footer.php");
?>