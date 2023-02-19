<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'THAY ĐỔI MẬT KHẨU | '.$NNL->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
    CheckLogin();
?>
<div class="w-full max-w-6xl mx-auto pt-6 md:pt-8 pb-8">
    <div class="grid grid-cols-8 gap-4 md:p-4 bg-box-dark">
        <?php require_once('Sidebar.php');?>
        <div class="col-span-8 sm:col-span-5 md:col-span-6 lg:col-span-6 xl:col-span-6 px-2 md:px-0">
            <div class="v-bg w-full mb-5">
            <h2 class="v-title border-l-4 border-red-800 px-3 select-none text-white text-xl md:text-2xl font-bold">
                    ĐỔI MẬT KHẨU</h2>
                <div class="v-table-content">
                    <div class="py-3 pt-5">
                        <form accept-charset="UTF-8" class="form-charge">
                            <input id="password" type="password" placeholder="Mật khẩu mới" required="required"
                                class="mb-2 py-1 rounded-sm px-3 text-gray-800 focus:outline-none font-semibold border border-gray-500 bg-white" />
                            <input id="repassword" type="password" placeholder="Nhập lại mật khẩu mới" required="required"
                                class="mb-2 py-1 rounded-sm px-3 text-gray-800 focus:outline-none font-semibold border border-gray-500 bg-white" />
                            <button type="button" id="DoiMatKhau"
                                class="py-1 text-white border border-red-600 px-3 bg-red-600 hover:bg-red-500 hover:border-red-500 font-semibold focus:outline-none"
                                data-loading-text="<box-icon name='loader'></box-icon>">
                                ĐỔI MẬT KHẨU
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
$("#DoiMatKhau").on("click", function() {
    $('#DoiMatKhau').html('ĐANG XỬ LÝ').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/Auth.php");?>",
        method: "POST",
        data: {
            type: 'DoiMatKhau',
            password: $("#password").val(),
            repassword: $("#repassword").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#DoiMatKhau').html(
                    'ĐỔI MẬT KHẨU')
                .prop('disabled', false);
        }
    });
});
</script>
<?php 
    require_once("../../public/client/Footer.php");
?>