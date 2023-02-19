<?php
        require_once("../../config/config.php");
        require_once("../../config/function.php");
        $title = 'ĐĂNG NHẬP | '.$NNL->site('tenweb');
        require_once("../../public/client/Header.php");
        require_once("../../public/client/Nav.php");
?>

<div class="flex justify-center items-center px-4 py-8 md:px-0 md:py-0" style="height: calc(100vh - 80px)">
    <div class="w-full max-w-sm">
        <form class="w-full border border-gray-400 shadow rounded bg-black py-4 px-6">
            <div class="text-white text-center text-2xl font-extrabold">
                KHÔI PHỤC MẬT KHẨU
            </div>
            <div class="border-t border-gray-600 w-32 mx-auto mt-1"></div>
            <div id="thongbao"></div>
            <span>
                <div class="mt-4">
                    <label class="block text-white text-sm font-semibold mb-1">OTP</label>
                    <input type="text" placeholder="Nhập OTP" id="otp"
                        class="border border-gray-400 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">
                    <span class="mt-1 flex items-center font-semibold tracking-wide text-red-500 text-xs"></span>
                </div>
            </span>

            <span>
                <div class="my-2">
                    <label class="block text-white text-sm font-semibold mb-1">Mật khẩu mới</label>
                    <input autocomplete="" type="password" id="password" placeholder="Nhập mật khẩu mới"
                        class="border border-gray-400 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">
                    <span class="mt-1 flex items-center font-semibold tracking-wide text-red-500 text-xs"></span>
                </div>
            </span>

            <span>
                <div class="my-2">
                    <label class="block text-white text-sm font-semibold mb-1">Nhập lại mật khẩu</label>
                    <input autocomplete="" type="password" id="repassword" placeholder="Nhập lại mật khẩu"
                        class="border border-gray-400 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">
                    <span class="mt-1 flex items-center font-semibold tracking-wide text-red-500 text-xs"></span>
                </div>
            </span>


            <div class="mt-4 mb-2 flex justify-center flex-col">
                <button type="button" id="ChangePassword"
                    class="focus:outline-none h-10 bg-green-600 text-white flex items-center justify-center rounded w-full p-1 px-8 text-xl">
                    Xác Nhận
                </button>
             
            </div>
        </form>
    </div>
</div>
</div>



<script type="text/javascript">
$("#ChangePassword").on("click", function() {

    $('#ChangePassword').html('ĐANG XỬ LÝ').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/Auth.php");?>",
        method: "POST",
        data: {
            type: 'ChangePassword',
            otp: $("#otp").val(),
            password: $("#password").val(),
            repassword: $("#repassword").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#ChangePassword').html(
                    'Đổi mật khẩu')
                .prop('disabled', false);
        }
    });
});
</script>
<?php 
    require_once("../../public/client/Footer.php");
?>