<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

        <title><?= WEBSITE_TITLE ?> - <?= $page_title?></title>

        <!-- Bootstrap core CSS -->
        <link type="text/css" href="<?= ASSETS . THEME ?>admin/css/bootstrap.css" rel="stylesheet">
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
                            <a class="px-3 navbar-brand" href="#">
                                <img width="100" class="logo" src="<?= ASSETS . THEME ?>images/logo.png" alt=""> <b class="text-white">PAINEL DE CONTROLE</b>
                            </a> 
                            <!--logo end-->
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarText">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0 top-menu">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-tasks"></i>
                                                <span class="badge bg-theme">4</span>
                                        </a>
                                        <ul class="dropdown-menu extended tasks-bar" aria-labelledby="navbarDropdownMenuLink">
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <div class="task-info">
                                                        <div class="desc">Painel de Controle da Loja</div>
                                                        <div class="percent">40%</div>
                                                    </div>
                                                    <div class="progress progress-striped">
                                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                            <span class="sr-only">40% Complete (success)</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <div class="task-info">
                                                        <div class="desc">Product Development</div>
                                                        <div class="percent">80%</div>
                                                    </div>
                                                    <div class="progress progress-striped">
                                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                            <span class="sr-only">80% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <div class="task-info">
                                                        <div class="desc">Product Development</div>
                                                        <div class="percent">80%</div>
                                                    </div>
                                                    <div class="progress progress-striped">
                                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                            <span class="sr-only">80% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-envelope-o"></i>
                                                <span class="badge bg-theme">5</span>
                                        </a>
                                        <ul id="header_inbox_bar" class="dropdown-menu extended inbox" aria-labelledby="navbarDropdownMenuLink">
                                            <li>
                                                <p class="green">You have 5 new messages</p>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#"> 
                                                    <span class="photo"><img alt="avatar" src="<?= ASSETS . THEME ?>admin/img/ui-zac.jpg"></span>
                                                    <span class="subject">
                                                    <span class="from">Zac Snider</span>
                                                    <span class="time">Just now</span>
                                                    </span>
                                                    <span class="message">
                                                        Hi mate, how is everything?
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <span class="photo"><img alt="avatar" src="<?= ASSETS . THEME ?>admin/img/ui-divya.jpg"></span>
                                                    <span class="subject">
                                                    <span class="from">Divya Manian</span>
                                                    <span class="time">40 mins.</span>
                                                    </span>
                                                    <span class="message">
                                                        Hi, I need your help with this.
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <span class="photo"><img alt="avatar" src="<?= ASSETS . THEME ?>admin/img/ui-danro.jpg"></span>
                                                    <span class="subject">
                                                    <span class="from">Dan Rogers</span>
                                                    <span class="time">2 hrs.</span>
                                                    </span>
                                                    <span class="message">
                                                        Love your new Dashboard.
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <span class="photo"><img alt="avatar" src="<?= ASSETS . THEME ?>admin/img/ui-sherman.jpg"></span>
                                                    <span class="subject">
                                                    <span class="from">Dj Sherman</span>
                                                    <span class="time">4 hrs.</span>
                                                    </span>
                                                    <span class="message">
                                                        Please, answer asap.
                                                    </span>
                                                </a>
                                            </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">See all messages</a>
                                                </li>
                                        </ul>
                                    </li>
                                </ul> 
                                
                                <ul class="nav pull-right top-menu">
                                    <li><a class="logout fs-5" target="_blank" href="<?= ROOT ?>">Vá para a Loja</a></li>
                                    <li><a class="logout fs-5" href="<?= ROOT ?>logout">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav> 
                </header>
            <!--header end-->