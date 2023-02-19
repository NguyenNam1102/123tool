$(document).ready(function() {
    setTimeout(e => {
        GetCard24()
    }, 0)
});

function GetCard24() {
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