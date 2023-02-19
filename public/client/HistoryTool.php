<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'LỊCH SỬ MUA NICK | '.$NNL->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
    CheckLogin();
?>
<div class="w-full max-w-6xl mx-auto pt-6 md:pt-8 pb-8">
    <div class="grid grid-cols-8 gap-4 md:p-4 bg-box-dark">
        <?php require_once('Sidebar.php');?>
        <div class="col-span-8 sm:col-span-5 md:col-span-6 lg:col-span-6 xl:col-span-6 px-2 md:px-0">
            <div class="v-bg w-full mb-2 px-2">
            <h2
                                class="v-title border-l-4 border-red-800 px-3 select-none text-white text-xl md:text-2xl font-bold">
                    LỊCH SỬ MUA TOOL
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
                                        LOẠI
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        LICENSE
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        DAY
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        HSD
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        THỜI GIAN MUA
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-white text-left px-1">
                                        THAO TÁC
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-semibold">
                                <?php $i = 1; foreach($NNL->get_list(" SELECT * FROM `license` WHERE `user` = '".$getUser['username']."' ORDER BY id DESC ") as $tool){ 
                                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                                    $exptool;
                                    $now = time();
                                    $status = "";
                                    $h = "";
                                    if ($tool['time'] != "") {
                                        $time = $tool['time'];//lấy thời gian của csdl ra
                                    
                                        $time = date_parse_from_format('Y-m-d H:i:s', $time);
                                        $time_stamp = mktime($time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year']);
                                        $exptool=($now - $time_stamp) / 86400;
                                        $hsd =(int)$tool['day'] - (int)$exptool;
                                        if($hsd > 0)
                                        {
                                            $status = "Còn ".$hsd." ngày";
                                            
                                        }
                                        else
                                        {
                                            $status = "Hết Hạn";                     
                                        }
                                    }
                                ?>
                                <tr style="background-color: transparent;">
                                    <td class="text-sm text-white text-left px-1 py-1 border-b"><?=$i++;?></td>
                                    <td class="text-sm text-white text-left px-1 py-1 border-b">
                                        <?=$tool['nameTool'];?></td>

                                    <td class="text-sm text-white text-left px-1 py-1 border-b">
                                        <?=$tool['keytool'];?></td>
                                    <td class="text-sm text-white text-left px-1 py-1 border-b"><?=$tool['day'];?>
                                    </td>
                                    <td class="text-sm text-white text-left px-1 py-1 border-b">

                                        <?php 
                                                    if($status=="Hết Hạn")
                                                    {
                                                ?>
                                        <?php echo $status;?>
                                        <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                        <?php echo $status;?>
                                        <?php
                                                    }
                                                    ?>

                                    </td>

                                    <td class="text-sm text-white text-left px-1 py-1 border-b"><span
                                            class="badge badge-danger"><?=$tool['time'];?></span></td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
                                        <a href="<?=BASE_URL('ChangeKey/')?><?=$tool['id']?>"
                                            class="ml-2 inline-flex items-center font-bold text-white bg-green-600 justify-center h-6 text-md rounded focus:outline-none px-2 text-center">
                                            ĐỔI KEY
                                        </a>
                                        <?php
                                                        $idlink=$tool['tool_id']; 
                                                        $link=$NNL->get_row("SELECT * FROM `tool` where tool_id='$idlink'");
                                                ?>
                                        <a href="<?=$link['link']?>"
                                            class="ml-2 inline-flex items-center font-bold text-white bg-blue-600 justify-center h-6 text-md rounded focus:outline-none px-2 text-center">
                                            DOWNLOAD
                                        </a>
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
</script>
<?php 
    require_once("../../public/client/Footer.php");
?>