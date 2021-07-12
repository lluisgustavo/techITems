
<?php
	$this->view("admin/header", $data);
	$this->view("admin/sidebar", $data);
?>      

	<div class="row mt">
		<div class="col-md-12">
			<div class="content-panel">
				<table class="table table-striped table-advance table-hover">
					<h4><i class="fa fa-angle-right"></i> Fornecedores
					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-supplier">
						<i class="fa fa-plus"></i>Adicionar
					</button></h4>
					
					<!-- adicionar fornecedor -->
					<div class="modal fade" id="add-new-supplier" tabindex="-1" aria-labelledby="add-new-supplier" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="addNewLabel">Adicionar Fornecedor</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<form class="form-inline" role="form">
									<div class="modal-body">
                                        <h4>Fornecedor</h4>
										<div class="form-group">
											<label class="control-label" for="fornecedor-nome">Nome do Fornecedor</label>
											<input name="fornecedor-nome" id="fornecedor-nome" type="text" class="form-control" placeholder="Nome do Fornecedor" autofocus required>
										</div> 
										<div class="form-group">
											<label class="control-label" for="fornecedor-CNPJ">CNPJ</label>
											<input name="fornecedor-CNPJ" id="fornecedor-CNPJ" type="text" class="form-control" placeholder="CNPJ do Fornecedor" required>
										</div>
										<div class="form-group">
											<label class="control-label" for="fornecedor-contato">Nome do Contato</label>
											<input name="fornecedor-contato" id="fornecedor-contato" type="text" class="form-control" placeholder="Nome do Contato" required>
										</div>
										<div class="form-group">
											<label class="control-label" for="fornecedor-contato">E-mail do Contato</label>
											<input name="fornecedor-email" id="fornecedor-email" type="email" class="form-control" placeholder="E-mail do Contato" required>
										</div>
										<div class="form-group">
											<label class="control-label" for="fornecedor-contato">Telefone do Contato</label>
											<input name="fornecedor-telefone" id="fornecedor-telefone" type="tel" class="form-control" placeholder="Telefone do Contato" required>
										</div>

                                        <h4 class="mt-3">Endereço</h4>
                                        <div class="row">
											<div class="form-group col-md-3">
												<label class="control-label" for="fornecedor-endereco-CEP">CEP</label>
												<input onblur="pesquisacep(this.value);" name="fornecedor-endereco-CEP" id="fornecedor-endereco-CEP" type="text" class="form-control" placeholder="CEP" required>
											</div>
											<div class="form-group col-md-9">
												<label class="control-label" for="fornecedor-endereco-rua">Rua</label>
												<input name="fornecedor-endereco-rua" id="fornecedor-endereco-rua" type="text" class="form-control" placeholder="Rua" required>
											</div>
										</div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <label class="control-label" for="fornecedor-endereco-numero">Número</label>
                                                <input name="fornecedor-endereco-numero" id="fornecedor-endereco-numero" type="text" class="form-control" placeholder="Número" required>
                                            </div>
                                            <div class="form-group col-md-9">
                                                <label class="control-label" for="fornecedor-endereco-complemento">Complemento</label>
                                                <input name="fornecedor-endereco-complemento" id="fornecedor-endereco-complemento" type="text" class="form-control" placeholder="Complemento">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="control-label" for="fornecedor-endereco-bairro">Bairro</label>
                                                <input name="fornecedor-endereco-bairro" id="fornecedor-endereco-bairro" type="text" class="form-control" placeholder="Bairro" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="control-label" for="fornecedor-endereco-cidade">Cidade</label>
                                                <input name="fornecedor-endereco-cidade" id="fornecedor-endereco-cidade" type="text" class="form-control" placeholder="Cidade" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="control-label" for="fornecedor-endereco-estado">Estado</label>
                                                <input name="fornecedor-endereco-estado" id="fornecedor-endereco-estado" type="text" class="form-control" placeholder="Estado" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label" for="fornecedor-endereco-pais">País</label>
                                                <input name="fornecedor-endereco-pais" id="fornecedor-endereco-pais" type="text" class="form-control" placeholder="País" required>
                                            </div>
                                        </div>
										<div class="form-group">
											<label class="control-label" for="fornecedor-endereco-ref">Referência</label>
											<input name="fornecedor-endereco-ref" id="fornecedor-endereco-ref" type="text" class="form-control">
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
					<!-- adicionar fornecedor -->

					<!-- editar fornecedor -->
					<div class="modal fade" id="edit-supplier" tabindex="-1" aria-labelledby="edit-supplier" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<form class="form-inline" id="edit-product-form" role="form">
									<div class="modal-header">
										<h5 class="modal-title" id="editProductLabel">Editar Fornecedor</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
                                        <h4>Fornecedor</h4>
                                        <input name="editar-fornecedor-id" id="editar-fornecedor-id" type="hidden" class="form-control">
										<div class="form-group">
											<label class="control-label" for="editar-fornecedor-nome">Nome do Fornecedor</label>
											<input name="editar-fornecedor-nome" id="editar-fornecedor-nome" type="text" class="form-control" placeholder="Nome do Fornecedor" autofocus required>
										</div> 
										<div class="form-group">
											<label class="control-label" for="editar-fornecedor-CNPJ">CNPJ</label>
											<input name="editar-fornecedor-CNPJ" id="editar-fornecedor-CNPJ" type="text" class="form-control" placeholder="CNPJ do Fornecedor" required>
										</div>
										<div class="form-group">
											<label class="control-label" for="editar-fornecedor-contato">Nome do Contato</label>
											<input name="editar-fornecedor-contato" id="editar-fornecedor-contato" type="text" class="form-control" placeholder="Nome do Contato" required>
										</div>
										<div class="form-group">
											<label class="control-label" for="editar-fornecedor-email">E-mail do Contato</label>
											<input name="editar-fornecedor-email" id="editar-fornecedor-email" type="email" class="form-control" placeholder="E-mail do Contato" required>
										</div>
										<div class="form-group">
											<label class="control-label" for="editar-fornecedor-telefone">Telefone do Contato</label>
											<input name="editar-fornecedor-telefone" id="editar-fornecedor-telefone" type="tel" class="form-control" placeholder="Telefone do Contato" required>
										</div>

                                        <h4 class="mt-3">Endereço</h4>
										<input name="editar-fornecedor-endereco-id" id="editar-fornecedor-endereco-id" type="hidden" class="form-control">
										<div class="form-group">
											<label class="control-label" for="editar-fornecedor-endereco-rua">Rua</label>
											<input name="editar-fornecedor-endereco-rua" id="editar-fornecedor-endereco-rua" type="text" class="form-control" placeholder="Rua" required>
										</div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <label class="control-label" for="editar-fornecedor-endereco-numero">Número</label>
                                                <input name="editar-fornecedor-endereco-numero" id="editar-fornecedor-endereco-numero" type="text" class="form-control" placeholder="Número" required>
                                            </div>
                                            <div class="form-group col-md-9">
                                                <label class="control-label" for="editar-fornecedor-endereco-complemento">Complemento</label>
                                                <input name="editar-fornecedor-endereco-complemento" id="editar-fornecedor-endereco-complemento" type="text" class="form-control" placeholder="Complemento">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="control-label" for="editar-fornecedor-endereco-CEP">CEP</label>
                                                <input name="editar-fornecedor-endereco-CEP" id="editar-fornecedor-endereco-CEP" type="text" class="form-control" placeholder="CEP" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="control-label" for="editar-fornecedor-endereco-bairro">Bairro</label>
                                                <input name="editar-fornecedor-endereco-bairro" id="editar-fornecedor-endereco-bairro" type="text" class="form-control" placeholder="Bairro" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="control-label" for="editar-fornecedor-endereco-cidade">Cidade</label>
                                                <input name="editar-fornecedor-endereco-cidade" id="editar-fornecedor-endereco-cidade" type="text" class="form-control" placeholder="Cidade" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="control-label" for="editar-fornecedor-endereco-estado">Estado</label>
                                                <input name="editar-fornecedor-endereco-estado" id="editar-fornecedor-endereco-estado" type="text" class="form-control" placeholder="Estado" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label" for="editar-fornecedor-endereco-pais">País</label>
                                                <input name="editar-fornecedor-endereco-pais" id="editar-fornecedor-endereco-pais" type="text" class="form-control" placeholder="País" required>
                                            </div>
                                        </div>
										<div class="form-group">
											<label class="control-label" for="editar-fornecedor-endereco-ref">Referência</label>
											<input name="editar-fornecedor-endereco-ref" id="editar-fornecedor-endereco-ref" type="text" class="form-control" placeholder="" required>
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
					<!-- editar fornecedor -->
					
					<hr>
					<thead>
						<tr>
							<th><i class="fa fa-bullhorn"></i> ID</th>
							<th><i class="fa fa-table"></i> Fornecedor</th>
							<th><i class=" fa fa-edit"></i> Contato </th>
							<th><i class=" fa fa-edit"></i> E-Mail </th>
							<th><i class=" fa fa-edit"></i> Telefone </th>
							<th><i class=" fa fa-edit"></i> Endereço </th>
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
			</div><!-- /content-panel -->
		</div><!-- /col-md-12 -->
	</div><!-- /row -->

