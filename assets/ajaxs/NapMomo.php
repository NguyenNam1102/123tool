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
nnl_error("Momo đang bảo trì vui lòng ib cskh để được hỗ trợ!");
return;
$post = [
    'api_key' => $api_key,
    'token' => $token,
];

$ch = curl_init('https://sieuthicode.net/apimomo/checkTranId');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$response = curl_exec($ch);
curl_close($ch);
$json = json_decode($response);
// đổ tất cả giao dịch vào mảng
    $array=[];
    foreach ($json as $locdz)
    {
            $array[] = [
                'tranId' => $locdz->tranId,
                'amount' => $locdz->amount,
              ];
    }
    //hàm check mã giao dịch
    function check_magd($array,$giatri)
    {
        for($i=0;$i<sizeof($array);$i++)
        {
            if($array[$i]['tranId']==$giatri)
            {
                return $array[$i];
            }
        }
            return null;
    }
    $giatri=$magd;//nhập mã giao dịch cần check
    $flag=check_magd($array,$giatri);
    if($flag)
    {
        //nếu tồn tại mã giao dịch thì thực hiện cộng tiền
        $magd= $flag['tranId'];
        $sotien = explode(".", $flag["amount"]);
        $tien = $sotien[0];//tiền đã đc format
        $thucnhan=$tien + ($tien/100*$km_momo);
		$row = $NNL->get_row(" SELECT * FROM `momo` WHERE `magd` = '$magd' ");
		if($row)
		{
			nnl_error("Mã này đã được nạp rồi");
		}
		$NNL->insert("dongtien", array(
			'sotientruoc'   => $getUser['money'],
			'sotienthaydoi' => $thucnhan,
			'sotiensau'     => $getUser['money']+$thucnhan,
			'thoigian'      => gettime(),
			'noidung'       => 'Nạp qua ví momo',
			'username'      => $getUser['username']
		));
		$create = $NNL->insert("momo", [
            'user'      => $userST,
            'magd'         => $magd,
            'price'      =>  $tien,
            'thucnhan'  =>$thucnhan,
            'khuyenmai' =>$km_momo,
            'content'         => null,
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