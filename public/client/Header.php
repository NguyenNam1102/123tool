<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <title><?=$title;?></title>
    <meta name="description" content="<?=$NNL->site('mota');?>">
    <meta name="keywords" content="<?=$NNL->site('tukhoa');?>">
    <meta property="og:title" content="<?=$NNL->site('tenweb');?>">
    <meta property="og:type" content="Website">
    <meta property="og:url" content="<?=BASE_URL('');?>">
    <meta property="og:image" content="<?=$NNL->site('anhbia');?>">
    <meta property="og:description" content="<?=$NNL->site('mota');?>">
    <meta property="og:site_name" content="<?=$NNL->site('tenweb');?>">
    <meta property="article:section" content="<?=$NNL->site('mota');?>">
    <meta property="article:tag" content="<?=$NNL->site('tukhoa');?>">
    <meta name="twitter:card" content="<?=$NNL->site('anhbia');?>">
    <meta name="twitter:site" content="">
    <link href="<?=BASE_URL('');?>assets/img/icon.JPG" rel="shortcut icon">
    <meta name="twitter:title" content="<?=$NNL->site('tenweb');?>">
    <meta name="twitter:description" content="<?=$NNL->site('mota');?>">
    <meta name="twitter:creator" content="">
    <meta name="twitter:image:src" content="<?=$NNL->site('anhbia');?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link data-n-head="ssr" rel="preconnect" href="https://fonts.gstatic.com">
    <link data-n-head="ssr" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Goldman&amp;display=swap">
    <link data-n-head="ssr" rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&amp;family=Roboto:wght@900&amp;display=swap">
    <link href="<?=BASE_URL('template/theme/');?>assets/frontend/css/style.css?v=1621615725" rel="stylesheet"
        type="text/css" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="<?=BASE_URL('template/theme/');?>assets/frontend/plugins/jquery/jquery-2.1.0.min.js"></script>
    <script src="<?=BASE_URL('template/theme/');?>assets/frontend/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>
    <script src="<?=BASE_URL('template/theme/');?>assets/frontend/plugins/jquery-cookie/jquery.cookie.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL('');?>/assets/toastr/toastr.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL('');?>/assets/toastr/toastr.css" />
    <script type="text/javascript" src="<?=BASE_URL('');?>/assets/toastr/toastr.min.js"></script>
    <script src="<?=BASE_URL('template/theme/');?>assets/frontend/theme/assets/plugins/js-cookie/js.cookie.js"
        type="text/javascript"></script>
    <script
        src="<?=BASE_URL('template/theme/');?>assets/frontend/theme/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
        type="text/javascript"></script>
    <script src="<?=BASE_URL('template/theme/');?>assets/frontend/js/kun.js"></script>
    <script src="<?=BASE_URL('template/theme/');?>assets/frontend/js/backtotop.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.3.2/dist/lazyload.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL('');?>assets/locdz.css" />
</head>

<div class="snowflakes" aria-hidden="true">
   <div class="snowflake">🌺</div>
  <div class="snowflake">🏵️️</div>
  <div class="snowflake">🧧</div>
   <div class="snowflake">🌺</div>
  <div class="snowflake">🏵️️</div>
  <div class="snowflake">🧧</div>
   <div class="snowflake">🌺</div>
  <div class="snowflake">🏵️️</div>
  <div class="snowflake">🧧</div>
   <div class="snowflake">🌺</div>
  <div class="snowflake">🏵️️</div>
  <div class="snowflake">🧧</div>
   <div class="snowflake">🌺</div>
  <div class="snowflake">🏵️️</div>
  <div class="snowflake">🧧</div>
   <div class="snowflake">🌺</div>
  <div class="snowflake">🏵️️</div>
  <div class="snowflake">🧧</div>
   <div class="snowflake">🌺</div>
  <div class="snowflake">🏵️️</div>
  <div class="snowflake">🧧</div>
</div>


  <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "104841365357487");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v12.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
