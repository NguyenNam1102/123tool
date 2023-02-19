<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    if(isset($_POST['id']))
    {
        $id = check_string($_POST['id']);
        if(empty($_SESSION['username']))
        {
            nnl_error("Vui lòng đăng nhập để thanh toán !");
        }
        $row = $NNL->get_row(" SELECT * FROM `tool` WHERE `tool_id` = '$id'  ");
        if(!$row)
        {
            nnl_error("Tool này không tồn tại trong hệ thống.");
        }
        $giamgia = 0;
		$magiamgia = $_POST['magiamgia'];
		$check_giam_gia = $NNL->get_row("SELECT * FROM `giftcode` WHERE `code` = '$magiamgia' and `status`=0");
        if($check_giam_gia)
        {
            $info_giamgia = $check_giam_gia;
            $giamgia = $info_giamgia['phantram'];
        }
		$tien = $row['price'] - ($row['price'] / 100 * $giamgia);
        if($tien > $getUser['money'])
        {
            nnl_error("Số dư không đủ vui lòng nạp thêm.");
        }
        if(!empty($_POST['magiamgia']))
        {
            if($check_giam_gia)
            {
                if($info_giamgia['soluong'] <= 1)
				{
                    $NNL->update("giftcode", [
                        'status'      => '1',
                        'soluong'    => '0'
                    ], " `id` = '".$info_giamgia['id']."' ");
				} 
				else
				{
                    $NNL->update_quantity("giftcode"," `id` = '". $info_giamgia['id']."' ");
				}

                $isMoney = $NNL->tru("users", "money", $tien, " `username` = '".$getUser['username']."' ");
                if($isMoney)
                {
                    /* GHI LOG DÒNG TIỀN */
                    $NNL->insert("dongtien", array(
                        'sotientruoc'   => $getUser['money'],
                        'sotienthaydoi' => -$row['price'],
                        'sotiensau'     => $getUser['money']-$row['price'],
                        'thoigian'      => gettime(),
                        'noidung'       => 'Mua tool (#'.$row['toolname'].')',
                        'username'      => $getUser['username']
                    ));
                   
                    $NNL->insert("license", array(
                    'user'   => $getUser['username'],
                    'tool_id' => $row['tool_id'],
                    'nameTool'     => $row['toolname'],
                    'bidanh'      =>  $row['bidanh'],
                    'price'       =>  $row['price'],
                    'keytool'      => 'Điền key của bạn vào đây',
                    'day'      => 30,
                    'link'=>$row['link']
                ));
                     $NNL->update("tool", [
                        'daban'      => $row['daban']+1
                      
                    ], " `tool_id` = '".$row['tool_id']."' ");
                    nnl_success_time("Thanh toán thành công!", BASE_URL("HistoryTool"), 1000);
                }
            }
            else
            {
                nnl_error('Mã giảm giá không tồn tại');
            }
                            
        }
        else
        {
            $isMoney = $NNL->tru("users", "money", $tien, " `username` = '".$getUser['username']."' ");
            if($isMoney)
            {
                /* GHI LOG DÒNG TIỀN */
                $NNL->insert("dongtien", array(
                    'sotientruoc'   => $getUser['money'],
                    'sotienthaydoi' => -$row['price'],
                    'sotiensau'     => $getUser['money']-$row['price'],
                    'thoigian'      => gettime(),
                    'noidung'       => 'Mua tool (#'.$row['toolname'].')',
                    'username'      => $getUser['username']
                ));

                $NNL->insert("license", array(
                    'user'   => $getUser['username'],
                    'tool_id' => $row['tool_id'],
                    'nameTool'     => $row['toolname'],
                    'bidanh'      =>  $row['bidanh'],
                    'price'       =>  $row['price'],
                    'keytool'      => 'Điền key của bạn vào đây',
                    'day'      => 30,
                    'link'=>$row['link']
                ));
                 $NNL->update("tool", [
                        'daban'      => $row['daban']+1
                      
                    ], " `tool_id` = '".$row['tool_id']."' ");
                nnl_success_time("Thanh toán thành công!", BASE_URL("HistoryTool"), 1000);
            }
        }
    }