/*LazyLoad*/
$(function() {
    $("img.lazyLoad").lazyload({
    	effect : "fadeIn"
    });
});

/*JS Modal*/
const isVisible = "is-visible";
const openEls = document.querySelectorAll("[data-open]");
const closeEls = document.querySelectorAll("[data-close]");

for (const el of openEls) {
    el.addEventListener("click", function() {
        const modalId = this.dataset.open;
        document.getElementById(modalId).classList.add(isVisible);
        document.getElementById(modalId).classList.remove("out");
    });
}

for (const el of closeEls) {
    el.addEventListener("click", function() {
        this.parentElement.parentElement.parentElement.parentElement.classList.remove(isVisible);
        this.parentElement.parentElement.parentElement.parentElement.classList.add("out");
    });
}
document.addEventListener("click", e => {
    if (e.target == document.querySelector(".modal.is-visible")) {
        document.querySelector(".modal.is-visible").classList.add("out");
        document.querySelector(".modal.is-visible").classList.remove(isVisible);
    }
});
document.addEventListener("keyup", e => {
    if (e.key == "Escape" && document.querySelector(".modal.is-visible")) {
        document.querySelector(".modal.is-visible").classList.add("out");
        document.querySelector(".modal.is-visible").classList.remove(isVisible);
    }
});

/*JS Tab*/
function Tab(id){
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
    tablinks[i].className = tablinks[i].className.replace("bg-trueGray-800", "bg-trueGray-900");
  }
  document.getElementById(id).style.display = "block";
  event.currentTarget.className += " active";
  event.currentTarget.className = event.currentTarget.className.replace("bg-trueGray-900", "bg-trueGray-800");
}

$(".form-charge").submit(function () {
    $(".btn-submit").button("loading");
});
function activeTab(obj)
{
    $('#tap1 button').removeClass('bg-red-500 text-white');
    $(obj).addClass('bg-red-500 text-white');
    var id = $(obj).data('id');
    $('.v-account-detail-1').css("display", "none");
    $(id).show();
}
$('#tap1 button').click(function(){
    activeTab(this);
    return false;
});
activeTab($('#tap1 button:first-child'));

//recharge online
$(".recharge-online button").on('click', function(){
    var id = $(this).data('id');
    $(id).toggle('hide');
});

//buy random
function buyRandom(id){
    $.ajax({
        url : '/confirm-buy-random',
        dataType : 'json',
        type : 'POST',
        data : { id },
        success : function(data){
            if(data.code == 1){
                $('#modalNoti').removeClass('out');
                $('.content-msg').html(data.message);
                setTimeout(function(){
                    window.location.href = '/tran/acc';
                }, 3000);
            }else{
                $('#modalNoti').removeClass('out');
                $('.content-msg').html(data.message);
            }
        }
    });
}

//buy random
function buykc(id){
    $.ajax({
        url : '/confirm-buykc',
        dataType : 'json',
        type : 'POST',
        data : { id },
        success : function(data){
            if(data.code == 1){
                $('#modalNoti').removeClass('out');
                $('.content-msg').html(data.message);
                setTimeout(function(){
                    window.location.href = '/tran/gaming-history';
                }, 1000);
            }else{
                $('#modalNoti').removeClass('out');
                $('.content-msg').html(data.message);
            }
        }
    });
}