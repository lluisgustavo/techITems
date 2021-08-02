 <!--sidebar start-->
        <aside id="sidebar"  class="nav-collapse">
             
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
            
                <p class="centered"><a href="profile.html"><img src="<?= ROOT . $data['user_data']->avatar ?>" class="img-circle" width="60"></a></p>
                <h5 class="centered"><?= $data['user_data']->name ?></h5>
                <li class="sub-menu">
                    <a href="<?= ROOT ?>admin" >
                        <i class="fa fa-home"></i>
                        <span>Início</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="<?= ROOT ?>admin/buy" >
                        <i class="fa fa-desktop"></i>
                        <span>Comprar</span>
                    </a>
                </li>  
 
                <?php if($data['user_data']->rank == 'admin'): ?>
                <li class="sub-menu">
                    <a href="<?= ROOT ?>admin/suppliers">
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
                    <a href="<?= ROOT ?>admin/brands">
                        <i class="fa fa-copyright"></i>
                        <span>Marcas</span>
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
                    <a href="<?= ROOT ?>admin/stock">
                    <i class="fas fa-boxes"></i>
                        <span>Estoque</span>
                    </a>
                </li> 

                <li class="sub-menu">
                    <a href="<?= ROOT ?>admin/users">
                        <i class="fa fa-user"></i>
                        <span>Usuários</span>
                    </a> 
                </li>
 
                <?php elseif($data['user_data']->rank == 'employee'): ?>

                <li class="sub-menu">
                    <a href="<?= ROOT ?>admin/suppliers">
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
                    <a href="<?= ROOT ?>admin/brands">
                        <i class="fa fa-copyright"></i>
                        <span>Marcas</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="<?= ROOT ?>admin/orders">
                        <i class="fa fa-reorder"></i>
                        <span>Pedidos</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="<?= ROOT ?>admin/stock">
                    <i class="fas fa-boxes"></i>
                        <span>Estoque</span>
                    </a>
                </li>  

                <?php elseif($data['user_data']->rank == 'customer'): ?> 
                

                <li class="sub-menu">
                    <a href="<?= ROOT ?>admin/orders">
                        <i class="fa fa-reorder"></i>
                        <span>Meus pedidos</span>
                    </a>
                </li>
                <?php endif; ?> 

                <li class="sub-menu">
                    <a href="<?= ROOT ?>admin/config">
                        <i class="fa fa-cogs"></i>
                        <span>Configurações</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="<?= ROOT ?>logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
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