<?php
/**
 * @package Code api thẻ siêu rẻ check lịch sử giao dịch
 *
 * @author Ske Software - Vinh Developer - Phạm Vinh ID
 */
include_once __DIR__.'/libs/simple_html_dom.php';
$access = true;
use SkeSoft\Thesieure;
$dom = new simple_html_dom();
include_once __DIR__.'/class/thesieure.php';
$TSR = new Thesieure;
if ($TSR->Get_LSGD('check')) {
    // Tìm dữ liệu
    $a = $TSR->Get_LSGD('get');
    echo $a;
    $Get_Table = str_get_html($TSR->Get_LSGD('get'))->find('tbody', 1);
    if (empty($Get_Table->nodes)) {
        header("Content-Type: application/json");
        die(json_encode(array(
            'status_api' => false,
            'error_msg' => 'Tài khoản này có lịch sử chuyển hoặc nhận tiền trống !'
        ), JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
    } else {
        header("Content-Type: application/json");
        // Xuất dữ liệu
        foreach ($Get_Table->find('tr') as $Data) {
            $Json_Datas[] = array(
                    // Trạng thái trả về
                    'status_api' => true,
                    // Mã giao dịch
                    'trading_code' => $Data->find('td', 0)->plaintext,
                    // Số tiền thêm hoặc trừ
                    'money_cost' => $Data->find('td', 1)->plaintext,
                    // Người gửi hoặc người nhận
                    'username_send_or_receive' => $Data->find('td', 2)->plaintext,
                    // Thời gian tạo
                    'time_created' => $Data->find('td', 3)->plaintext,
                    // Trạng thái
                    'status' => $Data->find('td', 4)->plaintext,
                    // Nội dung chuyển tiền
                    'content_send' => $Data->find('td', 5)->plaintext
                );
        }
        echo(json_encode($Json_Datas, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
    }
} else {
    header("Content-Type: application/json");
        die(json_encode(array(
            'status_api' => false,
            'error_msg' => 'Đăng nhập thất bại! Vui lòng kiểm tra thesieure_log.log để biết thêm thông tin !'
        ), JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
}