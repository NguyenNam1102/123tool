<?php
    require_once(__DIR__."/config/config.php");
    require_once(__DIR__."/config/function.php");
    $title = 'HOME | '.$NNL->site('tenweb');
    require_once(__DIR__."/public/client/Header.php");
    require_once(__DIR__."/public/client/Nav.php");
?>
<style>
.locchicken {
    background: rgba(255, 255, 255, 0.1);
    box-shadow: 20px 20px 50px rgba(0, 0, 0, 0.1);
}

.button_chicken {
    border: 1px #ef282b solid;
    color: red;
}

.button_chicken:hover {
    color: white;
}
</style>
<div class="v-theme">
    <div class="my-6">
        <div class="w-full max-w-6xl mx-auto relative block2">
            <div class="flex md:flex-row-reverse flex-wrap">
                <div class="w-full md:w-4/6 pb-0">
                    <div class="ml-0 border-trueGray">
                        <iframe src="https://youtube.com/embed/<?=$NNL->site('id_video_youtube');?>" frameborder="0" width="100%" height="350"
                            allowfullscreen=""></iframe>
                    </div>

                </div>
                <div class="w-full md:w-2/6">
                    <div class="bg-trueGray-800 w-full" style="min-height: 338px;">
                        <div class="flex color-grant font-bold">
                            <div class="cursor-pointer bg-trueGray-800 tablinks" onclick="Tab('nap')">
                                <h2 class="py-1 px-2 w-32 text-center title-grant font-extrabold text-xl md:text-2xl">
                                    NẠP THẺ
                                </h2>
                            </div>
                            <div class="cursor-pointer w-full bg-trueGray-900 tablinks" onclick="Tab('top')">
                                <h2 class="py-1 text-center px-3 title-grant font-extrabold text-xl md:text-2xl">
                                    TOP NẠP TIỀN </h2>
                            </div>
                        </div>
                        <span class="tabcontent" id="nap" style="display:block;">
                            <form class="w-full form-header">
                                <div class="py-3 px-5">
                                    <span class="mb-2 block">
                                        <div class="flex items-center relative">
                                            <select id="loaithe"
                                                class="border-2 rounded block w-full bg-trueGray-900 focus:border-yellow-500 focus:bg-trueGray-900 text-white appearance-none w-full py-2 px-3 leading-tight focus:outline-none border-trueGray-600">
                                            </select>
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-trueGray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    class="fill-current h-4 w-4">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </span>
                                    <span class="mb-2 block">
                                        <div class="flex items-center relative">
                                            <select id="menhgia"
                                                class="border-2 rounded block w-full bg-trueGray-900 focus:border-yellow-500 focus:bg-trueGray-900 text-white appearance-none w-full py-2 px-3 leading-tight focus:outline-none border-trueGray-600">
                                            </select>
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-trueGray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    class="fill-current h-4 w-4">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </span>
                                    <span class="mb-2 block">
                                        <div class="flex items-center relative">
                                            <input type="text" id="pin" placeholder="Mã số thẻ"
                                                class="border-2 rounded block w-full bg-trueGray-900 focus:border-yellow-500 focus:bg-trueGray-900 text-white appearance-none w-full py-2 px-3 leading-tight focus:outline-none border-trueGray-600" />
                                        </div>
                                    </span>
                                    <span class="mb-2 block">
                                        <div class="flex items-center relative">
                                            <input type="text" id="seri" placeholder="Số serial"
                                                class="border-2 rounded block w-full bg-trueGray-900 focus:border-yellow-500 focus:bg-trueGray-900 text-white appearance-none w-full py-2 px-3 leading-tight focus:outline-none border-trueGray-600" />
                                        </div>
                                    </span>
                                    <div class="mt-4">
                                        <button type="button" id="NapThe"
                                            class="homepayin uppercase flex items-center justify-center h-10 w-full ff-lalezar pt-1 text-2xl rounded focus:outline-none px-4 text-center btn-inner"
                                            style="color: rgb(51, 51, 51);">
                                            Nạp Ngay
                                        </button>
                                    </div>
                                    <div class="text-center mt-2 text-white font-semibold text-sm">
                                        Hãy chọn đúng mệnh giá. Sai sẽ mất thẻ
                                    </div>
                                </div>
                            </form>

                        </span>
                        <div class="tabcontent" id="top">
                            <div class="v-list-top-card py-1 mt-2 md:py-2 px-1 md:px-3">

                                <?php $i=0; foreach($NNL->get_list("SELECT * FROM `users` ORDER BY `total_money` DESC LIMIT 6 ") as $top) { ?>
                                <div class="flex items-center justify-between px-2 py-1">
                                    <div class="flex items-center">
                                        <div class="v-star relative">
                                            <i class="bx text-3xl text-red-500 bxs-star"></i>
                                            <span class="absolute font-bold text-white" style="top: 4px; left: 11px;">
                                                <?=$i++;?> </span>
                                        </div>
                                        <span class="ml-1 text-white w-full font-bold truncate"
                                            style="max-width: 8rem;">
                                            <?=$top['username'];?>
                                        </span>
                                    </div>
                                    <div class="font-bold text-lg">
                                        <span class="bg-red-600 w-32 text-white rounded-sm text-center inline-block">
                                            <?=format_cash($top['total_money']);?> <span
                                                class="text-xs"><small>VND</small></span>
                                        </span>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
            $tool1trang = 8;
            if(isset($_GET['page']))
            {
                $pagetool = intval($_GET['page']);
            }
            else
            {
                $pagetool = 1;
            }
            $mintool = ($pagetool - 1) * $tool1trang;
            $listTool = $NNL->get_list("SELECT * FROM `tool` ORDER BY tool_id DESC LIMIT $mintool,$tool1trang ");
        ?>
    <div class="pb-10">
        <div class="v-card w-full max-w-6xl mx-auto md:p-4 bg-box-dark">
            <div class="md:mx-0">
                <div class="py-2">
                    <div class="mb-16">
                        <div class="mb-2 py-4 md:p-4">
                            <div
                                class="fade-in mb-2 py-2 md:mb-4 block uppercase md:py-4 text-center text-yellow-400 md:text-3xl text-2xl font-extrabold text-fill ">
                                DANH MỤC TOOL GAME
                            </div>
                            <div class="mb-2"><span class="mx-auto block w-40 border-2 border-red-500 "></span>
                            </div>
                        </div>
                        <div class="fade-in grid grid-cols-8 gap-2 px-2 md:px-0">
                            <?php foreach($listTool as $tool) {?>
                            <div class="hover:shadow-lg col-span-4 sm:col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-2 relative rounded "
                                style="padding: 1px; padding: 1px;border: 3px solid #FFA200;">
                                <!---->
                                <a href="<?=BASE_URL('Tools/'.$tool['tool_id']);?>">
                                    <img data-src="<?=$tool['image'];?>"
                                        class="rounded-t h-28 md:h-48 w-full object-fill object-center lazyLoad" />
                                    <div class="py-1">
                                        <div class="py-1 font-bold text-md px-1 truncate text-center uppercase"
                                            style="color: rgb(247, 176, 60);">
                                            <?=$tool['toolname'];?>
                                        </div>
                                        <div class="flex px-2 justify-center">
                                            <button type="button"
                                                class="border-2 text-center px-1 w-20 h-8 py-1 rounded font-semibold text-sm ml-1 focus:outline-none cursor-default"
                                                style="border-color: #2fd6da; color: #2fd6da;border: 2px solid;font-weight: bold;">
                                                Đã tải: <b><?=$tool['daban'];?></b>
                                            </button>
                                            <button type="button"
                                                class="border-2 text-center px-1 w-50 h-8 py-1 rounded font-semibold text-sm ml-1 focus:outline-none cursor-default"
                                                style="color: #ffd200; border-color: #ffd200;">
                                                <span>
                                                    <?=format_cash($tool['price'])?>đ/tháng
                                                </span>
                                            </button>

                                        </div>
                                        <div class="mt-1 mb-2 px-2 py-1 flex items-center justify-center">
                                            <button class="classBtnundefined"><img
                                                    src="<?=BASE_URL('assets/img/buy.png')?>"
                                                    class="lazyLoad isLoaded"></button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php }?>
                            <!--vps-->
                        </div>
                        <div class="mt-3 md:mt-6 w-full flex justify-center items-center">
                            <?php
                                
                                    $tong = $NNL->num_rows(" SELECT * FROM `tool`");
                                    if ($tong > $tool1trang)
                                    {
                                        echo '<center>' . phantrang($base_url.'?', $mintool, $tong, $tool1trang) . '</center>';
                                    }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="animated modal fadeIn is-visible fixed z-50 pin bg-smoke-dark flex p-2 md:p-0 top-0 left-0 bottom-0 right-0"
    style="z-index: 999;" id="indexModal">
    <div
        class="animated fadeInDown fixed shadow-inner max-w-md md:max-w-lg relative pin-b pin-x align-top m-auto justify-center bg-white rounded w-full h-auto md:shadow-lg flex flex-col">
        <div class="modal-content">
            <div class="text-red-600 font-bold text-lg text-center mb-3 p-3 uppercase border-b border-gray-300">
                Thông báo
            </div>
            <div class="overflow-auto p-2 md:px-4" style="max-height: 600px;">
                <div class="relative px-2 pb-4 text-dark-900">
                    <?=$NNL->site('thongbao');?>
                </div>
            </div>
            <div class="border-t border-gray-300 flex justify-end p-3 md:px-3">
                <span class="absolute cursor-pointer text-2xl text-gray-800 pt-3 px-3" style="right: -1px; top: -2px;"
                    data-close><i class="bx bxs-x-square" onclick="FuncHideModal()"></i></span>
                <button onclick="FuncHideModal()"
                    class="focus:outline-none rounded transition duration-200 hover:bg-blue-500 hover:text-white py-1 border-2 border-blue-500 font-semibold text-blue-700 px-6"
                    data-close>
                    Đóng
                </button>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
function FuncHideModal() {
    var x = document.getElementById("indexModal");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
$("#NapThe").on("click", function() {
    $('#NapThe').html('ĐANG XỬ LÝ').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/NapThe.php");?>",
        method: "POST",
        data: {
            type: "Napthe",
            loaithe: $("#loaithe").val(),
            menhgia: $("#menhgia").val(),
            seri: $("#seri").val(),
            pin: $("#pin").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#NapThe').html(
                    'NẠP NGAY')
                .prop('disabled', false);
        }
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(e => {
        GetCard()
    }, 0)
});

function GetCard() {
    $.ajax({
        url: "<?=BASE_URL('api/loaithe.php');?>",
        method: "GET",
        success: function(response) {
            $("#loaithe").html(response);
        }
    });
    $.ajax({
        url: "<?=BASE_URL('api/menhgia.php');?>",
        method: "GET",
        success: function(response) {
            $("#menhgia").html(response);
        }
    });
}
</script>
<?php 
    require_once(__DIR__."/public/client/Footer.php");
?>