<script type="text/javascript">       
	function hideEditModal(){ 
		const edit_modal = document.querySelector('#edit-supplier');
		const modal = bootstrap.Modal.getInstance(edit_modal);    
		modal.hide();
	}

	var editModal = document.getElementById('edit-supplier')

	editModal.addEventListener('show.bs.modal', function (event) {
		// Button that triggered the modal
		var button = event.relatedTarget
		// Extract info from data-bs-* attributes
		var id = button.getAttribute('data-bs-id');
		var supplier = button.getAttribute('data-bs-supplier');
		var CNPJ = button.getAttribute('data-bs-CNPJ');
		var contact = button.getAttribute('data-bs-contact');
		var email = button.getAttribute('data-bs-email');
		var phone = button.getAttribute('data-bs-phone');
		var address_id = button.getAttribute('data-bs-address_id');
		var address_street = button.getAttribute('data-bs-address_street');
		var address_no = button.getAttribute('data-bs-address_no');
		var address_complement = button.getAttribute('data-bs-address_complement');
		var address_district = button.getAttribute('data-bs-address_district');
		var address_city = button.getAttribute('data-bs-address_city');
		var address_state = button.getAttribute('data-bs-address_state');
		var address_postalcode = button.getAttribute('data-bs-address_postalcode');
		var address_country = button.getAttribute('data-bs-address_country');
		var address_ref = button.getAttribute('data-bs-address_ref');
		
         // If necessary, you could initiate an AJAX request here
		// and then do the updating in a callback.
		//
		// Update the modal's content.
		var modalTitle = editModal.querySelector('.modal-title');
		var idSupplierInput = editModal.querySelector('#editar-fornecedor-id'); 
		var supplierNameInput = editModal.querySelector('#editar-fornecedor-nome');
		var supplierCNPJInput = editModal.querySelector('#editar-fornecedor-CNPJ');
		var supplierContactInput = editModal.querySelector('#editar-fornecedor-contato'); 
		var supplierEmailInput = editModal.querySelector('#editar-fornecedor-email'); 
		var supplierPhoneInput = editModal.querySelector('#editar-fornecedor-telefone');
		var supplierAddressIDInput = editModal.querySelector('#editar-fornecedor-endereco-id'); 
		var supplierAddressStreetInput = editModal.querySelector('#editar-fornecedor-endereco-rua'); 
		var supplierAddressNumberInput = editModal.querySelector('#editar-fornecedor-endereco-numero'); 
		var supplierAddressComplementInput = editModal.querySelector('#editar-fornecedor-endereco-complemento');
		var supplierAddressPCInput = editModal.querySelector('#editar-fornecedor-endereco-CEP'); 
		var supplierAddressDistrictInput = editModal.querySelector('#editar-fornecedor-endereco-bairro'); 
		var supplierAddressCityInput = editModal.querySelector('#editar-fornecedor-endereco-cidade');
		var supplierAddressStateInput = editModal.querySelector('#editar-fornecedor-endereco-estado'); 
		var supplierAddressCountryInput = editModal.querySelector('#editar-fornecedor-endereco-pais');
		var supplierAddressRefInput = editModal.querySelector('#editar-fornecedor-endereco-ref');

		modalTitle.textContent = 'Editar Fornecedor: ' + supplier;
		idSupplierInput.value = id;
		supplierNameInput.value = supplier;
		supplierCNPJInput.value = CNPJ;
		supplierContactInput.value = contact; 
		supplierEmailInput.value = email;
		supplierPhoneInput.value = phone;
		supplierAddressIDInput.value = address_id;
		supplierAddressStreetInput.value = address_street;
		supplierAddressNumberInput.value =address_no;
		supplierAddressComplementInput.value = address_complement;
		supplierAddressPCInput.value = address_postalcode;
		supplierAddressDistrictInput.value = address_district;
		supplierAddressCityInput.value = address_city;
		supplierAddressStateInput.value = address_state;
		supplierAddressCountryInput.value = address_country;
		supplierAddressRefInput.value = address_ref;
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