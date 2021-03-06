
<?php
	$this->view("admin/header", $data);
	$this->view("admin/sidebar", $data); 
?>      
<div class="row mt">
	<div class="col-md-12">
		<div class="content-panel"> 
		    <div class="table-responsive">
    			<table class="table table-responsive table-striped table-advance table-hover"> 
    				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-product">
    					<i class="fa fa-plus"></i>Adicionar Produto
    				</button>
    				
    				<hr>
    				<thead>
    					<tr>
    						<th class="text-right">ID</th>
    						<th><i class="fa fa-copyright"></i> Marca</th>
    						<th><i class="fa fa-barcode"></i> Produto</th>
    						<th><i class="fa fa-bullhorn"></i> Descrição </th>
    						<th><i class="fa fa-bullhorn"></i> Imagem</th>
    						<th><i class="fa fa-list-alt"></i> Categoria</th>
    						<th class="text-right"><i class="fa fa-money"></i> Preço de Compra</th>
    						<th class="text-right"><i class="fa fa-money"></i> Preço de Venda</th> 
    						<th class="text-right"><i class="fa fa-people-arrows"></i> Fornecedor</th> 
    						<th><i class="fa fa-star-o"></i> Status</th>
    						<th><i class=" fa fa-edit"></i> Ação</th>
    					</tr>
    				</thead>
    				<tbody id="table-body">
    					<?php 
    						echo $tableRows;
    					?>
    				</tbody>
    			</table>
			</div>
		</div><!-- /content-panel -->
	</div><!-- /col-md-12 -->
 
	<!-- adicionar produto -->
	<div class="modal fade" id="add-new-product" tabindex="-1" aria-labelledby="add-new-product" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addNewLabel"> Adicionar Produto</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="form-inline" role="form">
					<div class="modal-body">
						<div class="form-group col-md-12 mb-2"> 
							<input name="nome-produto" type="text" id="nome-produto" class="form-control" placeholder="Nome do Produto" autofocus required>
						</div>
						<div class="form-group col-md-12 mb-2"> 
							<textarea name="descricao-produto" id="descricao-produto" placeholder="Descrição do Produto" rows="3" class="form-control"></textarea>
						</div>
						<div class="row mb-2"> 
							<div class="form-group col-md-6"> 
								<label class="form-control-label" for="preco-compra">Preço de Compra</label>
								<input name="preco-compra" id="preco-compra" type="number" class="form-control" value="0.00" placeholder="0.00" min="0.01" step="0.01" required>
							</div>
							<div class="form-group col-md-6"> 
								<label class="form-control-label" for="preco-venda">Preço de Venda</label>
								<input name="preco-venda" id="preco-venda" type="number" class="form-control" value="0.00" placeholder="0.00" min="0.01" step="0.01" required>
							</div>
						</div>
						<div class="form-group col-md-12 mb-2"> 
							<?php echo $dropdownCategories ?>
						</div> 
						<div class="row mb-2">
							<div class="form-group col-md-6 mb-2"> 
								<?php echo $dropdownSuppliers ?>
							</div> 
							<div class="form-group col-md-6 mb-2"> 
								<?php echo $dropdownBrands ?>
							</div> 
						</div>
						<div class="form-group col-md-12 mb-2">
							<label class="control-label" for="imagem-produto-1">Imagem</label>
							<input onchange="DisplayImage(this.files[0], 1, 'image-holder')" name="imagem-produto-1" id="imagem-produto-1" type="file" class="form-control">
						</div>
						<div class="form-group col-md-12 mb-2">
							<label class="control-label" for="imagem-produto-2">Imagem 2</label>
							<input onchange="DisplayImage(this.files[0], 2, 'image-holder')" name="imagem-produto-2" id="imagem-produto-2" type="file" class="form-control">
						</div>
						<div class="form-group col-md-12 mb-2">
							<label class="control-label" for="imagem-produto-3">Imagem 3</label>
							<input onchange="DisplayImage(this.files[0], 3, 'image-holder')" name="imagem-produto-3" id="imagem-produto-3" type="file" class="form-control">
						</div>
						<div class="form-group col-md-12 mb-2">
							<label class="control-label" for="imagem-produto-4">Imagem 4</label>
							<input onchange="DisplayImage(this.files[0], 4, 'image-holder')" name="imagem-produto-4" id="imagem-produto-4" type="file" class="form-control">
						</div>
						<div class="row justify-content-start image-holder" >   
							<div class="col-3"><img class="w-100" src="" alt=""></div>
							<div class="col-3"><img class="w-100" src="" alt=""></div>
							<div class="col-3"><img class="w-100" src="" alt=""></div>
							<div class="col-3"><img class="w-100" src="" alt=""></div>
						</div> 
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button> 
						<button type="submit" onclick="collectData(event); return false;" class="btn btn-theme text-right">Adicionar</button>	
					</div> 
				</form>
			</div>		
		</div>
	</div> 
	<!-- adicionar produto --> 

	<!-- editar produto -->
	<div class="modal fade" id="edit-product" tabindex="-1" aria-labelledby="edit-product" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form class="form-inline" id="edit-product-form" role="form">
					<div class="modal-header">
						<h5 class="modal-title" id="editProductLabel">Editar Produto</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input name="editar-id-produto" type="hidden" value="" id="editar-id-produto" class="form-control">
						<div class="form-group col-md-12 mb-2"> 
							<input name="editar-nome-produto" type="text" id="editar-nome-produto" class="form-control" placeholder="Nome do Produto" autofocus required>
						</div>
						<div class="form-group col-md-12 mb-2"> 
							<textarea name="editar-descricao-produto" id="editar-descricao-produto" placeholder="Descrição do Produto" rows="3" class="form-control"></textarea>
						</div>
						<div class="row mb-2"> 
							<div class="form-group col-md-6 mb-2"> 
								<label class="form-control-label" for="editar-preco-compra">Preço de Compra</label>
								<input name="editar-preco-compra" id="editar-preco-compra" type="number" class="form-control" value="0.00" placeholder="0.00" min="0.01" step="0.01" required>
							</div>
							<div class="form-group col-md-6 mb-2"> 
								<label class="form-control-label" for="editar-preco-venda">Preço de Venda</label>
								<input name="editar-preco-venda" id="editar-preco-venda" type="number" class="form-control" value="0.00" placeholder="0.00" min="0.01" step="0.01" required>
							</div>
						</div>
						<div class="form-group col-md-12 mb-2"> 
							<?php echo $dropdownEditCategories ?>
						</div>
						<div class="row mb-2">
							<div class="form-group col-md-6"> 
								<?php echo $dropdownEditSuppliers ?>
							</div>
							<div class="form-group col-md-6"> 
								<?php echo $dropdownEditBrands ?>
							</div>
						</div> 
						<div class="form-group col-md-12">
							<label class="control-label" for="editar-imagem-produto-1">Imagem</label>
							<input onchange="DisplayImage(this.files[0], 1, 'edit-image-holder')" name="editar-imagem-produto-1" id="editar-imagem-produto-1" type="file" class="form-control">
						</div>
						<div class="form-group col-md-12">
							<label class="control-label" for="editar-imagem-produto-2">Imagem 2</label>
							<input onchange="DisplayImage(this.files[0], 2, 'edit-image-holder')" name="editar-imagem-produto-2" id="editar-imagem-produto-2" type="file" class="form-control">
						</div>
						<div class="form-group col-md-12">
							<label class="control-label" for="editar-imagem-produto-3">Imagem 3</label>
							<input onchange="DisplayImage(this.files[0], 3, 'edit-image-holder')" name="editar-imagem-produto-3" id="editar-imagem-produto-3" type="file" class="form-control">
						</div>
						<div class="form-group col-md-12 mb-2">
							<label class="control-label" for="editar-imagem-produto-4">Imagem 4</label>
							<input onchange="DisplayImage(this.files[0], 4, 'edit-image-holder')" name="editar-imagem-produto-4" id="editar-imagem-produto-4" type="file" class="form-control">
						</div>
						<div class="row justify-content-start edit-image-holder" >   
							<div class="col-3"><img class="w-100" src="" alt=""></div>
							<div class="col-3"><img class="w-100" src="" alt=""></div>
							<div class="col-3"><img class="w-100" src="" alt=""></div>
							<div class="col-3"><img class="w-100" src="" alt=""></div>
						</div> 
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button> 
						<button id="btn-collect-edit-data" type="submit" onclick="collectEditData(event, this); return false;" class="btn btn-theme text-right">Salvar</button>	
					</div>
				</form>
			<div>
		</div>
	</div> 
	<!-- editar produto -->

