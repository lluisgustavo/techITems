
<?php
	$this->view("admin/header", $data);
	$this->view("admin/sidebar", $data);
?>      
	<div class="container h-100"> 
		<div class="row justify-content-center align-items-center">
			<?php foreach($rows as $row): ?>
				<div class="col- col-sm-4 col-md-3">  
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
		</div>
		<div class="row justify-content-center align-items-center my-5"> 
			<div class="col-md-12" id="cart">
				<form action="POST">
					<table id="cart_table" class="table table-striped">
						<tr> 
							<th width="100"></th>
							<th>Item</th>
							<th>Preço</th>
						</tr> 
					</table>

					<button onclick="calcTotal(event)" class="btn btn-primary">Calcular Preço</button>
					<button class="btn btn-primary" type="submit">Comprar</button>
				</form>
			</div>
		</div>
	</div> 

<script type="text/javascript">      
var root = '<?= ROOT ?>';

function addToCart(element){
	var product_id = $(element).data('id');
	var product_name = $(element).data('name');
	var product_price = $(element).data('price');
	var product_image = $(element).data('image');

	var item = `<tr id="row_produto_` + product_id +`"> 
					<td>
						<img style="max-height:100px" class="w-100 h-100" src="` + root + product_image + `" alt="">
					</td>
					<td>
						` + product_name + `
						<small><button class="btn btn-secondary" onclick="removeFromCart(` + product_id +`)">Remover</button></small>
						<div class="col-md-2">
							<input class="form-control" name="produto_` + product_id +`" type="hidden">
							<input class="form-control" name="qtdProduto_` + product_id +`" value="1" type="number" min="1" max="999" step="1">
						</div>
					</td>
					<td>
						<span id="vlrProduto_` + product_id +`">`+ product_price.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) + `</span>
					</td>
				</tr>`;

	if($('#row_order_price')){ 
		$('#row_order_price').remove()
	}

	$('#cart_table').append(item); 

	if($('#row_order_price')){ 
		calcTotal();
	}

	$(element).prop('disabled', 'true');
} 

function removeFromCart(id){  
	$('#product_' + id).removeAttr("disabled");
	$('#product_' + id).prop("checked", false);
	$('#row_produto_' + id).remove(); 
	calcTotal();
} 

function calcTotal(){ 
	event.preventDefault();

	if($('#row_order_price')){ 
		$('#row_order_price').remove()
	}

	var soma = 0;
	var regex = '/^R$ +|R$ +$/g';
	$.each($('#cart_table [id^="vlrProduto_"]'), function(){
		var preco_item = $(this).text();
		preco_item = preco_item.substring(3);
		//soma += preco_item;
		preco_item = preco_item.replace('.', '|');
		preco_item = preco_item.replace(',', '.');
		preco_item = preco_item.replace('|', ''); 
		preco_item = parseFloat(preco_item); 
		soma += preco_item; 
	}) 
	
	var item = `<tr id="row_order_price"> 
					<td> 
					</td>
					<td> 
					</td>
					<td>
						<span id="vlrTotal">`+ soma.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) + `</span>
					</td>
				</tr>`;

	$('#cart_table').append(item); 
}

</script>

<?php
	$this->view("admin/footer", $data);
?>