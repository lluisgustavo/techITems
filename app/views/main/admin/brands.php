
<?php
	$this->view("admin/header", $data);
	$this->view("admin/sidebar", $data);
?>      

	<div class="row mt">
		<div class="col-md-12">
			<div class="content-panel">
			    <div class="table-responsive">
    				<table class="table table-striped table-advance table-hover">  
    					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-brand">
    						<i class="fa fa-plus"></i>Adicionar Marca
    					</button></h4>
    					
    					<!-- adicionar marca -->
    					<div class="modal fade" id="add-new-brand" tabindex="-1" aria-labelledby="add-new" aria-hidden="true">
    						<div class="modal-dialog">
    							<div class="modal-content">
    								<div class="modal-header">
    									<h5 class="modal-title" id="addNewLabel">Adicionar Marca</h5>
    									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    								</div>
    								<form class="form-inline" role="form">
    									<div class="modal-body">
    										<div class="form-group"> 
    											<input name="marca" id="marca" type="text" class="form-control" placeholder="Nome da Marca" autofocus required>
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
    					<div class="modal fade" id="edit-brand" tabindex="-1" aria-labelledby="edit-brand" aria-hidden="true">
    						<div class="modal-dialog">
    							<div class="modal-content">
    								<form class="form-inline" id="edit-product-form" role="form">
    									<div class="modal-header">
    										<h5 class="modal-title" id="editProductLabel">Editar Produto</h5>
    										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    									</div>
    									<div class="modal-body">
    										<input name="editar-id-marca" type="hidden" id="editar-id-marca" class="form-control">
    										<div class="form-group"> 
    											<input name="editar-marca" id="editar-marca" type="text" class="form-control" placeholder="Nome da Marca" autofocus>
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
    							<th><i class="fa fa-bullhorn"></i> ID</th>
    							<th><i class="fa fa-table"></i> Marca</th>
    							<th><i class=" fa fa-edit"></i> Status</th>
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
	</div><!-- /row -->

<script type="text/javascript">  
	function hideModal(){ 
		const edit_modal = document.querySelector('#add-new-brand');
		const modal = bootstrap.Modal.getInstance(edit_modal);    
		modal.hide();
	}

	function hideEditModal(){ 
		const edit_modal = document.querySelector('#edit-brand');
		const modal = bootstrap.Modal.getInstance(edit_modal);    
		modal.hide();
	}

	var editModal = document.getElementById('edit-brand')

	editModal.addEventListener('show.bs.modal', function (event) {
		// Button that triggered the modal
		var button = event.relatedTarget
		// Extract info from data-bs-* attributes
		var id = button.getAttribute('data-bs-id');
		var category = button.getAttribute('data-bs-brand'); 
		
		// If necessary, you could initiate an AJAX request here
		// and then do the updating in a callback.
		//
		// Update the modal's content.
		var modalTitle = editModal.querySelector('.modal-title');
		var idBrandInput = editModal.querySelector('#editar-id-marca'); 
		var brandInput = editModal.querySelector('#editar-marca'); 

		modalTitle.textContent = 'Editar Categoria:' + category;
		idBrandInput.value = id;
		brandInput.value = category; 
	})
 
	function collectData(element){
		var brand_input = document.querySelector("#marca");  
		var brand = capitalize(brand_input.value.trim());

		sendData({
			brand: brand, 
			data_type: 'add-brand'
		});
	}

	function collectEditData(element){
		var brand_id = document.querySelector("#editar-id-marca"); 
		var brand_input = document.querySelector("#editar-marca"); 
 
		sendData({
			id: brand_id.value,
			brand: brand_input.value.trim(),
			data_type: 'edit-brand'
		}); 
	}

	function sendData(data = {}){
		var ajax = new XMLHttpRequest();

		ajax.addEventListener('readystatechange', function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				handleResult(ajax.responseText);
			}
		});

		ajax.open("POST","<?=ROOT?>ajaxbrand", true);
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
						hideModal();
					
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
				} else if(obj.data_type == "edit-brand"){
					hideEditModal();
					var table_body = document.querySelector("#table-body");
					table_body.innerHTML = obj.data;
				}
			}
		}
	}

	function deleteRow(id){
		if(!confirm("Tem certeza que quer deletar esta marca?")){
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