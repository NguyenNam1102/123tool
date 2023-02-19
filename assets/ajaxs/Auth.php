<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once('../../class/class.smtp.php');
    require_once('../../class/PHPMailerAutoload.php');
    require_once('../../class/class.phpmailer.php');

    if($_POST['type'] == 'Login' )
    {
        $username = check_string($_POST['username']);
        $password = sha1(check_string($_POST['password']));
        if(empty($username))
        {
           nnl_error("Vui lòng nhập tên đăng nhập !");
        }
        if(!$NNL->get_row(" SELECT * FROM `users` WHERE `username` = '$username' "))
        {
            nnl_error("Tên đăng nhập không tồn tại !");
        }
        if(empty($password))
        {
            nnl_error("Vui lòng nhập mật khẩu !");
        }
        if($NNL->get_row(" SELECT * FROM `users` WHERE `username` = '$username' AND `banned` = '1' "))
        {
            nnl_error("Tài khoản này đã bị khóa bởi BQT !");
        }
        if(!$NNL->get_row(" SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password' "))
        {
            nnl_error("Mật khẩu đăng nhập không chính xác!");
        }
        $NNL->update("users", [
            'otp' => NULL
        ], " `username` = '$username' ");
        $_SESSION['username'] = $username;
        nnl_success_time('Đăng nhập thành công ', BASE_URL(''), 300);
    }

    if($_POST['type'] == 'Register' )
    {
        $username = check_string($_POST['username']);
        $password = sha1(check_string($_POST['password']));
        $email = check_string($_POST['email']);
        if(empty($username))
        {
            nnl_error("Vui lòng nhập tên tài khoản !");
        }
        if(check_username($username) != True)
        {
            nnl_error('Vui lòng nhập định dạng tài khoản hợp lệ');
        }
        if(strlen($username) < 5 || strlen($username) > 64)
        {
            nnl_error('Tài khoản phải từ 5 đến 64 ký tự');
        }
        if($NNL->get_row(" SELECT * FROM `users` WHERE `username` = '$username' "))
        {
            nnl_error('Tên đăng nhập đã tồn tại!');
        }
        if(empty($password))
        {
            nnl_error("Vui lòng nhập mật khẩu !");
        }
        if(empty($email))
        {
            nnl_error("Vui lòng nhập email!");
        }
        if($NNL->get_row(" SELECT * FROM `users` WHERE `email` = '$email' "))
        {
            nnl_error('Email đã tồn tại!');
        }
        if(strlen($password) < 3)
        {
            nnl_error('Vui lòng đặt mật khẩu trên 3 ký tự');
        }
        if($NNL->num_rows(" SELECT * FROM `users` WHERE `ip` = '".myip()."' ") > 3)
        {
            nnl_error('Bạn đã đạt giới hạn tạo tài khoản');
        }
        $create = $NNL->insert("users", [
            'username'      => $username,
            'email'         => $email,
            'password'      => TypePassword($password),
            'token'         => random('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM', 64),
            'money'         => 0,
            'total_money'   => 0,
            'banned'        => 0,
            'ip'            => myip(),
            'time'          => time(),
            'createdate'    => gettime()
        ]);
        if ($create)
        {   
            $_SESSION['username'] = $username;
            nnl_success_time('Tạo tài khoản thành công', BASE_URL(''), 1000);
        }
        else
        {
            nnl_error('Vui lòng kiểm tra cấu hình DATABASE');
        }
    }


    if($_POST['type'] == 'ForgotPassword' )
    {
        $email = check_string($_POST['email']);
        if(empty($email))
        {
            nnl_error("Vui lòng nhập địa chỉ email vào ô trống");
        }
        if(check_email($email) != True) 
        {
            nnl_error('Vui lòng nhập địa chỉ email hợp lệ');
        }
        $row = $NNL->get_row(" SELECT * FROM `users` WHERE `email` = '$email' ");
        if(!$row)
        {
            nnl_error('Địa chỉ email không tồn tại trong hệ thống');
        }
        $otp = random('0123456789', '6');
        $NNL->update("users", array(
            'otp' => $otp
        ), " `id` = '".$row['id']."' " );
        $guitoi = $email;   
        $subject = 'XÁC NHẬN KHÔI PHỤC MẬT KHẨU';
        $bcc = $NNL->site('tenweb');
        $hoten ='Client';
        $noi_dung = '<h3>Có ai đó vừa yêu cầu khôi phục lại mật khẩu bằng Email này, nếu là bạn vui lòng nhập mã xác minh phía dưới để xác minh tài khoản</h3>
        <table>
        <tbody>
        <tr>
        <td style="font-size:20px;">OTP:</td>
        <td><b style="color:blue;font-size:30px;">'.$otp.'</b></td>
        </tr>
        </tbody>
        </table>';
        Locdz_Email($guitoi, $hoten, $subject, $noi_dung, $bcc);   
        nnl_success_time('Chúng tôi đã gửi mã xác minh vào địa chỉ Email của bạn !', BASE_URL('ChangePassword'), 4000);
    }

    if($_POST['type'] == 'ChangePassword')
    {
        $otp = check_string($_POST['otp']);
        $repassword = check_string($_POST['repassword']);
        $password = sha1(check_string($_POST['password']));
        if(empty($otp))
        {
            nnl_error("Bạn chưa nhập OTP");
        }
        if(empty($password))
        {
            nnl_error("Bạn chưa nhập mật khẩu mới");
        }
        if(empty($repassword))
        {
            nnl_error("Vui lòng xác minh lại mật khẩu");
        }
        if(isset($_SESSION['countVeri']))
        {
            if($_SESSION['countVeri'] >= 3)
            {
                nnl_error("Chức năng này tạm khóa");
            }
        }
        else
        {
            $_SESSION['countVeri'] = 0;
        }
        $row = $NNL->get_row(" SELECT * FROM `users` WHERE `otp` = '$otp' ");
        if(!$row)
        {
            $_SESSION['countVeri'] = $_SESSION['countVeri'] + 1;
            nnl_error("OTP không tồn tại trong hệ thống");
        }
        if($password != $repassword)
        {
            nnl_error("Nhập lại mật khẩu không đúng");
        }
        if(strlen($password) < 5)
        {
            nnl_error('Vui lòng nhập mật khẩu có ích nhất 5 ký tự');
        }
        $NNL->update("users", [
            'otp' => NULL,
            'password' => TypePassword($password)
        ], " `id` = '".$row['id']."' ");
    
        nnl_success("Mật khẩu của bạn đã được thay đổi thành công !");
    }

    if($_POST['type'] == 'DoiMatKhau')
    {
        if($NNL->site('status_demo') == 'ON')
        {
            nnl_error("Chức năng này không khả dụng trên trang web DEMO!");
        }
        $repassword = sha1(check_string($_POST['repassword']));
        $password = sha1(check_string($_POST['password']));
        if(empty($password))
        {
            nnl_error("Bạn chưa nhập mật khẩu mới");
        }
        if(empty($repassword))
        {
            nnl_error("Vui lòng xác minh lại mật khẩu");
        }
        if($password != $repassword)
        {
            nnl_error("Nhập lại mật khẩu không đúng");
        }
        if(strlen($password) < 5)
        {
            nnl_error('Vui lòng nhập mật khẩu có ích nhất 5 ký tự');
        }
        $row = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."' ");
        if(!$row)
        {
            nnl_error("Vui lòng đăng nhập!", BASE_URL(''), 2000);
        }
        $NNL->update("users", [
            'otp' => NULL,
            'password' => TypePassword($password)
        ], " `id` = '".$row['id']."' ");
        nnl_success_time("Mật khẩu của bạn đã được thay đổi thành công !", "", 1000);
    }
    if($_POST['type'] == 'DoiKey')
    {
        if($NNL->site('status_demo') == 'ON')
        {
            nnl_error("Chức năng này không khả dụng trên trang web DEMO!");
        }
        $key = check_string($_POST['key']);
        $id = check_string($_POST['id']);
        if(empty($key))
        {
            nnl_error("Bạn chưa nhập key mới");
        }
        $row = $NNL->get_row(" SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."' ");
        if(!$row)
        {
            nnl_error("Vui lòng đăng nhập!", BASE_URL(''), 2000);
        }
        $tool = $NNL->get_row(" SELECT * FROM `license` WHERE `id` = '$id' AND `user`='".$row['username']."' ");
        if(!$tool)
        {
            nnl_error("Không tồn tại!", BASE_URL(''), 2000);
        }
        
        $NNL->update("license", [
            'keytool' => $key
        ], " `id` = '".$tool['id']."' ");
        nnl_success_time("Key của bạn đã được thay đổi thành công !",  BASE_URL('HistoryTool'), 1000);
    }