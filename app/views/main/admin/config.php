
<?php
	$this->view("admin/header", $data);
	$this->view("admin/sidebar", $data);
?>      

	<div class="container min-h-100">
		<div class="row justify-content-center"> 
			<div class="col-sm-4 mr-5">
				<form class="card p-4">
					<div class="image d-flex flex-column justify-content-center align-items-center">
						<img id="profile-image-holder" class="m-2" src="<?= ASSETS . THEME . $data['user_data']->avatar?>" height="100" width="100" />
						<div class="col mb-2">
							<input onchange="DisplayImage(this.files[0], 'edit-image-holder')" name="editar-imagem-perfil" id="editar-imagem-perfil" type="file" class="form-control">
						</div>
						<div class="col">
							<button onclick="collectImageData(this); return false" type="submit" class="btn btn-primary">Alterar Imagem</button>
						</div>
						<h4 class="name mt-3"><?=$data['user_data']->name ?></h4> 
						<div class="px-2 rounded mt-2"> 
							<span class="join">Entrou em <?= $data['user_data']->created_at ?></span>
						</div>
						<div class="mt-3">
							<button onclick="toggleActive(this); return false" type="submit" class="btn btn-danger">Deletar Conta</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-sm-8">
				<form class="card p-4"> 
					<div class="form-group row">
						<label for="email-config" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
						<input type="text" readonly class="form-control-plaintext" id="email-config" value="<?= $user_data->email ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="senha-config" class="col-sm-2 col-form-label">Senha</label>
						<div class="col-sm-10">
						<input type="password" class="form-control" id="inputPassword" placeholder="Senha">
						</div>
					</div>
					
					<div class="form-group row justify-content-end">
						<div class="col-auto mt-2">
							<button class="btn btn-primary" type="submit">Alterar Senha</button>
						</div>
					</div>
				</form>
			</div>
		</div>  
	</div> 

<script type="text/javascript">       
	function DisplayImage(file){ 
		var image = document.querySelector("#profile-image-holder");  
		image.src = URL.createObjectURL(file); 
	}  
 
	function collectImageData(file){ 
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
</script>

<?php
	$this->view("admin/footer", $data);
?>