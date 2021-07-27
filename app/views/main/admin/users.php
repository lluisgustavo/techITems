
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
											<input name="editar-rank-user" id="editar-rank-user" type="text" class="form-control">
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
	function hideEditModal(){ 
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
		var supplierNameInput = document.querySelector('#fornecedor-nome');
		var supplierContactInput = document.querySelector('#fornecedor-contato'); 
		var supplierCNPJInput = document.querySelector('#fornecedor-CNPJ'); 
		var supplierEmailInput = document.querySelector('#fornecedor-email'); 
		var supplierPhoneInput = document.querySelector('#fornecedor-telefone');
		var supplierAddressStreetInput = document.querySelector('#fornecedor-endereco-rua'); 
		var supplierAddressNumberInput = document.querySelector('#fornecedor-endereco-numero'); 
		var supplierAddressComplementInput = document.querySelector('#fornecedor-endereco-complemento');  
		var supplierAddressPCInput = document.querySelector('#fornecedor-endereco-CEP');  
		var supplierAddressDistrictInput = document.querySelector('#fornecedor-endereco-bairro');  
		var supplierAddressCityInput = document.querySelector('#fornecedor-endereco-cidade');
		var supplierAddressStateInput = document.querySelector('#fornecedor-endereco-estado'); 
		var supplierAddressCountryInput = document.querySelector('#fornecedor-endereco-pais'); 
		var supplierAddressRefInput = document.querySelector('#fornecedor-endereco-ref'); 

		nameRegex = '/^([a-zA-Zà-úÀ-Ú0-9]|-|_|\s)+$/';
		CNPJRegex = '/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/'
		emailRegex = '/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

		if(supplierNameInput.value.trim().match(nameRegex)){
			alert("Digite um nome de fornecedor válido");
			return false;
		} 

		if(supplierCNPJInput.value.trim().match(CNPJRegex)){
			alert("Digite um nome de fornecedor válido");
			return false;
		}

		if(supplierContactInput.value.trim().match(nameRegex)){
			alert("Digite um nome válido");
			return false;
		}

		if(supplierEmailInput.value.trim().match(emailRegex)){
			alert("Digite um e-mail válido");
			return false;
		} 

		var supplierName = capitalize(supplierNameInput.value.trim());  
		var supplierCNPJ = capitalize(supplierCNPJInput.value.trim());  
		var supplierContact = capitalize(supplierContactInput.value.trim());  
		var supplierEmail = supplierEmailInput.value.trim();
		var supplierPhone = supplierPhoneInput.value.trim();
		var supplierAddressStreet = capitalize(supplierAddressStreetInput.value.trim());
		var supplierAddressNumber = supplierAddressNumberInput.value.trim();
		var supplierAddressComplement = supplierAddressComplementInput.value.trim();
		var supplierAddressPC = supplierAddressPCInput.value.trim();
		var supplierAddressDistrict = supplierAddressDistrictInput.value.trim();
		var supplierAddressCity = supplierAddressCityInput.value.trim();
		var supplierAddressState = supplierAddressStateInput.value.trim();
		var supplierAddressCountry = supplierAddressCountryInput.value.trim();
		var supplierAddressRef = supplierAddressRefInput.value.trim();
		 
		sendData({
			supplier_name: supplierName,
			CNPJ: supplierCNPJ,
			contact_name: supplierContact,
			contact_mail: supplierEmail,
			contact_phone: supplierPhone,
			street: supplierAddressStreet,
			number: supplierAddressNumber,
			complement: supplierAddressComplement,
			district: supplierAddressDistrict,
			city: supplierAddressCity,
			state: supplierAddressState,
			postalcode: supplierAddressPC,
			country: supplierAddressCountry,
			ref: supplierAddressRef,
			data_type: 'add-supplier'
		});
	}

	
	function collectEditData(element){
		var supplierIdInput = document.querySelector('#editar-fornecedor-id');
		var supplierNameInput = document.querySelector('#editar-fornecedor-nome');
		var supplierContactInput = document.querySelector('#editar-fornecedor-contato'); 
		var supplierCNPJInput = document.querySelector('#editar-fornecedor-CNPJ'); 
		var supplierEmailInput = document.querySelector('#editar-fornecedor-email'); 
		var supplierPhoneInput = document.querySelector('#editar-fornecedor-telefone');
		var supplierAddressIdInput = document.querySelector('#editar-fornecedor-endereco-id'); 
		var supplierAddressStreetInput = document.querySelector('#editar-fornecedor-endereco-rua'); 
		var supplierAddressNumberInput = document.querySelector('#editar-fornecedor-endereco-numero'); 
		var supplierAddressComplementInput = document.querySelector('#editar-fornecedor-endereco-complemento');  
		var supplierAddressPCInput = document.querySelector('#editar-fornecedor-endereco-CEP');  
		var supplierAddressDistrictInput = document.querySelector('#editar-fornecedor-endereco-bairro');  
		var supplierAddressCityInput = document.querySelector('#editar-fornecedor-endereco-cidade');
		var supplierAddressStateInput = document.querySelector('#editar-fornecedor-endereco-estado'); 
		var supplierAddressCountryInput = document.querySelector('#editar-fornecedor-endereco-pais'); 
		var supplierAddressRefInput = document.querySelector('#editar-fornecedor-endereco-ref'); 
		 
		nameRegex = '/^([a-zA-Zà-úÀ-Ú0-9]|-|_|\s)+$/';
		CNPJRegex = '/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/'
		emailRegex = '/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

		if(supplierNameInput.value.trim().match(nameRegex)){
			alert("Digite um nome de fornecedor válido");
			return false;
		} 

		if(supplierCNPJInput.value.trim().match(CNPJRegex)){
			alert("Digite um nome de fornecedor válido");
			return false;
		}

		if(supplierContactInput.value.trim().match(nameRegex)){
			alert("Digite um nome válido");
			return false;
		}

		if(supplierEmailInput.value.trim().match(emailRegex)){
			alert("Digite um e-mail válido");
			return false;
		} 

		var supplierId = capitalize(supplierIdInput.value.trim());  
		var supplierName = capitalize(supplierNameInput.value.trim());  
		var supplierCNPJ = capitalize(supplierCNPJInput.value.trim());  
		var supplierContact = capitalize(supplierContactInput.value.trim());  
		var supplierEmail = supplierEmailInput.value.trim();
		var supplierPhone = supplierPhoneInput.value.trim();
		var supplierAddressId = supplierAddressIdInput.value.trim();
		var supplierAddressStreet = capitalize(supplierAddressStreetInput.value.trim());
		var supplierAddressNumber = supplierAddressNumberInput.value.trim();
		var supplierAddressComplement = capitalize(supplierAddressComplementInput.value.trim());
		var supplierAddressPC = supplierAddressPCInput.value.trim();
		var supplierAddressDistrict = capitalize(supplierAddressDistrictInput.value.trim());
		var supplierAddressCity = capitalize(supplierAddressCityInput.value.trim());
		var supplierAddressState = capitalize(supplierAddressStateInput.value.trim());
		var supplierAddressCountry = capitalize(supplierAddressCountryInput.value.trim());
		var supplierAddressRef = capitalize(supplierAddressRefInput.value.trim());
		  
		sendData({
			id: supplierId,
			supplier_name: supplierName,
			CNPJ: supplierCNPJ,
			contact_name: supplierContact,
			contact_mail: supplierEmail,
			contact_phone: supplierPhone,
			address_id: supplierAddressId,
			street: supplierAddressStreet,
			number: supplierAddressNumber,
			complement: supplierAddressComplement,
			district: supplierAddressDistrict,
			city: supplierAddressCity,
			state: supplierAddressState,
			postalcode: supplierAddressPC,
			country: supplierAddressCountry,
			ref: supplierAddressRef,
			data_type: 'edit-supplier'
		});   
	}

	function sendData(data = {}){
		var ajax = new XMLHttpRequest();

		ajax.addEventListener('readystatechange', function(){
			if(ajax.readyState == 4 && ajax.status == 200){
				handleResult(ajax.responseText);
			}
		});

		ajax.open("POST","<?=ROOT?>ajaxsupplier", true);
		ajax.send(JSON.stringify(data));
	}

	function handleResult(result){
		if(result != ""){      
			console.log(result);
			var obj = JSON.parse(result);
			if(typeof(obj.data_type) != 'undefined'){
				if(obj.data_type == "add-supplier"){
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