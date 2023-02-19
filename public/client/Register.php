<?php
        require_once("../../config/config.php");
        require_once("../../config/function.php");
        $title = 'TẠO TÀI KHOẢN | '.$NNL->site('tenweb');
        require_once("../../public/client/Header.php");
        require_once("../../public/client/Nav.php");
?>

<div class="flex justify-center items-center px-4 py-8 md:px-0 md:py-0" style="height: calc(100vh - 80px)">
    <div class="w-full max-w-sm">
        <form class="w-full border border-gray-400 shadow rounded bg-black py-4 px-6 f-register">
            <div class="text-white text-center text-2xl font-extrabold">
                ĐĂNG KÝ TÀI KHOẢN
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
                    <label class="block text-white text-sm font-semibold mb-1">Email</label>
                    <input autocomplete="" type="text" id="email" placeholder="Nhập email"
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

            <div class="mt-4 mb-2 flex justify-center flex-col">
                <button type="button" id="Register"
                    class="focus:outline-none h-10 bg-red-600 text-white flex items-center justify-center rounded w-full p-1 px-8 text-xl">
                    Đăng Ký
                </button>
                <a href="<?=BASE_URL('Login');?>"
                    class="mt-2 py-1 rounded border border-gray-400 bg-white text-gray-800 text-xl flex items-center justify-center relative"><i
                        class="absolute bx bxs-user-plus" style="left: 10px; top: 9px;"></i> Đăng Nhập</a>
            </div>
        </form>
    </div>
</div>
</div>
<script type="text/javascript">
$("#Register").on("click", function() {

    $('#Register').html('Đang xử lý...').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/Auth.php");?>",
        method: "POST",
        data: {
            type: 'Register',
            username: $("#username").val(),
            password: $("#password").val(),
            email: $("#email").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#Register').html(
                    'Đăng Ký')
                .prop('disabled', false);
        }
    });
});
</script>


<?php 
    require_once("../../public/client/Footer.php");
?>