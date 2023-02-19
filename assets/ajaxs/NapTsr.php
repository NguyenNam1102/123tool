<?php
    include "../../config/config.php";
    include "../../config/function.php";

	if(isset($_POST['magd'])&& isset($_SESSION['username'])){
        $userST=$_SESSION['username'];
        $magd=$_POST['magd'];
        if(empty($userST))
        {
            nnl_error("Vui lòng đăng nhập");
        }
        if(empty($magd))
        {
            nnl_error("Vui lòng điền mã giao dịch");
        }
      
}
$post = [
    'code' => $magd,
];
		$row = $NNL->get_row(" SELECT * FROM `thesieure` WHERE `magd` = '$magd' ");
		if($row)
		{
			nnl_error("Mã này đã được nạp rồi");
		}

$ch = curl_init('https://123tool.shop/tsr/checkcode.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$response = curl_exec($ch);
curl_close($ch);
$json = json_decode($response, true);
if($json == 'Mã giao dịch không hợp lệ hoặc đăng nhập lỗi hoặc tài khoản không có lịch sử giao dịch, kiểm tra log để biết thêm thông tin')
{
        nnl_error("Mã giao dịch không tồn tại");
        return;
}
    if($json['status'] == 'true')
    {
        //nếu tồn tại mã giao dịch thì thực hiện cộng tiền
        $sotien = $json["money"];
        $thucnhan=$sotien + ($sotien/100*$km_momo);
		$NNL->insert("dongtien", array(
			'sotientruoc'   => $getUser['money'],
			'sotienthaydoi' => $thucnhan,
			'sotiensau'     => $getUser['money']+$thucnhan,
			'thoigian'      => gettime(),
			'noidung'       => 'Nạp qua ví thẻ siêu rẻ',
			'username'      => $getUser['username']
		));
		$create = $NNL->insert("thesieure", [
            'user'      => $userST,
            'magd'         => $magd,
            'price'      =>  $sotien,
            'thucnhan'  =>$thucnhan,
            'khuyenmai' =>$km_momo,
            'content'         => $json["content_send"],
            'status'         => 2
        ]);
		$NNL->cong("users", "money", $thucnhan, " `username` = '$userST' ");
		nnl_success_time("Đã nạp thành công",BASE_URL('nap-tien'),1000);
    }
    else{
        nnl_error("Mã giao dịch không tồn tại");
    }
?>
?>