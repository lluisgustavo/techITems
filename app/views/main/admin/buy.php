
<?php
	$this->view("admin/header", $data);
	$this->view("admin/sidebar", $data);
?>      
	<div class="container h-100"> 
			<div class="row justify-content-center align-items-center">
				<?php foreach($rows as $row): ?>
					<div class="col- col-sm-4 col-md-4">  
						<div class="buy-product-card m-1">
								<div id="slider-carousel-product-<?= $row->id ?>" class="justify-content-center carousel carousel-dark slide" data-bs-ride="carousel">
									<div class="carousel-inner">
										<div class="card-header">
											<p> <?= $row->title ?> </p>
										</div>
										<div class="carousel-item active"> 
											<img class="w-100 h-100" src="<?= ROOT . $row->image ?>" alt="">
										</div> 
										<?php if(!empty($row->image2)): ?>
											<div class="carousel-item"> 
												<img class="w-100" src="<?= ROOT . $row->image2 ?>" alt="">
											</div>
										<?php endif; ?>	
										<?php if(!empty($row->image3)): ?> 
											<div class="carousel-item"> 
												<img class="w-100" src="<?= ROOT . $row->image3 ?>" alt="">
											</div>
										<?php endif; ?>
										<?php if(!empty($row->image4)): ?>
											<div class="carousel-item"> 
												<img class="w-100" src="<?= ROOT . $row->image4 ?>" alt="">
											</div>
										<?php endif; ?>
									</div>
									<button class="carousel-control-prev" type="button" data-bs-target="#slider-carousel-product-<?= $row->id ?>" data-bs-slide="prev">
										<span class="carousel-control-prev-icon" aria-hidden="true"></span>
										<span class="visually-hidden">Anterior</span>
									</button>
									<button class="carousel-control-next" type="button" data-bs-target="#slider-carousel-product-<?= $row->id ?>" data-bs-slide="next">
										<span class="carousel-control-next-icon" aria-hidden="true"></span>
										<span class="visually-hidden">Próximo</span>
									</button>
								</div>
								<div class="card-footer">
									<div class="form-check">
										<input onchange="addToCart(this)"  class="form-check-input" type="checkbox" data-id="<?= $row->id ?>" data-image="<?= $row->image ?>" data-name="<?= $row->title ?>" data-price="<?= $row->price_sell ?>" id="product_<?=$row->id?>" name="product_<?=$row->id?>">
										<label class="form-check-label" for="product_<?=$row->id?>"> R$ <?= number_format($row->price_sell , 2, '.', '')?> </label>
									</div>
								</div>
						</div>
					</div>
				<?php endforeach; ?>
				<div id="cart">
					<form action="POST">
						<table id="cart_table" class="table table-striped">
							<tr>
								<th colspan="1"></th>
								<th colspan="3">Item</th>
								<th colspan="1">Preço</th>
							</tr>
							<tr class="cart_items"> 
							</tr>
						<table>
					</form>
				</div>
			</div>
	</div> 

<script type="text/javascript">      
addToCart = function(element){
	var product_id = $(element).data('id');
	var product_name = $(element).data('name');
	var product_price = $(element).data('price');
	var product_image = $(element).data('iamge');

	var item = '<td colspan="1"><img src="' <?= ROOT ?> + product_image + '"></td>';
	item += '<td colspan="2"><b>' + product_name + '</b></td>';
	item += '<td colspan="1"><b>' + product_price + '</b></td>';

	$('.cart-items').append(item); 
}
</script>

<?php
	$this->view("admin/footer", $data);
?>