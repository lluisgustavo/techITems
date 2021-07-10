
<?php
	$this->view("admin/header", $data);
	$this->view("admin/sidebar", $data);
?>      

	<div class="row mt">
		<div class="col-md-12">
			<div class="content-panel">
				<table class="table table-striped table-advance table-hover">
					<h4><i class="fa fa-angle-right"></i> Categorias de Produtos  
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-category">
						<i class="fa fa-plus"></i>Adicionar
					</button></h4>
					
					<!-- adicionar categoria -->
					<div class="modal fade" id="add-new-category" tabindex="-1" aria-labelledby="add-new" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="addNewLabel">Adicionar Produto</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<form class="form-inline" role="form">
									<div class="modal-body">
										<div class="form-group">
											<label class="control-label" for="add-category">Nome da Categoria</label>
											<input name="categoria" id="categoria" type="text" class="form-control" placeholder="Nome da Categoria" autofocus required>
										</div>
										<div class="form-group">
											<label class="control-label" for="add-category">Pai (opcional)</label>
											<?php echo $dropdownCategories; ?>
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
					<!-- adicionar categoria -->

					<!-- editar categoria -->
					<div class="modal fade" id="edit-category" tabindex="-1" aria-labelledby="edit-category" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<form class="form-inline" id="edit-product-form" role="form">
									<div class="modal-header">
										<h5 class="modal-title" id="editProductLabel">Editar Produto</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<input name="editar-id-categoria" type="hidden" id="editar-id-categoria" class="form-control">
										<div class="form-group">
											<label class="control-label" for="add-category">Nome da Categoria</label>
											<input name="editar-categoria" id="editar-categoria" type="text" class="form-control" placeholder="Nome da Categoria" autofocus required>
										</div>
										<div class="form-group">
											<label class="control-label" for="editar-pai-categoria">Pai (opcional)</label>
											<?php echo $dropdownEditCategories; ?>
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
					<!-- editar categoria -->
					
					<hr>
					<thead>
						<tr>
							<th><i class="fa fa-bullhorn"></i> Categoria</th>
							<th><i class="fa fa-table"></i> Pai</th>
							<th><i class=" fa fa-edit"></i> Status</th>
							<th><i class=" fa fa-edit"></i> Ação</th>
							<th></th>
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
	</div><!-- /row -->

<script type="text/javascript"> 


	function hideEditModal(){ 
		const edit_modal = document.querySelector('#edit-category');
		const modal = bootstrap.Modal.getInstance(edit_modal);    
		modal.hide();
	}

	var editModal = document.getElementById('edit-category')

	editModal.addEventListener('show.bs.modal', function (event) {
		// Button that triggered the modal
		var button = event.relatedTarget
		// Extract info from data-bs-* attributes
		var id = button.getAttribute('data-bs-id');
		var category = button.getAttribute('data-bs-category');
		var parent = button.getAttribute('data-bs-parent');
		
		// If necessary, you could initiate an AJAX request here
		// and then do the updating in a callback.
		//
		// Update the modal's content.
		var modalTitle = editModal.querySelector('.modal-title');
		var idCategoryInput = editModal.querySelector('#editar-id-categoria'); 
		var categoryInput = editModal.querySelector('#editar-categoria');
		var parentCategoryInput = editModal.querySelector('#editar-pai-categoria'); 

		modalTitle.textContent = 'Editar Categoria:' + category;
		idCategoryInput.value = id;
		categoryInput.value = category;
		parentCategoryInput.value = parent; 
	})
 
	function collectData(element){
		var category_input = document.querySelector("#categoria");
		var parent_input = document.querySelector("#pai-categoria");

		nameRegex = '/^([a-zA-Zà-úÀ-Ú0-9]|-|_|\s)+$/';

		if(category_input.value.trim().match(nameRegex)){
			alert("Digite um nome de categoria válido");
			return false;
		}

		var category = capitalize(category_input.value.trim());
		var parent = "";

		if(parent_input.value.trim() !== "" || !isNaN(parent_input.value.trim())){
			parent = capitalize(parent_input.value.trim());
		}

		sendData({
			category: category,
			parent: parent,
			data_type: 'add-category'
		});
	}

	function collectEditData(element){
		var category_id = document.querySelector("#editar-id-categoria"); 
		var category_input = document.querySelector("#editar-categoria");
		var parent_input = document.querySelector("#editar-pai-categoria");


		if(!isNaN(category_input.value.trim())){
			alert("Digite um nome de categoria válido");
			return false;
		}

		var category = capitalize(category_input.value.trim());
		 
		if(parent_input.value.trim() == "" || !isNaN(parent_input.value.trim())){
			var parent = capitalize(parent_input.value.trim());

			sendData({
				id: category_id.value,
				category: category,
				parent: parent,
				data_type: 'edit-category'
			});
		} else {
			sendData({
				id: category_id.value,
				category: category,
				data_type: 'edit-category'
			});
		}

	}

	function sendData(data = {}){
		var ajax = new XMLHttpRequest();

		ajax.addEventListener('readystatechange', function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				handleResult(ajax.responseText);
			}
		});

		ajax.open("POST","<?=ROOT?>ajaxcategory", true);
		ajax.send(JSON.stringify(data));
	}

	function handleResult(result){
		if(result != ""){      
			//console.log(result);
			var obj = JSON.parse(result);
			if(typeof(obj.data_type) != 'undefined'){
				if(obj.data_type == "add-new"){
					if(obj.message_type == 'info'){
						alert(obj.message); 
					
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
				} else if(obj.data_type == "edit-category"){
					hideEditModal();
					var table_body = document.querySelector("#table-body");
					table_body.innerHTML = obj.data;
				}
			}
		}
	}

	function deleteRow(id){
		if(!confirm("Tem certeza que quer deletar esta categoria?")){
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