<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Projeto de sistema WEB para gestão de uma loja de informática">
        <meta name="author" content="Luis de Souza">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

        <title><?= WEBSITE_TITLE ?> - <?= $page_title?></title>

        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!--<link type="text/css" href="<?= ASSETS . THEME ?>admin/css/bootstrap.css" rel="stylesheet">-->
        <!--external css-->
        <link type="text/css" href="<?= ASSETS . THEME ?>admin/font-awesome/css/font-awesome.css" rel="stylesheet" /> 
        <link rel="stylesheet" type="text/css" href="<?= ASSETS . THEME ?>admin/lineicons/style.css">    

        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="<?= ASSETS . THEME ?>images/favicon.png" />
        <!-- Custom styles for this template -->
        <link type="text/css" href="<?= ASSETS . THEME ?>admin/css/style.css" rel="stylesheet">
        <link type="text/css" href="<?= ASSETS . THEME ?>admin/css/style-responsive.css" rel="stylesheet">
 
        <script src="https://kit.fontawesome.com/7bd74a3e7b.js" crossorigin="anonymous"></script>	
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="min-vh-100 d-flex flex-column">
        <!--[if lte IE 9]>
        <p class="browserupgrade">
            You are using an <strong>outdated</strong> browser. Please
            <a href="https://browsehappy.com/">upgrade your browser</a> to improve
            your experience and security.
        </p>
        <![endif]-->

        <!-- Preloader -->
        <div class="preloader">
            <div class="preloader-inner">
                <div class="preloader-icon">
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <!-- /End Preloader -->

        <section id="container" class="min-vh-100 d-flex flex-column h-100">
            <!-- **********************************************************************************************************************************************************
            TOP BAR CONTENT & NOTIFICATIONS
            *********************************************************************************************************************************************************** -->
            <!--header start-->
                <header class="header header-bg">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="container-fluid">
                            <div class="fa-2x fa fa-bars tooltips cursor-pointer" data-placement="right" data-original-title="Toggle Navigation" aria-hidden="true"></div>
                            <!--logo start-->
                            <a class="px-3 navbar-brand pull-left" href="#">
                                <img width="100" class="logo" src="<?= ASSETS . THEME ?>images/logo.png" alt=""> <b class="text-white">PAINEL DE CONTROLE</b>
                            </a> 
                            <!--logo end-->
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button> 
                                            
                            <div class="top-menu">
                                <ul class="nav pull-right top-menu">
                                    <li><a class="logout" href="<?=ROOT?>logout">Logout</a></li>
                                </ul>
                            </div>  
                        </div>
                    </nav> 
                </header>
            <!--header end-->