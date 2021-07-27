
<?php
	$this->view("admin/header", $data);
	$this->view("admin/sidebar", $data);
?>      

	<div class="row mt">
		<div class="col-md-12">
			<div class="content-panel"> 
					<!-- editar user -->
					<div class="modal fade" id="edit-user" tabindex="-1" aria-labelledby="edit-user" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="addNewLabel">Editar Permissão</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<form class="form-inline" role="form">
									<div class="modal-body">
										<input name="id-user" id="id-user" type="hidden">
										
										<div class="form-group"> 
											<select name="editar-rank-user" id="editar-rank-user" type="text" class="form-control">
												<option value="customer">Cliente</option>
												<option value="employee">Colaborador</option>
												<option value="admin">Administrador</option>
											</select>
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
					<!-- editar user -->
				<table class="table table-striped table-advance table-hover">
					<hr>
					<thead>
						<tr>
							<th><i class="fa fa-bullhorn"></i> ID</th>
							<th><i class="fa fa-table"></i> E-mail</th>
							<th><i class=" fa fa-edit"></i> Rank </th>
							<th><i class=" fa fa-edit"></i> Data de Criação </th>  
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
	</div><!-- /row -->

<script type="text/javascript">       
	function hideModal(){ 
		const edit_modal = document.querySelector('#edit-user');
		const modal = bootstrap.Modal.getInstance(edit_modal);    
		modal.hide();
	}

	var editModal = document.getElementById('edit-user')

	editModal.addEventListener('show.bs.modal', function (event) {
		// Button that triggered the modal
		var button = event.relatedTarget
		// Extract info from data-bs-* attributes
		var id = button.getAttribute('data-bs-id');
		var email = button.getAttribute('data-bs-email'); 
		
         // If necessary, you could initiate an AJAX request here
		// and then do the updating in a callback.
		//
		// Update the modal's content.
		var modalTitle = editModal.querySelector('.modal-title');
		var idUserInput = editModal.querySelector('#id-user');   

		modalTitle.textContent = 'Editar Rank de ' + email;
		idUserInput.value = id; 
	})
 
	function collectData(element){ 
		element.preventDefault();
		var idUserInput = document.querySelector('#id-user');
		var rankUserInput = document.querySelector('#editar-rank-user'); 

		var idUser = idUserInput.value.trim();  
		var rankUser = rankUserInput.value.trim();   

		sendData({ 
			id: idUser,
			rank: rankUser,
			data_type: 'change-permission'
		});
	}
 
	function sendData(data = {}){
		var ajax = new XMLHttpRequest();

		ajax.addEventListener('readystatechange', function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				handleResult(ajax.responseText);
			}
		});

		ajax.open("POST","<?=ROOT?>ajaxuser", true);
		ajax.send(JSON.stringify(data));
	}

	function handleResult(result){
		if(result != ""){      
			//console.log(result);
			var obj = JSON.parse(result);
			if(typeof(obj.data_type) != 'undefined'){
				if(obj.data_type == "change-permission"){
					if(obj.message_type == 'info'){
						alert(obj.message); 
					
						hideModal();
						var table_body = document.querySelector("#table-body");
						table_body.innerHTML = obj.data;
					} else {
						alert(obj.message);
					}    
				}
			}
		}
	}  
</script>

<?php
	$this->view("admin/footer", $data);
?>