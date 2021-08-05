
<?php
	$this->view("admin/header", $data);
	$this->view("admin/sidebar", $data);   
?>      

	<div class="container min-h-100">
		<div class="row justify-content-center"> 
			<div class="col-sm-4 mr-5">
				<form method="POST" class="card p-4">
					<div class="image d-flex flex-column justify-content-center align-items-center">
						<img id="profile-image-holder" class="m-2" src="<?= ROOT . $user_data->avatar?>" height="100" width="100" />
						<div class="col mb-2">
							<input type="hidden" value="<?= $user_data->user_id ?>" id="id-editar-imagem" name="id-editar-imagem">
							<input onchange="DisplayImage(this.files[0], 'edit-image-holder')" name="editar-imagem-perfil" id="editar-imagem-perfil" type="file" class="form-control">
						</div>
						<div class="col">
							<button onclick="collectImageData(this); return false" type="submit" class="btn btn-primary">Alterar Imagem</button>
						</div>
						<h4 class="name mt-3"><?=$user_data->name ?></h4>  
						Entrou em <?= date_format(new DateTime($user_data->created_at), "d/m/Y") ?>  
						<!--<div class="mt-3">
							<button onclick="toggleActive(<?= $user_data->user_id ?>); return false" type="submit" class="btn btn-danger">Deletar Conta</button>
						</div> -->
					</div>
				</form>
			</div>
			<div class="col-sm-8">
				<form method="POST" class="card p-4 mb-2"> 
					<div class="form-group row">
						<label for="name-config" class="col-sm-6 col-form-label">Nome</label>
						<div class="col-sm-6 mb-2">
							<input type="text" class="form-control" name="name-config" id="name-config" value="<?= $user_data->name ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="cpf-config" class="col-sm-6 col-form-label">CPF</label>
						<div class="col-sm-6 mb-2">
							<input type="text" class="form-control" name="cpf-config" id="cpf-config" value="<?= $user_data->CPF ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="tel-config" class="col-sm-6 col-form-label">Telefone</label>
						<div class="col-sm-6 mb-2">
							<input type="tel" class="form-control" name="tel-config" id="tel-config" value="<?= $user_data->phone ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="birth-config" class="col-sm-6 col-form-label">Data de Nascimento</label>
						<div class="col-sm-6 mb-2">
							<input type="date" class="form-control" id="birth-config" name="birth-cofnig" value="<?= $user_data->birth ?>">
						</div>
					</div> 
					<button onclick="updatePersonalData(event, <?= $user_data->user_id ?>)" type="submit" class="col-4 mt-2 align-self-end col-4 btn btn-primary">Alterar Dados</button>
				</form>
				<form method="POST" class="card p-4"> 
					<div class="form-group row">
						<label for="email-config" class="col-sm-3 col-form-label">Email</label>
						<div class="col-sm-9">
							<input type="text" readonly class="form-control-plaintext" name="email-usuario" id="email-config" value="<?= $user_data->email ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="senha-config" class="col-sm-3 col-form-label">Senha</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" id="senha-usuario" name="senha-usuario" placeholder="Senha">
						</div>
					</div> 
					<button onclick="updatePass(event, <?= $user_data->user_id ?>)" type="submit" class="col-4 mt-2 align-self-end col-4 btn btn-primary">Alterar Senha</button>
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
		var id_imagem_perfil = document.querySelector("#id-editar-imagem");
		var imagem = document.querySelector("#editar-imagem-perfil");
		var data = new FormData(); 

		data.append('id', id_imagem_perfil.value.trim()); 
		data.append('image', imagem.files[0]); 
		data.append('data_type', 'edit-image'); 

		sendDataFiles(data);
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
 
	function toggleActive(id){
		sendDataFiles({
			data_type: 'toggle-active',
			id: id
		});
	}

function updatePass(e, id){ 
	e.preventDefault();

	if(confirm("Tem certeza que deseja mudar a sua senha?")){
		var password = document.querySelector('#senha-usuario');

		var data = new FormData(); 

		data.append('id', id); 
		data.append('new_password', password.value.trim()); 
		data.append('data_type', 'update-pass'); 

		sendDataFiles(data);
	}
}

function updatePersonalData(e, id){ 
	e.preventDefault();

	if(confirm("Tem certeza que deseja mudar suas informações?")){
		var name = document.querySelector('#name-config');
		var cpf = document.querySelector('#cpf-config');
		var phone = document.querySelector('#tel-config');
		var birth = document.querySelector('#birth-config');

		var data = new FormData(); 

		data.append('id', id); 

		if(name.value.trim() !== "") data.append('name', name.value.trim()); 
		if(cpf.value.trim() !== "") data.append('cpf', cpf.value.trim()); 
		if(phone.value.trim() !== "") data.append('phone', phone.value.trim()); 
		if(birth.value.trim() !== "") data.append('birth', birth.value.trim()); 

		data.append('data_type', 'update-personal'); 

		sendDataFiles(data);
	}
}
		
	function sendDataFiles(data = {}){
 		var ajax = new XMLHttpRequest();
 
		ajax.addEventListener('readystatechange', function(){
			if(ajax.readyState == 4 && ajax.status == 200){ 
				handleResult(ajax.responseText); 
			}
		});

		ajax.open("POST","<?=ROOT?>ajaxuser", true);
		ajax.send(data);
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