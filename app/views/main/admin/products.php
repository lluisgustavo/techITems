
<?php
	$this->view("admin/header", $data);
	$this->view("admin/sidebar", $data); 
?>      
<div class="row mt">
	<div class="col-md-12">
		<div class="content-panel">
			<table class="table table-striped table-advance table-hover">
				<h4><i class="fa fa-angle-right"></i> Produtos 
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-product">
					<i class="fa fa-plus"></i>Adicionar
				</button></h4>
				
				<hr>
				<thead>
					<tr>
						<th class="text-right">ID</th>
						<th><i class="fa fa-bullhorn"></i> Produto</th>
						<th><i class="fa fa-bullhorn"></i> Descrição </th>
						<th><i class="fa fa-bullhorn"></i> Imagem</th>
						<th class="text-right"><i class=""></i> Quantidade</th>
						<th><i class="fa fa-list-alt"></i> Categoria</th>
						<th class="text-right"><i class="fa fa-money"></i> Preço de Compra</th>
						<th class="text-right"><i class="fa fa-money"></i> Preço de Venda</th>
						<th class="text-right"><i class="fa fa-calendar"></i> Data</th>
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
			
		</div><!-- /content-panel -->
	</div><!-- /col-md-12 -->
 
	<!-- adicionar produto -->
	<div class="modal fade" id="add-new-product" tabindex="-1" aria-labelledby="add-new-product" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addNewLabel">Adicionar Produto</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="form-inline" role="form">
					<div class="modal-body">
						<div class="form-group col-md-12"> 
							<input name="nome-produto" type="text" id="nome-produto" class="form-control" placeholder="Nome do Produto" autofocus required>
						</div>
						<div class="form-group col-md-12"> 
							<textarea name="descricao-produto" id="descricao-produto" placeholder="Descrição do Produto" rows="3" class="form-control"></textarea>
						</div>
						<div class="row">
							<div class="form-group col-md-6"> 
								<input name="quantidade-produto" id="quantidade-produto" type="number" class="form-control" value="1" placeholder="0" min='1' step='1' required>
							</div>
							<div class="form-group col-md-6"> 
								<input name="preco-produto" id="preco-produto" type="number" class="form-control" value="0.00" placeholder="0.00" min="0.01" step="0.01" required>
							</div>
							<div class="form-group col-md-6"> 
								<input name="preco-produto" id="preco-produto" type="number" class="form-control" value="0.00" placeholder="0.00" min="0.01" step="0.01" required>
							</div>
						</div>
						<div class="form-group col-md-12"> 
							<?php echo $dropdownCategories ?>
						</div>
						<div class="form-group col-md-12"> 
							<input name="slug-produto" id="slug-produto" type="text" class="form-control"  placeholder="Slug do produto">
						</div>
						<div class="form-group col-md-12">
							<label class="control-label" for="imagem-produto-1">Imagem</label>
							<input onchange="DisplayImage(this.files[0], 1, 'image-holder')" name="imagem-produto-1" id="imagem-produto-1" type="file" class="form-control">
						</div>
						<div class="form-group col-md-12">
							<label class="control-label" for="imagem-produto-2">Imagem 2</label>
							<input onchange="DisplayImage(this.files[0], 2, 'image-holder')" name="imagem-produto-2" id="imagem-produto-2" type="file" class="form-control">
						</div>
						<div class="form-group col-md-12">
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
						<input name="editar-id-produto" type="hidden" id="editar-id-produto" class="form-control">
						<div class="form-group col-md-12"> 
							<input name="editar-nome-produto" type="text" id="editar-nome-produto" class="form-control" placeholder="Nome do Produto" autofocus required>
						</div>
						<div class="form-group col-md-12"> 
							<textarea name="editar-descricao-produto" id="editar-descricao-produto" placeholder="Descrição do Produto" rows="3" class="form-control"></textarea>
						</div>
						<div class="row">
							<div class="form-group col-md-6"> 
								<input name="editar-quantidade-produto" id="editar-quantidade-produto" type="number" class="form-control" value="1" placeholder="0" min='1' step='1' required>
							</div>
							<div class="form-group col-md-6"> 
								<input name="editar-preco-produto" id="editar-preco-produto" type="number" class="form-control" value="0.00" placeholder="0.00" min="0.01" step="0.01" required>
							</div>
						</div>
						<div class="form-group col-md-12"> 
							<?php echo $dropdownEditCategories ?>
						</div>
						<div class="form-group col-md-12"> 
							<input name="editar-slug-produto" id="editar-slug-produto" type="text" class="form-control"  placeholder="Slug do produto">
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
						<button id="btn-collect-edit-data" type="submit" onclick="collectEditData(this); return false;" class="btn btn-theme text-right">Salvar</button>	
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

	function toggleModal(){
		var modal = document.querySelector("#add-new-product");
		var product_name = document.querySelector("#nome-produto");

		if(modal.classList.contains('hide')){
			product_name.focus();
			return modal.classList.remove('hide');
		}

		product_name.value = "";
		return modal.classList.add('hide');
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
		var price = button.getAttribute('data-bs-price');
		var category = button.getAttribute('data-bs-category');
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
		var priceInput = editModal.querySelector('#editar-preco-produto');
		var categoryInput = editModal.querySelector('#editar-categoria-produto');
		var slugInput = editModal.querySelector('#editar-slug-produto');
		var idInput = editModal.querySelector('#editar-id-produto');
  
		modalTitle.textContent = 'Editar Produto:' + title;
		titleInput.value = title;
		descriptionInput.value = description;
		quantityInput.value = quantity;
		priceInput.value = price;
		categoryInput.value = category;
		slugInput.value = slug;
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
		var product_name = document.querySelector("#nome-produto"); 
		var product_description = document.querySelector("#descricao-produto");
  
		var product_quantity = document.querySelector("#quantidade-produto");
		
		if(product_quantity.value.trim() == "" || isNaN(product_quantity.value.trim())){
			alert("Digite uma quantidade válida.");
			return;
		}

		var product_category = document.querySelector("#categoria-produto");
		
		if(product_category.value.trim() == "" || isNaN(product_category.value.trim())){
			alert("Selecione uma categoria válida.");
			return;
		}

		var product_price = document.querySelector("#preco-produto");

		if(product_price.value.trim() == "" || isNaN(product_price.value.trim())){
			alert("Digite um preço válido.");
			return;
		}

		
		var product_slug = document.querySelector("#slug-produto");
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
		data.append('quantity', product_quantity.value.trim());
		data.append('category', product_category.value.trim());
		data.append('price', product_price.value.trim());
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
	
		if(!isNaN(product_slug.value.trim())){
			data.append('slug', product_slug.value.trim());
		}

		sendDataFiles(data);
	}

	function collectEditData(element){ 		
		var product_id = document.querySelector("#editar-id-produto"); 
		var product_name = document.querySelector("#editar-nome-produto");

		if(!isNaN(product_name.value.trim())){
			alert("Digite um nome de produto válido");
			return;
		}

		var product_description = document.querySelector("#editar-descricao-produto");
 
		var product_quantity = document.querySelector("#editar-quantidade-produto");
		
		if(product_quantity.value.trim() == "" || isNaN(product_quantity.value.trim())){
			alert("Digite uma quantidade válida.");
			return;
		}

		var product_category = document.querySelector("#editar-categoria-produto"); 

		var product_price = document.querySelector("#editar-preco-produto");

		if(product_price.value.trim() == "" || isNaN(product_price.value.trim())){
			alert("Digite um preço válido.");
			return;
		}
 
		var product_slug = document.querySelector("#editar-slug-produto");

		if(!isNaN(product_slug.value.trim())){
			alert("Digite um slug de produto válido");
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
		data.append('quantity', product_quantity.value.trim());
		data.append('category', product_category.value.trim());
		data.append('price', product_price.value.trim());
		data.append('slug', product_slug.value.trim());
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
			//console.log(result);
			var obj = JSON.parse(result); 
			if(typeof(obj.data_type) != 'undefined'){
				if(obj.data_type == "add-new"){
					if(obj.message_type == 'info'){
						alert(obj.message);
						toggleModal();
					
						var table_body = document.querySelector("#table-body");
						table_body.innerHTML = obj.data;
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
					hideEditModal();
					var table_body = document.querySelector("#table-body");
					table_body.innerHTML = obj.data;
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