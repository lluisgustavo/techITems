
<?php
	$this->view("admin/header", $data);
	$this->view("admin/sidebar", $data);
 
?>      

	<div class="row mt">
		<div class="col-md-12">
			<div class="content-panel">
				<table class="table table-striped table-advance table-hover">   
					<!-- editar categoria -->
					<div class="modal fade" id="edit-category" tabindex="-1" aria-labelledby="edit-order" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<form class="form-inline" id="edit-product-form" role="form">
									<div class="modal-header">
										<h5 class="modal-title" id="editProductLabel">Editar Pedido</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<input name="editar-id-categoria" type="hidden" id="editar-id-categoria" class="form-control">
										<div class="form-group"> 
											<input name="editar-categoria" id="editar-categoria" type="text" class="form-control" placeholder="Nome da Categoria" autofocus required>
										</div>
										<div class="form-group"> 
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
							<th><i class="fa fa-bullhorn"></i> Pedido</th>
							<?php if($user_data->rank === "admin" || $user_data->rank === "employee"): ?>
								<th><i class=" fa fa-user"></i> Pessoa</th> 
							<?php endif; ?>
							<th><i class=" fa fa-edit"></i> Produtos</th>
							<th><i class="fa fa-table"></i> Valor Total</th>
							<?php if($user_data->rank === "admin" || $user_data->rank === "employee"): ?>
								<th><i class=" fa fa-edit"></i> Ação</th> 
							<?php endif; ?>
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
 
	function cancelOrder(id){
		if(!confirm("Tem certeza que quer cancelar este pedido?")){
			return;
		}

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