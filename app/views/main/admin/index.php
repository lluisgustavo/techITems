
<?php
	$this->view("admin/header", $data);
	$this->view("admin/sidebar", $data); 
?>      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div class="h-100">
			<?php if($user_data->rank === "admin"): ?>
			<div class="row justify-content-around align-items-center">
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/suppliers">
						<button class="btn btn-primary btn-lg size-btn"> 
							<i class="fa-2x fa fa-people-arrows"></i>
							<p style="font-size: 0.8em">Fornecedores</p> 
						</button>
					</a>
				</div> 
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/products">
						<button class="btn btn-secondary btn-lg size-btn"> 
							<i class="fa-2x fa fa-barcode"></i>  
							<p>Produtos</p> 
						</button>
					</a>
				</div> 
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/categories">
						<button class="btn btn-success btn-lg size-btn"> 
							<i class="fa-2x fa fa-list-alt"></i>  
							<p>Categorias</p> 
						</button>
					</a>
				</div> 
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/orders">
						<button class="btn btn-danger btn-lg size-btn text-white"> 
							<i class="fa-2x fa fa-reorder"></i>  
							<p>Pedidos</p> 
						</button>
					</a>
				</div>
			</div>
			<div class="row justify-content-around align-items-center">
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/stock">
						<button class="btn btn-warning btn-lg size-btn"> 
							<i class="fa-2x fas fa-boxes"></i>  
							<p>Estoque</p> 
						</button>
					</a>
				</div> 
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/clients">
						<button class="btn btn-info btn-lg size-btn text-white"> 
							<i class="fa-2x fas fa-user"></i>  
							<p>Clientes</p> 
						</button>
					</a>
				</div> 
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/users">
						<button class="btn btn-light btn-lg size-btn"> 
							<i class="fa-2x fas fa-user"></i>  
							<p>Usu??rios</p> 
						</button>
					</a>
				</div> 
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/buy">
						<button class="btn btn-dark btn-lg size-btn"> 
							<i class="fa-2x fas fa-shopping-bag"></i>
							<p style="font-size: 0.8em">Comprar</p> 
						</button>
					</a>
				</div> 
			</div>   
		  	<div class="row justify-content-around align-items-center"> 
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/brands">
						<button class="btn btn-primary btn-lg size-btn"> 
							<i class="fa-2x fas fa-copyright"></i>
							<p style="font-size: 0.8em">Marcas</p> 
						</button>
					</a>
				</div> 
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/config">
						<button class="btn btn-secondary btn-lg size-btn"> 
							<i class="fa-2x fas fa-cogs"></i>
							<p style="font-size: 0.8em">Configura????es</p> 
						</button>
					</a>
				</div>  
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/reports">
						<button class="btn btn-success btn-lg size-btn text-white"> 
							<i class="fa-2x fas fa-scroll"></i>  
							<p>Relat??rios</p> 
						</button>
					</a>
				</div> 
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/analytics">
						<button class="btn btn-danger btn-lg size-btn text-white"> 
							<i class="fa-2x fas fa-chart-line"></i>
							<p>Analytics</p> 
						</button>
					</a>
				</div>   
			</div>
			<?php elseif($user_data->rank === "employee"): ?>
			<div class="row justify-content-around align-items-center">
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/suppliers">
						<button class="btn btn-primary btn-lg size-btn"> 
							<i class="fa-2x fa fa-people-arrows"></i>
							<p style="font-size: 0.8em">Fornecedores</p> 
						</button>
					</a>
				</div> 
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/products">
						<button class="btn btn-secondary btn-lg size-btn"> 
							<i class="fa-2x fa fa-barcode"></i>  
							<p>Produtos</p> 
						</button>
					</a>
				</div> 
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/categories">
						<button class="btn btn-success btn-lg size-btn"> 
							<i class="fa-2x fa fa-list-alt"></i>  
							<p>Categorias</p> 
						</button>
					</a>
				</div> 
			</div>
			<div class="row justify-content-around align-items-center">
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/orders">
						<button class="btn btn-danger btn-lg size-btn text-white"> 
							<i class="fa-2x fa fa-reorder"></i>  
							<p>Pedidos</p> 
						</button>
					</a>
				</div>
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/stock">
						<button class="btn btn-warning btn-lg size-btn"> 
							<i class="fa-2x fas fa-boxes"></i>  
							<p>Estoque</p> 
						</button>
					</a>
				</div> 
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/clients">
						<button class="btn btn-info btn-lg size-btn text-white"> 
							<i class="fa-2x fas fa-user"></i>  
							<p>Clientes</p> 
						</button>
					</a>
				</div>  
			</div>   
		  	<div class="row justify-content-around align-items-center"> 
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/buy">
						<button class="btn btn-light btn-lg size-btn"> 
							<i class="fa-2x fas fa-shopping-bag"></i>
							<p style="font-size: 0.8em">Comprar</p> 
						</button>
					</a>
				</div> 
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/brands">
						<button class="btn btn-dark btn-lg size-btn"> 
							<i class="fa-2x fas fa-copyright"></i>
							<p style="font-size: 0.8em">Marcas</p> 
						</button>
					</a>
				</div>  
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/config">
						<button class="btn btn-primary btn-lg size-btn"> 
							<i class="fa-2x fas fa-cogs"></i>
							<p style="font-size: 0.8em">Configura????es</p> 
						</button>
					</a>
				</div>  
			</div> 
			<?php elseif($user_data->rank === "customer"): ?>
			<div class="row justify-content-around align-items-center"> 
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/buy">
						<button class="btn btn-success btn-lg size-btn"> 
							<i class="fa-2x fas fa-shopping-bag"></i>
							<p style="font-size: 0.8em">Comprar</p> 
						</button>
					</a>
				</div> 
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/orders">
						<button class="btn btn-primary btn-lg size-btn text-white"> 
							<i class="fa-2x fa fa-reorder"></i>  
							<p>Pedidos</p> 
						</button>
					</a>
				</div> 
				<div class="col-12 col-sm-6 col-md-3 text-center">
					<a href="<?= ROOT ?>admin/config">
						<button class="btn btn-warning btn-lg size-btn"> 
							<i class="fa-2x fas fa-cogs"></i>
							<p style="font-size: 0.8em">Configura????es</p> 
						</button>
					</a>
				</div>  
			</div>
			<?php endif; ?>  
	  </div>
<?php
	$this->view("admin/footer", $data);
?>