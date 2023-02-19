<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");

    $loaithe = check_string($_POST['loaithe']);
    $menhgia = check_string($_POST['menhgia']);
    $seri = check_string($_POST['seri']);
    $pin = check_string($_POST['pin']);

    if(empty($_SESSION['username']))
    {
        nnl_error("Vui lòng đăng nhập ", BASE_URL(''), 2000);
    }
    if(empty($loaithe))
    {
        nnl_error("Vui lòng chọn loại thẻ");
    }
    if(empty($menhgia))
    {
        nnl_error("Vui lòng chọn mệnh giá");
    }
    if(empty($seri))
    {
        nnl_error("Vui lòng nhập seri thẻ");
    }
    if(empty($pin))
    {
        nnl_error("Vui lòng nhập mã thẻ");
    }
    if (strlen($seri) < 5 || strlen($pin) < 5)
    {
        nnl_error("Mã thẻ hoặc seri không đúng định dạng!");
    }
    $code = random('qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM', 32);
    $data = card24h($NNL->site('api_card'), $loaithe, $menhgia, $seri, $pin, $code);
    if (isset($data['data']))
    {
        if ($data['data']['status'] == 'error')
        {
            nnl_error($data['data']['msg']);
        }
        if ($data['data']['status'] == 'success')
        {
            $NNL->insert("cards", array(
                'code' => $code,
                'seri' => $seri,
                'pin'  => $pin,
                'loaithe' => $loaithe,
                'menhgia' => $menhgia,
                'thucnhan' => '0',
                'username' => $getUser['username'],
                'status' => 'xuly',
                'note' => '',
                'createdate' => gettime()
            ));
            nnl_success_time("Gửi thẻ thành công, vui lòng đợi kết quả", "", 2000);
        }
    }
    else
    {
        nnl_error("Không thể nhập dữ liệu vào API");
    }