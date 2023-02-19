<!DOCTYPE html>
<html class="h-100">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?=$NNL->site('favicon');?>">
    <meta property="og:title" content="<?=$NNL->site('tenweb');?>" />
    <meta property="og:image" content="<?=$NNL->site('anhbia');?>" />
    <meta property="og:description" content="<?=$NNL->site('mota');?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="<?=$NNL->site('tukhoa');?>" />
    <meta name="description" content="<?=$NNL->site('mota');?>" />
    <title><?=$title;?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-default/default.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=BASE_URL('template/');?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="<?=BASE_URL('template/');?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?=BASE_URL('template/');?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?=BASE_URL('template/');?>plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=BASE_URL('template/');?>dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?=BASE_URL('template/');?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?=BASE_URL('template/');?>plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?=BASE_URL('template/');?>plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="<?=BASE_URL('template/');?>plugins/ekko-lightbox/ekko-lightbox.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?=BASE_URL('template/');?>plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?=BASE_URL('template/');?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=BASE_URL('template/');?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <script src="<?=BASE_URL('template/');?>vanillatoasts.js"></script>
    <link href="<?=BASE_URL('template/');?>vanillatoasts.css" rel="stylesheet"></script>
</head>
<?php CheckLogin();?>
<?php CheckCtv();?>