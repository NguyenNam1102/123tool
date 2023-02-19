<?php
if (file_exists('class/session.txt')) {
	error_reporting(0);
	unlink('class/session.txt');
	unlink('class/session.txt');
	unlink('class/session.txt');
	unlink('class/session.txt');
	die('Xóa cookie thành công !');
} else {
	die('Không có cookie để xóa !');
}