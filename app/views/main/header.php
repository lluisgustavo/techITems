<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Sistema WEB para gestão de uma loja de informática" />
        <meta name="author" content="Luis de Souza" /> 
        <meta name="google-site-verification" content="mnuFStcEqTMz5HuLaJfHP0Yshjjf2ju4JiXFtIwiecM" />
        <title><?=$data['page_title']?></title>
        
        <link type="text/css"  href="<?=ASSETS . THEME?>css/responsive.css" rel="stylesheet"> 
        <link type="text/css" href="<?=ASSETS . THEME?>css/main.css" rel="stylesheet" />
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="<?= ASSETS . THEME ?>images/favicon.png"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/7bd74a3e7b.js" crossorigin="anonymous"></script>	 
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-PL634VG961"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-PL634VG961');
        </script>
        
    </head>
    <body id="page-top">
        <!--[if lte IE 9]>
        <p class="browserupgrade">
            You are using an <strong>outdated</strong> browser. Please
            <a href="https://browsehappy.com/">upgrade your browser</a> to improve
            your experience and security.
        </p>
        <![endif]-->

        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light py-3 fixed-top" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="<?= ROOT ?>"><img class="w-50" src="<?= ASSETS . THEME ?>images/logo.png" alt=""></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="fs-5 nav-link text-uppercase text-dark" href="#sobre">Sobre</a></li>
                        <li class="nav-item"><a class="fs-5 nav-link text-uppercase text-dark" href="#func">Funcionalidades</a></li>
                        <li class="nav-item"><a class="fs-5 nav-link text-uppercase text-dark" href="#contato">Contato</a></li>
                
                        <?php if(isset($data['user_data'])): ?>
                        <li class="nav-item">  
                            <a class="fs-5 nav-link text-uppercase text-success" href="<?= ROOT ?>admin">
                                Painel
                            </a> 
                        </li>
                        <li class="nav-item">                                  
                            <a class="fs-5 nav-link text-uppercase text-danger" href="<?= ROOT ?>logout">
                                Sair
                            </a> 
                        </li>
                        <?php else: ?>
                        <li class="nav-item">  
                            <a class="fs-5 nav-link text-uppercase text-primary" href="<?= ROOT ?>login">
                                Login
                            </a> 
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>