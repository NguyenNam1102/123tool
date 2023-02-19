<?php
  require_once("../../config/config.php");
  require_once("../../config/function.php");
  if (isset($_GET['status']))
  {
        $callback_sign = md5($partner_key . $_GET['code'] . $_GET['serial']);
        if ($_GET['callback_sign'] == $callback_sign)
        {
            $status = $_GET['status'];
            $message = $_GET['message'];
            $tranid = $_GET['request_id']; /// Mã giao dịch của bạn
            $trans_id = $_GET['trans_id']; /// Mã giao dịch của website thesieure.com
            $declared_value = $_GET['declared_value']; /// Mệnh giá mà bạn khai báo lên
            $value = $_GET['value']; /// Mệnh giá thực tế của thẻ
            $thucnhan = $_GET['amount']; /// Số tiền bạn nhận về (VND)
            $code = $_GET['code']; /// Mã nạp
            $serial = $_GET['serial']; /// Serial thẻ
            $telco = $_GET['telco']; /// Nhà mạng
            if($status == 1) 
            {
                $nhan=$value-($value/100*$ck_the);
                $row = $NNL->get_row(" SELECT * FROM `cards` WHERE `code` = '$tranid' AND `status` = 'xuly'");
                $row_user = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '".$row['username']."' ");
                $isMoney = $NNL->cong("users", "money", $nhan, " `username` = '".$row_user['username']."'");
                $NNL->cong("users", "total_money", $nhan, " `username` = '".$row_user['username']."' ");
                $NNL->insert("dongtien", array(
                    'sotientruoc' => $row_user['money'],
                    'sotienthaydoi' => $nhan,
                    'sotiensau' => $row_user['money']+$nhan,
                    'thoigian' => gettime(),
                    'noidung' => 'Nạp tiền tự động qua thẻ cào seri ('.$row['seri'].')',
                    'username' => $row_user['username']
                ));
                $NNL->update("cards", [
                    'status' => 'thanhcong',
                    'thucnhan'  => $nhan
                ], " `code` = '$tranid' ");
            }
            else
            {
                $NNL->update("cards", [
                    'status' => 'thatbai'
                ], " `code` = '$tranid' ");
            }
        }
    }
?>