
<?php
	$this->view("admin/header", $data);
	$this->view("admin/sidebar", $data);
?>      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div class="container h-100">
		  	<div class="row h-50 justify-content-around align-items-center">
				<div class="col-3 text-center">
					<a href="<?= ROOT ?>admin/suppliers">
						<button class="btn btn-primary btn-lg size-btn"> 
							<i class="fa-2x fa fa-people-arrows"></i>
							<p style="font-size: 0.8em">Fornecedores</p> 
						</button>
					</a>
				</div> 
				<div class="col-3 text-center">
					<a href="<?= ROOT ?>admin/products">
						<button class="btn btn-danger btn-lg size-btn"> 
							<i class="fa-2x fa fa-barcode"></i>  
							<p>Produtos</p> 
						</button>
					</a>
				</div> 
				<div class="col-3 text-center">
					<a href="<?= ROOT ?>admin/categories">
						<button class="btn btn-success btn-lg size-btn"> 
							<i class="fa-2x fa fa-list-alt"></i>  
							<p>Categorias</p> 
						</button>
					</a>
				</div> 
			</div> 

			<div class="row h-50 justify-content-around align-items-center">
				<div class="col-3 text-center">
					<a href="<?= ROOT ?>admin/users">
						<button class="btn btn-warning btn-lg size-btn text-white"> 
							<i class="fa-2x fas fa-reorder"></i>  
							<p>Pedidos</p> 
						</button>
					</a>
				</div> 
				<div class="col-3 text-center">
					<a href="<?= ROOT ?>admin/users">
						<button class="btn btn-info btn-lg size-btn text-white"> 
							<i class="fa-2x fas fa-user"></i>  
							<p>Usuários</p> 
						</button>
					</a>
				</div> 
				<div class="col-3 text-center">
					<a href="<?= ROOT ?>admin/reports">
						<button class="btn btn-dark btn-lg size-btn text-white"> 
							<i class="fa-2x fas fa-scroll"></i>  
							<p>Relatórios</p> 
						</button>
					</a>
				</div> 
			</div>  

			<div class="row h-50 justify-content-around align-items-center">
				<div class="col-3 text-center">
					<a href="<?= ROOT ?>admin/analytics">
						<button class="btn btn-secondary btn-lg size-btn text-white"> 
							<i class="fa-2x fas fa-chart-line"></i>
							<p>Analytics</p> 
						</button>
					</a>
				</div>  
			</div>   
	  </div>
<?php
	$this->view("admin/footer", $data);
?>