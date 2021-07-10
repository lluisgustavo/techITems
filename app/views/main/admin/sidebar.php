 <!--sidebar start-->
        <aside id="sidebar"  class="nav-collapse">
             
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
            
                <p class="centered"><a href="profile.html"><img src="<?= ASSETS . THEME ?>admin/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
                <h5 class="centered"><?= $data['user_data']->name ?></h5>
            
                <li class="sub-menu">
                    <a href="<?= ROOT ?>admin" >
                        <i class="fa fa-desktop"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="<?= ROOT ?>admin/products">
                        <i class="fa fa-people-arrows"></i>
                        <span>Fornecedores</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="<?= ROOT ?>admin/products">
                        <i class="fa fa-barcode"></i>
                        <span>Produtos</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="<?= ROOT ?>admin/categories">
                        <i class="fa fa-list-alt"></i>
                        <span>Categorias</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="<?= ROOT ?>admin/orders">
                        <i class="fa fa-reorder"></i>
                        <span>Pedidos</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-cogs"></i>
                        <span>Configurações</span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?= ROOT ?>admin/settings/slider">Configuracões</a></li>
                        <li><a href="<?= ROOT ?>admin/settings/slider">Imagens Slider</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Usuários</span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?= ROOT ?>admin/users/">Usuarios</a></li>
                        <li><a href="<?= ROOT ?>admin/users/customers">Clientes</a></li>
                        <li><a href="<?= ROOT ?>admin/users/admins">Administradores</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" >
                        <i class="fa fa-hdd-o"></i>
                        <span>Backup</span>
                    </a>
                </li> 
            </ul>
            <!-- sidebar menu end--> 
        </aside>
        <!--sidebar end-->      
        <!--main content start-->
      <div id="main-content">
          <section class="wrapper">
          	<h3 class="mt-3"><i class="fa fa-angle-right"></i> <?= ucwords($data['page_title']) ?></h3>
          	<div class="row ">
          		<div class="col-lg-12">