</div><!-- /row -->

<script type="text/javascript">
	function toggleText(id){
		//removes the linkc  
		document.getElementById('link-' + id).parentElement.removeChild('link-' + id);
		//shows the #more
		document.getElementById('more-' + id).style.display = "block";
	}

	function hideModal(){ 
		const edit_modal = document.querySelector('#add-new-product');
		const modal = bootstrap.Modal.getInstance(edit_modal);    
		modal.hide();
	}

	function hideEditModal(){ 
		const edit_modal = document.querySelector('#edit-product');
		const modal = bootstrap.Modal.getInstance(edit_modal);    
		modal.hide();
	}

	function DisplayImage(file, index, element){ 
		var image_holder = document.querySelector("." + element); 
		var images = image_holder.querySelectorAll("IMG");  
		
		if(images[index - 1]) {
			images[index - 1].src = URL.createObjectURL(file);
		} else {
			newImage = '<div class="col-3"><img class="img-fluid" src="' + URL.createObjectURL(file) + '"></div>'
			image_holder.innerHTML += newImage;
		} 
	} 

	var editModal = document.getElementById('edit-product')

	editModal.addEventListener('show.bs.modal', function (event) {
		// Button that triggered the modal
		var button = event.relatedTarget
		// Extract info from data-bs-* attributes
		var id = button.getAttribute('data-bs-id');
		var title = button.getAttribute('data-bs-title');
		var description = button.getAttribute('data-bs-description');
		var quantity = button.getAttribute('data-bs-quantity');
		var price_sell = button.getAttribute('data-bs-price_sell');
		var price_buy = button.getAttribute('data-bs-price_buy');
		var category = button.getAttribute('data-bs-category');
		var supplier = button.getAttribute('data-bs-supplier');
		var brand = button.getAttribute('data-bs-brand');
		var slug = button.getAttribute('data-bs-slug');
		var urlImage1 = button.getAttribute('data-bs-image');  
		if(button.getAttribute('data-bs-image2')) urlImage2 = button.getAttribute('data-bs-image2');
		if(button.getAttribute('data-bs-image3')) urlImage3 = button.getAttribute('data-bs-image3');
		if(button.getAttribute('data-bs-image4')) urlImage4 = button.getAttribute('data-bs-image4');
		// If necessary, you could initiate an AJAX request here
		// and then do the updating in a callback.
		//
		// Update the modal's content.
		var modalTitle = editModal.querySelector('.modal-title');
		var titleInput = editModal.querySelector('#editar-nome-produto');
		var descriptionInput = editModal.querySelector('#editar-descricao-produto');
		var quantityInput = editModal.querySelector('#editar-quantidade-produto');
		var priceSellInput = editModal.querySelector('#editar-preco-venda');
		var priceBuyInput = editModal.querySelector('#editar-preco-compra');
		var categoryInput = editModal.querySelector('#editar-categoria-produto');
		var supplierInput = editModal.querySelector('#editar-supplier-produto');
		var brandInput = editModal.querySelector('#editar-brand-produto'); 
		var idInput = editModal.querySelector('#editar-id-produto');
  
		modalTitle.textContent = 'Editar Produto:' + title;
		titleInput.value = title;
		descriptionInput.value = description; 
		priceSellInput.value = price_sell;
		priceBuyInput.value = price_buy;
		categoryInput.value = category;
		supplierInput.value = supplier;
		brandInput.value = brand; 
		idInput.value = id;

		//Imagens
		var image_holder = document.querySelector(".edit-image-holder"); 
		var images = image_holder.querySelectorAll("IMG");  
		if(button.getAttribute('data-bs-image')) {
			images[0].src = '<?= ROOT ?>' + urlImage1;
		} 

		if(button.getAttribute('data-bs-image2')) {
			images[1].src = '<?= ROOT ?>' + urlImage2;
		} 

		if(button.getAttribute('data-bs-image3')) {
			images[2].src = '<?= ROOT ?>' + urlImage3;
		} 

		if(button.getAttribute('data-bs-image4')) {
			images[3].src = '<?= ROOT ?>' + urlImage4;
		} 
	})

	function collectData(element){
		element.preventDefault();
		var product_name = document.querySelector("#nome-produto"); 
		var product_description = document.querySelector("#descricao-produto");  

		var product_category = document.querySelector("#categoria-produto"); 

		var product_supplier = document.querySelector("#supplier-produto"); 

		var product_brand = document.querySelector("#brand-produto"); 

		var product_price_sell = document.querySelector("#preco-venda");

		var product_price_buy = document.querySelector("#preco-compra");

		if(product_price_buy.value.trim() == "" || isNaN(product_price_buy.value.trim())){
			alert("Digite um preço de compra válido.");
			return;
		}

		if(product_price_sell.value.trim() == "" || isNaN(product_price_sell.value.trim())){
			alert("Digite um preço de venda válido.");
			return;
		}
 
		var produto_imagem_1 = document.querySelector("#imagem-produto-1");
		var produto_imagem_2 = document.querySelector("#imagem-produto-2");
		var produto_imagem_3 = document.querySelector("#imagem-produto-3");
		var produto_imagem_4 = document.querySelector("#imagem-produto-4");

		if(produto_imagem_1.files.length == 0){
			alert("Envie uma imagem válida.");
			return;
		}

		var data = new FormData(); 

		data.append('title', product_name.value.trim());
		data.append('description', product_description.value.trim()); 
		data.append('category', product_category.value.trim());
		data.append('supplier', product_supplier.value.trim());
		data.append('brand', product_brand.value.trim());
		data.append('price_sell', product_price_sell.value.trim());
		data.append('price_buy', product_price_buy.value.trim());
		data.append('data_type', 'add-product');
		data.append('image_1', produto_imagem_1.files[0]); 
		
		if(produto_imagem_2.files.length > 0){
			data.append('image_2', produto_imagem_2.files[0]); 
		}
		
		if(produto_imagem_3.files.length > 0){
			data.append('image_3', produto_imagem_3.files[0]); 
		}
		
		if(produto_imagem_4.files.length > 0){
			data.append('image_4', produto_imagem_4.files[0]); 
		}

		sendDataFiles(data);
	}

	function collectEditData(evt, element){ 		
		evt.preventDefault();
		var product_id = document.querySelector("#editar-id-produto"); 
		var product_name = document.querySelector("#editar-nome-produto");

		if(!isNaN(product_name.value.trim())){
			alert("Digite um nome de produto válido");
			return;
		}

		var product_description = document.querySelector("#editar-descricao-produto"); 

		var product_category = document.querySelector("#editar-categoria-produto"); 

		var product_supplier = document.querySelector("#editar-supplier-produto"); 

		var product_brand = document.querySelector("#editar-brand-produto"); 

		var product_price_sell = document.querySelector("#editar-preco-venda");
		var product_price_buy = document.querySelector("#editar-preco-compra");

		if(product_price_sell.value.trim() == "" || isNaN(product_price_sell.value.trim())){
			alert("Digite um preço de venda válido.");
			return;
		}  

		if(product_price_buy.value.trim() == "" || isNaN(product_price_buy.value.trim())){
			alert("Digite um preço de compra válido.");
			return;
		}  
		
		var data = new FormData(); 
		var produto_imagem_1 = document.querySelector("#editar-imagem-produto-1");
		if(produto_imagem_1.files.length > 0){
			data.append('image_1', produto_imagem_1.files[0]); 
		}
		
		var produto_imagem_2 = document.querySelector("#editar-imagem-produto-2");
		if(produto_imagem_2.files.length > 0){
			data.append('image_2', produto_imagem_2.files[0]); 
		}
		
		var produto_imagem_3 = document.querySelector("#editar-imagem-produto-3");
		if(produto_imagem_3.files.length > 0){
			data.append('image_3', produto_imagem_3.files[0]); 
		}
		
		var produto_imagem_4 = document.querySelector("#editar-imagem-produto-4"); 
		if(produto_imagem_4.files.length > 0){
			data.append('image_4', produto_imagem_4.files[0]); 
		}
	   
		data.append('id', product_id.value);
		data.append('title', product_name.value.trim());
		data.append('description', product_description.value.trim()); 
		data.append('category', product_category.value.trim());
		data.append('supplier_id', product_supplier.value.trim());
		data.append('brand_id', product_brand.value.trim());
		data.append('price_sell', product_price_sell.value.trim()); 
		data.append('price_buy', product_price_buy.value.trim()); 
		data.append('data_type', 'edit-product');
		 
		sendDataFiles(data);
 
		var produto_imagem_1 = document.querySelector("#imagem-produto-1");
		var produto_imagem_2 = document.querySelector("#imagem-produto-2");
		var produto_imagem_3 = document.querySelector("#imagem-produto-3");
		var produto_imagem_4 = document.querySelector("#imagem-produto-4");
 
		produto_imagem_1.value = '';
		produto_imagem_2.value = '';
		produto_imagem_3.value = '';
		produto_imagem_4.value = '';

		document.getElementById("edit-product-form").reset(); 
		hideEditModal()
	}

	function sendData(data = {}){
		var ajax = new XMLHttpRequest();
 
		ajax.addEventListener('readystatechange', function(){
			if(ajax.readyState == 4 && ajax.status == 200){ 
				handleResult(ajax.responseText);
			}
		});

		ajax.open("POST","<?=ROOT?>ajaxproduct", true); 
		ajax.send(JSON.stringify(data));
	}

	function sendDataFiles(data = {}){
 		var ajax = new XMLHttpRequest();
 
		ajax.addEventListener('readystatechange', function(){
			if(ajax.readyState == 4 && ajax.status == 200){ 
				handleResult(ajax.responseText); 
			}
		});

		ajax.open("POST","<?=ROOT?>ajaxproduct", true);
		ajax.send(data);
	}

	function handleResult(result){ 
		if(result != ""){          
			console.log(result);
			var obj = JSON.parse(result); 
			if(typeof(obj.data_type) != 'undefined'){
				if(obj.data_type == "add-new"){
					if(obj.message_type == 'info'){
						alert(obj.message); 
						var table_body = document.querySelector("#table-body");
						table_body.innerHTML = obj.data;
						hideModal();
					} else {
						alert(obj.message);
					}   
				} else if(obj.data_type == "delete-row"){
					alert(obj.message);
					var table_body = document.querySelector("#table-body");
					table_body.innerHTML = obj.data;
				} else if(obj.data_type == "toggle-status"){
					var table_body = document.querySelector("#table-body");
					table_body.innerHTML = obj.data;
				} else if(obj.data_type == "edit-product"){
					var table_body = document.querySelector("#table-body");
					table_body.innerHTML = obj.data;
					hideEditModal();
				}
			}
		}
	}

	function deleteRow(id){
		if(!confirm("Tem certeza que quer deletar este produto?")){
			return;
		}
  
		sendData({
			data_type: 'delete-row',
			id: id
		});
	}

	function toggleStatus(id){
		sendData({
			data_type: 'toggle-status',
			id: id
		});
	}

	function editRow(id){
		toggleEditModal();
		sendData({
			data_type: 'edit'
		});
	}

</script>

<?php
	$this->view("admin/footer", $data);
?>