
<?php
	$this->view("admin/header", $data);
	$this->view("admin/sidebar", $data);
?>      

	<div class="row mt">
		<div class="col-md-12">
			<div class="content-panel">
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-stock-movement">
						<i class="fa fa-plus"></i> Movimentar Estoque
					</button>
					
					<div class="modal fade" id="add-new-stock-movement" tabindex="-1" aria-labelledby="add-new" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="addNewLabel">Movimentar Estoque</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<form class="form-inline" role="form">
									<div class="modal-body">
										<div class="row mb-2">
											<div class="col-md-6 form-group"> 
												<label class="form-label" for="produto-pedido">Produto</label>
												<?php echo $dropdownProducts; ?>
											</div>
											<div class="col-md-6 form-group"> 
												<label class="form-label" for="movement-stock">Quantidade</label>
												<input class="form-control" id="movement-stock" type="number" step="1" required>
											</div>
										</div>
											<div class="col-md-12 form-group"> 
												<label class="form-label" for="obs-stock">Observação</label>
												<textarea class="form-control" id="obs-stock" rows="3"></textarea>
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

				<div class="row">
					<div class="col-6">
			            <div class="table-responsive">
    						<table class="table .table-responsive table-striped table-advance table-hover"> 
    							<div class="mt-2">
    								<h4>Estoque</h4>
    							</div>
    							<thead>
    								<tr> 
    									<th><i class="fa fa-bullhorn"></i> Produto</th>
    									<th><i class="fa fa-table"></i> Quantidade</th>    
    								</tr>
    							</thead>
    							<tbody id="table-body-stock">
    								<?php 
    									echo $tableRowsStock;
    								?>
    							</tbody>
    						</table>
						</div>
					</div>
					<div class="col-6">
			            <div class="table-responsive">
    						<table class="table table-striped table-advance table-hover"> 
    							<div class="mt-2">
    								<h4>Histórico de Movimentação</h4>
    							</div>
    							<thead>
    								<tr> 
    									<th><i class="fa fa-bullhorn"></i> Produto</th>
    									<th><i class="fa fa-table"></i> Quantidade</th>  
    									<th><i class="fa fa-table"></i> Observação</th>  
    								</tr>
    							</thead>
    							<tbody id="table-body-movement">
    								<?php 
    									echo $tableRowsMovement;
    								?>
    							</tbody>
    						</table>
						</div>
					</div>
				</div>
			</div>  
		</div>
	</div> <!-- /row -->

<script type="text/javascript">       
	function hideModal(){ 
		const edit_modal = document.querySelector('#add-new-stock-movement');
		const modal = bootstrap.Modal.getInstance(edit_modal);    
		modal.hide();
	} 
 
	function collectData(element){  
		var productMovementInput = document.querySelector('#produto-pedido'); 
		var movementStockInput = document.querySelector('#movement-stock'); 
		var obsInput = document.querySelector('#obs-stock'); 
 
		var productMovement = productMovementInput.value.trim();
		var movementStock = movementStockInput.value.trim();
		var obs = obsInput.value.trim();
		 
		sendData({ 
			product_id: productMovement,
			movement: movementStock,
			obs: obs,
			data_type: 'add-movement'
		});
	} 

	function sendData(data = {}){
		var ajax = new XMLHttpRequest();

		ajax.addEventListener('readystatechange', function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				handleResult(ajax.responseText);
			}
		});

		ajax.open("POST","<?=ROOT?>ajaxstock", true);
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
					
						var table_body_movement = document.querySelector("#table-body-movement");
						var table_body_stock = document.querySelector("#table-body-stock");
						table_body_movement.innerHTML = obj.data-movement;
						table_body_movement.innerHTML = obj.data-stock;
						hideModal();
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