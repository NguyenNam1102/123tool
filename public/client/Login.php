<?php
        require_once("../../config/config.php");
        require_once("../../config/function.php");
        $title = 'ĐĂNG NHẬP | '.$NNL->site('tenweb');
        require_once("../../public/client/Header.php");
        require_once("../../public/client/Nav.php");
?>
<div class="flex justify-center items-center px-4 py-8 md:px-0 md:py-0" style="height: calc(100vh - 80px)">
    <div class="w-full max-w-sm">
        <form class="w-full border border-gray-400 shadow rounded bg-black py-4 px-6 f-register">
            <div class="text-white text-center text-2xl font-extrabold">
                ĐĂNG NHẬP TÀI KHOẢN
            </div>
            <div class="border-t border-gray-600 w-32 mx-auto mt-1"></div>
            <div id="thongbao"></div>
            <span>
                <div class="mt-4">
                    <label class="block text-white text-sm font-semibold mb-1">Tên tài khoản</label>
                    <input type="text" placeholder="Nhập tài khoản" id="username"
                        class="border border-gray-400 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">
                    <span class="mt-1 flex items-center font-semibold tracking-wide text-red-500 text-xs"></span>
                </div>
            </span>

            <span>
                <div class="my-2">
                    <label class="block text-white text-sm font-semibold mb-1">Mật khẩu</label>
                    <input autocomplete="" type="password" id="password" placeholder="Nhập mật khẩu"
                        class="border border-gray-400 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">
                    <span class="mt-1 flex items-center font-semibold tracking-wide text-red-500 text-xs"></span>
                </div>
            </span>

            <span>
                <div class="my-2">
                    <a href="<?=BASE_URL('ForgotPassword');?>" class="block text-white text-sm font-semibold mb-1">Quên
                        mật khẩu</a>
                </div>
            </span>

            <div class="mt-4 mb-2 flex justify-center flex-col">
                <button type="button" id="Login"
                    class="focus:outline-none h-10 bg-red-600 text-white flex items-center justify-center rounded w-full p-1 px-8 text-xl">
                    Đăng Nhập
                </button>
                <a href="<?=BASE_URL('Register');?>"
                    class="mt-2 py-1 rounded border border-gray-400 bg-white text-gray-800 text-xl flex items-center justify-center relative"><i
                        class="absolute bx bxs-user-plus" style="left: 10px; top: 9px;"></i> Tạo Tài Khoản</a>
            </div>
        </form>
    </div>
</div>
</div>
<script type="text/javascript">
$("#Login").on("click", function() {

    $('#Login').html('Đang xử lý...').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/Auth.php");?>",
        method: "POST",
        data: {
            type: 'Login',
            username: $("#username").val(),
            password: $("#password").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#Login').html(
                    'Đăng Nhập ')
                .prop('disabled', false);
        }
    });
});
</script>


<?php 
    require_once("../../public/client/Footer.php");
?>