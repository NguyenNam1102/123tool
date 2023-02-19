<?php
    require_once("../config/config.php");
    require_once("../config/function.php");


    /* ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO 0947838128 | FB.COM/NTGTANETWORK */
    if($CMSNT->site('api_bank') == '')
    {
        die('Thiếu API');
    }
    if(time() - $CMSNT->site('check_time_cron_bank') < 30)
    {
        die('Không thể cron vào lúc này!');
    }
    $CMSNT->update("options", [
        'value' => time()
    ], " `name` = 'check_time_cron_bank' ");
    
    $token = $CMSNT->site('api_bank');
    $stk = $CMSNT->site('stk_bank');
    $mk = $CMSNT->site('mk_bank');
    $result = curl_get("https://api.web2m.com/historyapivcb/$mk/$stk/$token");
    $result = json_decode($result, true);
    if($result['status'] != true)
    {
        die('Lấy dữ liệu thất bại');
    }
    foreach($result['data']['ChiTietGiaoDich'] as $data)
    {
        $des = $data['MoTa'];
        $amount = str_replace(',' ,'', $data['SoTienGhiCo']);
        $tid = $data['SoThamChieu'];
        $id = parse_order_id($des);
        
        $file = @fopen('LogBank.txt', 'a');
        if ($file)
        {
            $data = "tid => $tid description => $des ($id) amount => $amount ".PHP_EOL;
            fwrite($file, $data);
        }
        if ($id)
        {
            $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '$id' ");
            if($row['username'])
            {
                if($CMSNT->num_rows(" SELECT * FROM `bank_auto` WHERE `tid` = '$tid' ") == 0)
                {
                    /* GHI LOG BANK AUTO */
                    $create = $CMSNT->insert("bank_auto", array(
                        'tid' => $tid,
                        'description' => $des,
                        'amount' => $amount,
                        'time' => gettime(),
                        'username' => $row['username']
                        ));
                    if ($create)
                    {
                        $real_amount = $amount + $amount * $CMSNT->site('ck_bank') / 100;
                        $isCheckMoney = $CMSNT->cong("users", "money", $real_amount, " `username` = '".$row['username']."' ");
                        if($isCheckMoney)
                        {
                            $CMSNT->cong("users", "total_money", $real_amount, " `username` = '".$row['username']."' ");
                            /* GHI LOG DÒNG TIỀN */
                            $CMSNT->insert("dongtien", array(
                                'sotientruoc' => $row['money'],
                                'sotienthaydoi' => $real_amount,
                                'sotiensau' => $row['money'] + $real_amount,
                                'thoigian' => gettime(),
                                'noidung' => 'Nạp tiền tự động ngân hàng (Vietcombank | '.$tid.')',
                                'username' => $row['username']
                            ));
                        }
                    }
                }
            }
        }    
    }

