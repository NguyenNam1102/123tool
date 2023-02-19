<?php
    include "../config/config.php";
    include "../config/function.php";
?>
<div class="v-table-content select-text">
    <div class="py-2 overflow-x-auto scrolling-touch max-w-400">
        <table id="datatable" class="table-auto w-full scrolling-touch min-w-850">
            <thead>
                <tr class="v-border-hr select-none border-b-2 border-gray-300">
                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                        STT
                    </th>
                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                        ID PHÒNG
                    </th>
                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                        NHÂN VẬT
                    </th>
                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                        TIỀN CƯỢC
                    </th>
                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                        LOẠI SOLO
                    </th>
                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                        TƯỚNG
                    </th>
                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                        NGƯỜI NHẬN KÈO
                    </th>
                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                       KẾT QUẢ SOLO
                    </th>
                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                        TRẠNG THÁI
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm font-semibold">
                <?php 
                                       $kiemtra = $NNL->get_row("SELECT * FROM `pk` WHERE `status`=0 AND `time` < CURRENT_TIMESTAMP - INTERVAL 10 MINUTE");
                                       if($kiemtra)
                                       {
                                            $isMoney = $NNL->cong("users", "money", $kiemtra['cuoc'], " `username` = '".$kiemtra['user']."' ");
                                            if($isMoney)
                                            {
                                                /* GHI LOG DÒNG TIỀN */
                                                $NNL->insert("dongtien", array(
                                                    'sotientruoc'   => $getUser['money'],
                                                    'sotienthaydoi' => +$kiemtra['cuoc'],
                                                    'sotiensau'     => $getUser['money']+$kiemtra['cuoc'],
                                                    'thoigian'      => gettime(),
                                                    'noidung'       => 'Hoàn tiền gói solo ('.$kiemtra['type'].')',
                                                    'username'      => $kiemtra['user']
                                                ));
                                                /* UPdate lại trạng thái */
                                                $NNL->update("pk", array(
                                                    'status' => 2,
                                                    'ketqua' =>3
                                                ), " `id` = '".$kiemtra['id']."' ");
                                                echo '<meta http-equiv="refresh" content="1;url=">';//load lại trang
                                            }
                                            else
                                            {
                                                nnl_error_time("Không thể xử lý giao dịch vui lòng thử lại", BASE_URL('Pk'), 2000);
                                            }
                                       }
                                        
                                    
                                    $i = 0; foreach($NNL->get_list(" SELECT * FROM `pk` WHERE `user` = '".$getUser['username']."' ORDER BY id DESC ") as $pk){ ?>
                <tr>
                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><?=$i++;?></td>
                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
                        <?=$pk['phong'];?></td>
                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
                        <?=$pk['nv'];?></td>

                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
                        <?=format_cash($pk['cuoc']);?> VNĐ</td>
                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
                        <?php if($pk['type'] == 'ngaunhien') { echo 'Solo ngẫu nhiên';} else { echo 'Solo tướng';};?>
                    </td>
                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
                        <?=$pk['tuong'];?></td>
                    <td class="text-sm text-red-500 text-left px-1 py-1 border-b">
                        <?=$pk['nguoinhan'];?></td>
                   
                    <td class="text-sm text-gray-800 text-center px-1 py-1 border-b"><span
                            class="badge badge-danger"><?php if($pk['ketqua'] ==0) { echo '<span class="loader"></span>';} else if($pk['ketqua'] ==1) { echo '<span
                                                class="py-1 px-3 bg-green-600 text-white rounded">Bạn thắng</span>';} else if($pk['ketqua'] ==3) { echo '<span
                                                    class="py-1 px-3 bg-red-600 text-white rounded">Đã hủy</span>';}else{ echo '<span
                                                    class="py-1 px-3 bg-red-600 text-white rounded">Bạn thua</span>';};?></span>
                    </td>
                    <td class="text-sm text-gray-800 text-center px-1 py-1 border-b"><span
                            class="badge badge-danger"><?php if($pk['status'] ==0) { echo '<span class="loader"></span>';} else if($pk['status'] ==1) { echo '<span
                                                class="py-1 px-3 bg-green-600 text-white rounded">Nhận kèo</span>';}else{ echo '<span
                                                    class="py-1 px-3 bg-red-600 text-white rounded">Đã hủy</span>';};?></span>
                    </td>
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
<script>
    $(document).ready(function() {
    $('#datatable').DataTable();
});
</script>