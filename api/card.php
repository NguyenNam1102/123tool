<?php
    require_once("../config/config.php");
    require_once("../config/function.php");


    if ( isset($_GET['content']) && isset($_GET['status']) )
    {
        $code = check_string($_GET['content']);
        $row = $CMSNT->get_row(" SELECT * FROM `cards` WHERE `code` = '$code' AND `status` = 'xuly' ");
        $thucnhan = $row['menhgia'];
        if ($_GET['status'] == 'hoantat')
        {
            /* CẬP NHẬT TRẠNG THÁI THẺ CÀO */
            $CMSNT->update("cards", array(
                'status'    => 'thanhcong',
                'thucnhan'  => $thucnhan
            ), " `id` = '".$row['id']."' ");

            $row_user = $CMSNT->get_row(" SELECT * FROM `users` WHERE `username` = '".$row['username']."' ");

            /* CỘNG TIỀN USER */
            $CMSNT->cong("users", "money", $thucnhan, " `id` = '".$row_user['id']."' ");
            $CMSNT->cong("users", "total_money", $thucnhan, " `id` = '".$row_user['id']."' ");
            /* GHI LOG DÒNG TIỀN */
            $CMSNT->insert("dongtien", array(
                'sotientruoc' => $row_user['money'] + $thucnhan,
                'sotienthaydoi' => $thucnhan,
                'sotiensau' => $row_user['money'],
                'thoigian' => gettime(),
                'noidung' => 'Nạp tiền tự động qua thẻ cào seri ('.$row['seri'].')',
                'username' => $row_user['username']
            ));
        }
        else if ($_GET['status'] == 'thatbai')
        {
            /* CẬP NHẬT TRẠNG THÁI THẺ CÀO */
            $CMSNT->update("cards", array(
                'status'    => 'thatbai',
                'thucnhan'  => '0'
            ), " `id` = '".$row['id']."' ");

        }
    }
    else
    {   
        echo json_encode(array('status' => "error", 'msg' => "Cái quát đờ phắc gì vậy?"));
    }

