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
        $row = $NNL->get_row(" SELECT * FROM `vps` WHERE `id` = '$id'  ");
        if(!$row)
        {
            nnl_error("Vps này không tồn tại trong hệ thống.");
        }
		$tien = $row['price'];
        if($tien > $getUser['money'])
        {
            nnl_error("Số dư không đủ vui lòng nạp thêm.");
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
                        'noidung'       => 'Mua vps (#'.$row['name'].')',
                        'username'      => $getUser['username']
                    ));
                   
                    $NNL->insert("HistoryVps", array(
                        'username'   => $getUser['username'],
                        'name' => $row['name'],
                        'cpu'     => $row['cpu'],
                        'ram'      =>  $row['ram'],
                        'price'       =>  $row['price'],
                        'ip'=>NULL,
                        'taikhoan'=>NULL,
                        'matkhau'=>NULL   
                    ));
        
                    nnl_success_time("Thanh toán thành công!", BASE_URL("HistoryVps"), 1000);
                }
    }