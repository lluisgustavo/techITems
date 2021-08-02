
<?php
	$this->view("admin/header", $data);
	$this->view("admin/sidebar", $data);
?>      

<div class="container">   
	<div class="col-12 m-3">
		<button type="button" class="btn btn-primary">
			<i class="fa fa-user"></i> Relatório de Clientes 
		</button> 
	</div>
	<div class="col-12 m-3">
		<button type="button" class="btn btn-primary">
			<i class="fas fa-boxes"></i> Relatório de Estoque 
		</button> 
	</div>
	<div class="col-12 m-3">
		<button type="button" class="btn btn-primary">
			<i class="fa fa-people-arrows"></i> Relatório de Fornecedores 
		</button> 
	</div>
	<div class="col-12 m-3">
		<button type="button" class="btn btn-primary">
			<i class="fa fa-reorder"></i> Relatório de Pedidos 
		</button> 
	</div>
	<div class="col-12 m-3">
		<button type="button" class="btn btn-primary">
			<i class="fa fa-barcode"></i> Relatório de Produtos 
		</button> 
	</div>
	<div class="col-12 m-3">
		<button type="button" class="btn btn-primary">
			<i class="fa fa-user"></i> Relatório de Usuários 
		</button>   
	</div>
</div>

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