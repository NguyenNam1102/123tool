<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'NẠP ATM/MOMO TỰ ĐỘNG| '.$NNL->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
    CheckLogin();
?>

<div class="w-full max-w-6xl mx-auto pt-6 md:pt-8 pb-8">
    <div class="grid grid-cols-8 gap-4">
        <?php require_once('Sidebar.php');?>
        <div class="col-span-8 sm:col-span-5 md:col-span-6 lg:col-span-6 xl:col-span-6 px-2 md:px-0">
            <div class="w-full mb-10">
                <h2
                    class="v-title uppercase border-l-4 border-gray-800 px-3 select-none text-gray-800 text-xl md:text-2xl font-bold">
                    TẠO YÊU CẦU SOLO LIÊN QUÂN MOBILE
                </h2>
                <div class="mt-4 text-gray-900">
                    <div class="p-2 border border-gray-300 mb-4">
                        <div class="flex justify-between items-center cursor-pointer">
                            <div class="flex select-none"><img src="<?=BASE_URL('assets/img/');?>pk.jpg"
                                    class="h-10 w-10 rounded">
                                <div class="ml-2 text-left">
                                    <h2 class="font-bold text-base">
                                        PK Liên Quân
                                    </h2>
                                    <p class="text-xs">Trải nghiệm sự hấp dẫn</p>
                                </div>
                            </div> <button
                                class="select-none focus:outline-none bg-pink-600 text-white text-xs inline-block h-5 flex items-center justify-center font-semibold px-2 rounded">
                                Auto
                            </button>
                        </div>
                        <div class="border-t border-gray-200 mt-2 p-2 select-text">
                            <div class="relative">
                                <p><span class="text-big" style="color: rgb(153, 77, 230);"><strong>*Gửi yêu cầu solo - Tự động hoàn tiền trong 10p khi không có phản hồi</strong></span></p>
                            </div>
                        </div>
                        <span>
                            <form method="POST" class="w-full">
                                <div class="py-3 px-5">
                                    <span class="mb-2 block">
                                        <div class="flex items-center relative">
                                            <select id="loaipk" onchange="getTypeSolo(this)"
                                                class="border border-gray-500 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">
                                            </select>
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    class="fill-current h-4 w-4">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </span>
                                    <div id="typeSolo"></div>

                                    <div class="mt-4 text-center">
                                        <button type="button" id="Yc"
                                            class="uppercase flex w-40 font-semibold rounded items-center justify-center h-10 text-white text-xl rounded-none focus:outline-none px-4 text-center bg-blue-500 hover:bg-red-600">
                                            Gửi Yêu Cầu
                                        </button>
                                    </div>
                                    <div class="mt-2 text-red-500 font-semibold text-sm">
                                    </div>
                                </div>
                            </form>
                        </span>

                    </div>
                    <h2
                        class="v-title border-l-4 border-gray-800 px-3 select-none text-gray-800 text-xl md:text-2xl font-bold">
                        TRẠNG THÁI
                    </h2>
                    <div id="output"></div>

                </div>
            </div>

        </div>
    </div>
</div>
</div>

<script type="text/javascript">
$("#Yc").on("click", function() {
    $('#Yc').html('ĐANG XỬ LÝ').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/Pk.php");?>",
        method: "POST",
        data: {
            tien: $("#price").val(),
            tuong: $("#tuong").val(),
            phong: $("#idphong").val(),
            loai: $("#loaipk").val(),
            tk: $("#tk").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#Yc').html(
                    'Yêu Cầu')
                .prop('disabled', false);
        }
    });
});

function getTypeSolo(obj) {
    var message = document.getElementById('typeSolo');
    var value = obj.value;
    if (value === '') {
        message.innerHTML = "Chưa chọn thể loại";
    } else if (value === 'ngaunhien') {
        $(document).ready(function() {
            setTimeout(e => {
                Ngaunhien()
            }, 0)
        });
    } else if (value === 'theotuong') {
        $(document).ready(function() {
            setTimeout(e => {
                Chontuong()
            }, 0)
        });
    }
}
$(document).ready(function() {
    setTimeout(e => {
        GetType()
    }, 0)
});

function Ngaunhien() {
    $.ajax({
        url: "<?=BASE_URL('api/ngaunhien.php');?>",
        method: "GET",
        success: function(response) {
            $("#typeSolo").html(response);
        }
    });
}

function Chontuong() {
    $.ajax({
        url: "<?=BASE_URL('api/chontuong.php');?>",
        method: "GET",
        success: function(response) {
            $("#typeSolo").html(response);
        }
    });
}

function GetType() {
    $.ajax({
        url: "<?=BASE_URL('api/typepk.php');?>",
        method: "GET",
        success: function(response) {
            $("#loaipk").html(response);
        }
    });
}
//realtime data
$(document).ready(function() {
    function getData() {
        $.ajax({
            method: "GET",
            url: "<?=BASE_URL('api/data.php');?>",
            success: function(data) {
                $('#output').html(data);
            }
        });
    }
    getData();
    setInterval(function() {
        getData();
    }, 10000);

});
</script>
<?php 
    require_once("../../public/client/Footer.php");
?>