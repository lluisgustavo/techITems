
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
						<table class="table table-striped table-advance table-hover"> 
							<div class="mt-2">
								<h4>Estoque</h4>
							</div>
							<thead>
								<tr> 
									<th><i class="fa fa-bullhorn"></i> Produto</th>
									<th><i class="fa fa-table"></i> Quantidade</th>    
								</tr>
							</thead>
							<tbody id="table-body">
								<?php 
									echo $tableRowsStock;
								?>
							</tbody>
						</table>
					</div>
					<div class="col-6">
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
							<tbody id="table-body">
								<?php 
									echo $tableRowsMovement;
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>  
		</div>
	</div> <!-- /row -->

<script type="text/javascript">       
	function hideEditModal(){ 
		const edit_modal = document.querySelector('#edit-supplier');
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
			console.log(result);
			var obj = JSON.parse(result);
			if(typeof(obj.data_type) != 'undefined'){
				if(obj.data_type == "add-new"){
					if(obj.message_type == 'info'){
						alert(obj.message); 
					
						hideEditModal();
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
				} else if(obj.data_type == "edit-supplier"){
					hideEditModal();
					var table_body = document.querySelector("#table-body");
					table_body.innerHTML = obj.data;
				}
			}
		}
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

	
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('fornecedor-endereco-rua').value=("");
            document.getElementById('fornecedor-endereco-bairro').value=("");
            document.getElementById('fornecedor-endereco-cidade').value=("");
            document.getElementById('fornecedor-endereco-estado').value=("");
            document.getElementById('fornecedor-endereco-pais').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('fornecedor-endereco-rua').value=(conteudo.logradouro);
            document.getElementById('fornecedor-endereco-bairro').value=(conteudo.bairro);
            document.getElementById('fornecedor-endereco-cidade').value=(conteudo.localidade);
            document.getElementById('fornecedor-endereco-estado').value=(conteudo.uf);
            document.getElementById('fornecedor-endereco-pais').value= "Brasil";
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('fornecedor-endereco-rua').value="...";
                document.getElementById('fornecedor-endereco-bairro').value="...";
                document.getElementById('fornecedor-endereco-cidade').value="...";
                document.getElementById('fornecedor-endereco-estado').value="...";
                document.getElementById('fornecedor-endereco-pais').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    }; 
</script>

<?php
	$this->view("admin/footer", $data);
?>