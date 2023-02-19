<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'Thay đổi key | '.$NNL->site('tenweb');
    require_once("../../public/client/Header.php");
    require_once("../../public/client/Nav.php");
    CheckLogin();
?>
<?php
  if(isset($_GET['id']))
  {
      $id=check_string($_GET['id']);
      $row = $NNL->get_row(" SELECT * FROM `license` WHERE `id` = '".check_string($_GET['id'])."' AND `user`='".$getUser['username']."' ");
      if(!$row)
      {
          admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 500);
      }
  }
  else
  {
      admin_msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
  }
?>
<div class="w-full max-w-6xl mx-auto pt-6 md:pt-8 pb-8">
    <div class="grid grid-cols-8 gap-4 md:p-4 bg-box-dark">
        <?php require_once('Sidebar.php');?>
        <div class="col-span-8 sm:col-span-5 md:col-span-6 lg:col-span-6 xl:col-span-6 px-2 md:px-0">
            <div class="v-bg w-full mb-5">
            <h2
                                class="v-title border-l-4 border-red-800 px-3 select-none text-white text-xl md:text-2xl font-bold">
                    ĐỔI KEY</h2>
                <div class="v-table-content">
                    <div class="py-3 pt-5">
                        <form accept-charset="UTF-8" class="form-charge">
                            <input id="key" type="text" placeholder="Nhập key mới" required="required"
                                class="mb-2 py-1 rounded-sm px-3 text-gray-800 focus:outline-none font-semibold border border-gray-500 bg-white" />
                           
                            <button type="button" id="DoiKey"
                                class="py-1 text-white border border-red-600 px-3 bg-red-600 hover:bg-red-500 hover:border-red-500 font-semibold focus:outline-none"
                                data-loading-text="<box-icon name='loader'></box-icon>">
                                ĐỔI KEY
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
$("#DoiKey").on("click", function() {
    $('#DoiKey').html('ĐANG XỬ LÝ').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/Auth.php");?>",
        method: "POST",
        data: {
            type: 'DoiKey',
            id:<?=$row['id']?>,
            key: $("#key").val()
        
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#DoiKey').html(
                    'ĐỔI KEY')
                .prop('disabled', false);
        }
    });
});
</script>
<?php 
    require_once("../../public/client/Footer.php");
?>