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
                QUÊN MẬT KHẨU
            </div>
            <div class="border-t border-gray-600 w-32 mx-auto mt-1"></div>
            <div id="thongbao"></div>
            <span>
                <div class="mt-4">
                    <label class="block text-white text-sm font-semibold mb-1">Nhập email của bạn cần khôi
                        phục</label>
                    <input type="text" placeholder="Nhập email" id="email"
                        class="border border-gray-400 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">
                    <span class="mt-1 flex items-center font-semibold tracking-wide text-red-500 text-xs"></span>
                </div>
            </span>

            <div class="mt-4 mb-2 flex justify-center flex-col">
                <button type="button" id="ForgotPassword"
                    class="focus:outline-none h-10 bg-blue-600 text-white flex items-center justify-center rounded w-full p-1 px-8 text-xl">
                    Xác Thực
                </button>

            </div>
        </form>
    </div>
</div>
</div>


<script type="text/javascript">
$("#ForgotPassword").on("click", function() {

    $('#ForgotPassword').html('ĐANG XỬ LÝ').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/Auth.php");?>",
        method: "POST",
        data: {
            type: 'ForgotPassword',
            email: $("#email").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#ForgotPassword').html(
                    'Xác minh ngay')
                .prop('disabled', false);
        }
    });
});
</script>


<?php 
    require_once("../../public/client/Footer.php");
?>