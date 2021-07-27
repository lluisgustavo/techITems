
<?php
	$this->view("admin/header", $data);
	$this->view("admin/sidebar", $data); 
?>      
	<div class="container h-100"> 
		<div class="row">
				<div class="my-1 col-auto" >  
					<?php if(count($cRows) > 1): ?>
						<span class="list btn btn-outline-secondary active" data-filter="todas" style="font-size: 0.7em;">Todas</span>	 
					<?php endif; ?>
					<?php foreach($cRows as $key => $row): ?>
						<span class="list btn btn-outline-secondary" data-filter="<?= strtolower($row->category) ?>" style="font-size: 0.7em;"> <?= $row->category ?></span>	 
					<?php endforeach; ?>
				</div>
		</div>
		<div class="row justify-content-center align-items-center">  
			<?php foreach($pRows as $row): 
				if($row->quantity > 0):?>
				<div class="card col-12 col-sm-3 m-2 <?= strtolower($row->category) ?>" style="width: 15rem;">  
					<div id="slider-carousel-product-<?= $row->id ?>" class="justify-content-center carousel carousel-dark slide" data-bs-ride="carousel">
						<div class="carousel-inner"> 
							<div class="carousel-item active"> 
								<img class="w-100 h-100 card-img-top" src="<?= ROOT . $row->image ?>" alt="<?= $row->title ?>">
							</div> 
							<?php if(!empty($row->image2)): ?>
								<div class="carousel-item"> 
									<img class="w-100 h-100 card-img-top" src="<?= ROOT . $row->image2 ?>" alt="<?= $row->title ?>">
								</div>
							<?php endif; ?>	
							<?php if(!empty($row->image3)): ?> 
								<div class="carousel-item"> 
									<img class="w-100 h-100 card-img-top" src="<?= ROOT . $row->image3 ?>" alt="<?= $row->title ?>">
								</div>
							<?php endif; ?>
							<?php if(!empty($row->image4)): ?>
								<div class="carousel-item"> 
									<img class="w-100 h-100 card-img-top" src="<?= ROOT . $row->image4 ?>" alt="<?= $row->title ?>">
								</div>
							<?php endif; ?>
						</div> 
						<button class="carousel-control-next" type="button" data-bs-target="#slider-carousel-product-<?= $row->id ?>" data-bs-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Próximo</span>
						</button>
					</div>  
					<div class="card-body text-center"> 
						<h4 class="card-text"> <?= $row->title ?> </h4> 
						<h5 class="card-text"> <?= $row->brand_name ?> </h5> 
						<p class="card-text"> <?= $row->description ?> </p> 
						<h4 class="card-text">R$ <?= number_format($row->price_sell , 2, '.', '')?></h4>
				
						<button onclick="addToCart(this)" class="btn btn-primary" type="checkbox" data-id="<?= $row->id ?>" data-image="<?= $row->image ?>" data-name="<?= $row->title ?>" data-price="<?= $row->price_sell ?>" id="product_<?=$row->id?>" name="product_<?=$row->id?>">
						Adicionar ao Carrinho
						</button>
						</div>
				</div> 
			<?php endif;
		endforeach; ?>
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

					<button onclick="collectData(event); return false;" class="btn btn-primary" type="submit">Finalizar Compra</button>
				</form>
			</div>
		</div>
	</div> 

<script type="text/javascript">      
var root = '<?= ROOT ?>';

function collectData(element){  
	var arrayIds = [];
	var arrayQtd = [];
	$.each($('#cart_table tr'), function(){     
		var inputs = $(this).find('input');

		inputs.each(function(){ 
			if($(this).prop('name').indexOf("product") == 0){
				arrayIds.push($(this).val()); 
			}

			if($(this).prop('name').indexOf("qtdProduto") == 0){
				arrayQtd.push($(this).val()); 
			}
		})  
	}) 

	sendData({ 
		customer_id: <?= $user_data->id_customer ?>,
		product_IDs: arrayIds,
		product_Qtd: arrayQtd,
		data_type: 'add-order'
	});
}

function sendData(data = {}){
	var ajax = new XMLHttpRequest();
 
	ajax.addEventListener('readystatechange', function(){
		if(ajax.readyState == 4 && ajax.status == 200){ 
			handleResult(ajax.responseText);
		}
	});

	ajax.open("POST","<?=ROOT?>ajaxbuy", true);
	ajax.send(JSON.stringify(data));
}

function handleResult(result){
		if(result != ""){      
			console.log(result);
			var obj = JSON.parse(result);
			if(typeof(obj.data_type) != 'undefined'){
				if(obj.data_type == "add-new"){
					if(obj.message_type == 'info'){
						alert(obj.message); 
					
						removeEveryRowCart(); 
					} else {
						alert(obj.message);
					}    
			}
		}
	}
}

function addToCart(element){
	var product_id = $(element).data('id');
	var product_name = $(element).data('name');
	var product_price = $(element).data('price');
	var product_image = $(element).data('image');

	var item = `<tr id="row_produto_` + product_id +`"> 
					<td>
						<img style="max-height:100px" class="w-100 h-100" src="` + root + product_image + `" alt="">
						<input class="form-control" name="product[` + product_id +`]" value="` + product_id +`" type="hidden">
					</td>
					<td>
						` + product_name + `
						<small><a class="text-muted" onclick="removeFromCart(` + product_id +`)"><i class="cursor-pointer fa fa-times"></i></a></small>
						<div class="col-2">
							<input style="width: 5em;" onChange="totalVlrProduto(` + product_id +`, ` + product_price + `, this)" class="form-control" name="qtdProduto[` + product_id +`]" value="1" type="number" min="1" max="999" step="1">
						</div>
					</td>
					<td>
						<span id="vlrProduto_` + product_id +`">`+ product_price.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) + `</span>
					</td>
				</tr>`;


	$('#cart_table').append(item);   

	if($('#row_order_price')){  
		calcTotal();
	}

	$(element).prop('disabled', 'true');
} 

function totalVlrProduto(id, price, element){
	var qty = $(element).val(); 
	var totalProductPrice = parseInt(qty) * parseFloat(price); 
	$('#vlrProduto_' + id).text(totalProductPrice.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}))
	calcTotal();
}

function removeFromCart(id){  
	$('#product_' + id).removeAttr("disabled");
	$('#product_' + id).prop("checked", false);
	$('#row_produto_' + id).remove(); 
	calcTotal();
} 

function removeEveryRowCart(){  
	$.each($('#cart_table [id^="row_produto_"]'), function(){
		$(this).remove();
	})

	$('#vlrTotal').text(Number(0).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
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
		preco_item = preco_item.replace('.', '|');
		preco_item = preco_item.replace(',', '.');
		preco_item = preco_item.replace('|', ''); 
		preco_item = parseFloat(preco_item); 
		soma += preco_item; 
	}) 
	
	var item = `<tfoot id="row_order_price"> 
					<td> 
					</td>
					<td> <b class="float-end">Total:
					</td>
					<td>
						<span id="vlrTotal">`+ soma.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}) + `</span>
					</td>
				</tfoot>`;

	$('#cart_table').append(item); 
}

</script>

<?php
	$this->view("admin/footer", $data);
?>