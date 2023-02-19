<?php
/**
 * @package Code api kiểm tra thông tin mã giao dịch
 *
 * @author Ske Software - Vinh Developer - Phạm Vinh ID
 */
include_once __DIR__.'/libs/simple_html_dom.php';
$access = true;
use SkeSoft\Thesieure;
$dom = new simple_html_dom();
include_once __DIR__.'/class/thesieure.php';
$TSR = new Thesieure;
if (isset($_POST['code'])) {
	// Kiểm tra mã giao dịch
	$Check = $TSR->CheckCode_GD($_POST['code']);
	// Nếu không hợp lệ hoặc lỗi
	if (!$Check) {
		header("Content-Type: application/json");
		die(json_encode(array(
			'status' => false,
			'msg' => 'Mã giao dịch không hợp lệ hoặc đăng nhập lỗi hoặc tài khoản không có lịch sử giao dịch, kiểm tra log để biết thêm thông tin'), JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
	} else {
		$Check = json_decode($Check);
		if (!isset($Check->money)) {
			header("Content-Type: application/json");
			die(json_encode(array(
				'status' => false,
				'error_msg' => 'Tài khoản này có lịch sử chuyển hoặc nhận tiền trống !'
			), JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
		} else {
			if (!preg_match('/-/i', $Check->money)) {
				header("Content-Type: application/json");
				die(json_encode(array(
					'status' => true,
					// Kiểu cộng tiền
					'type' => 'plus',
					// Số tiền được cộng
					'money' => intval(preg_replace("/đ|,|\-|\+/i", '', $Check->money)),
					// Username
					'user' => $Check->username_send_or_receive,
					// Nội dung chuyển / nhận tiền
					'content_send' => $Check->content_send,
					'msg' => $Check->msg), JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
			} else {
				header("Content-Type: application/json");
				die(json_encode(array(
					'status' => true,
					// Kiểu trừ tiền
					'type' => 'minus',
					// Số tiền bị trừ
					'money' => intval(preg_replace("/đ|,|\-|\+/i", '', $Check->money)),
					// Username
					'user' => $Check->username_send_or_receive,
					// Nội dung chuyển / nhận tiền
					'content_send' => $Check->content_send,
					'msg' => $Check->msg), JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
			}
		}
	}
} else {
	die('Vui lòng nhập mã giao dịch ở ?code=mã giao dịch');
}