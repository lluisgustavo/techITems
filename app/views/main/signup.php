

<?php
	$this->view("header", $data);  
?>
	<div id="signup-page" class="min-h-100 h-100">  
				<div class="card mt-5">
					<div class="card-header">
						<h2>Registre-se</h2>
					</div>
					<div class="card-body">
						<div class="row justify-content-center text-center">
							<span style="font-size: 1.5em; font-weight: bold; color: red"><?php check_error() ?></span>
							<div class="col-md-4" style="display: inline-block; float: none">
							</div>
						</div> 
						<form method="POST">
							<div class="row justify-content-center">
								<div class="col-md-6">
									<h4>Conta</h4>
									<div class="mb-1">
										<label for="email" class="form-label">E-mail</label>
										<input class="form-control" name="register-email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''?>" type="email" placeholder="Email" required/>
										<div id="emailHelp" class="form-text">Não compartilharemos seu e-mail com ninguém.</div>
									</div>
									<div class="mb-1">
										<label for="password" class="form-label">Senha</label>
										<input class="form-control" name="password" type="password" placeholder="Senha" required/>
									</div>
									<div class="mb-1">
										<label for="password-retype" class="form-label">Confirme a senha</label>
										<input class="form-control" name="password-retype" type="password" placeholder="Confirme a Senha" required/>
									</div> 
								</div>
								<div class="col-md-6"> 
									<h4>Dados Pessoais</h4>
									<div class="row">
										<div class="col-md-8 mb-1"> 
											<input class="form-control" name="register-name" value="<?= isset($_POST['name']) ? $_POST['name'] : ''?>" type="text" placeholder="Nome" required/>
										</div>
										<div class="col-md-4 mb-1"> 
											<input class="form-control" id="register-tel" name="register-tel" type="text" placeholder="Telefone" required/>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 mb-1"> 
											<input onblur="ValidaCPF(this)" class="form-control" id="register-CPF" name="register-CPF" type="text" placeholder="CPF" required/>
										</div>
										<div class="col-md-8 mb-1"> 
											<input class="form-control" name="register-birth" value="" type="date" placeholder="Data de Nascimento" required/>
										</div>
									</div>
									<h5>Endereço</h5>
									<div class="row">
										<div class="col-md-3 mb-1">  
											<input onblur="pesquisacep(this.value)" class="form-control" id="register-CEP" name="register-CEP" type="text" placeholder="CEP" required/>
										</div>
										<div class="col-md-9 mb-1"> 
											<input class="form-control" id="register-street" name="register-street" value="" type="text" placeholder="Nome da Rua" required/> 
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 mb-1"> 
											<input class="form-control" id="register-number" name="register-number" type="text" placeholder="Número da casa" required/>
										</div>
										<div class="col-md-6 mb-1"> 
											<input class="form-control" id="register-complement" name="register-complement" value="" type="email" placeholder="Complemento"/> 
										</div>
										<div class="col-md-3 mb-1"> 
											<input class="form-control" id="register-district" name="register-district" type="text" placeholder="Bairro" required/>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 mb-1"> 
											<input class="form-control" id="register-city" name="register-city" type="text" placeholder="Cidade" required/>
										</div>
										<div class="col-md-4 mb-1"> 
											<input class="form-control" id="register-state" name="register-state" type="text" placeholder="Estado" required/>
										</div> 
										<div class="col-md-4 mb-1"> 
											<input class="form-control" id="register-country" name="register-country" type="text" placeholder="País" required/>
										</div>
									</div> 
									<div class="row"> 
										<div class="col-md-12 mb-1"> 
											<input class="form-control" id="register-ref" name="register-ref" type="text" placeholder="Referência"/>
										</div>
									</div> 
								</div>
							</div>		 
							<button class="btn btn-primary justify-self-center" type="submit">Registrar</button>
						</form>  
					</div>
					<div class="card-footer">
				</div>
			</div> 
	</div>	

	<script>  
	function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('register-street').value=("");
            document.getElementById('register-district').value=("");
            document.getElementById('register-city').value=("");
            document.getElementById('register-state').value=("");
            document.getElementById('register-country').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('register-street').value=(conteudo.logradouro);
            document.getElementById('register-district').value=(conteudo.bairro);
            document.getElementById('register-city').value=(conteudo.localidade);
            document.getElementById('register-state').value=(conteudo.uf);
            document.getElementById('register-country').value= "Brasil";
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
                document.getElementById('register-street').value="...";
                document.getElementById('register-district').value="...";
                document.getElementById('register-city').value="...";
                document.getElementById('register-state').value="...";
                document.getElementById('register-country').value="...";

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

	ValidaCPF = function(element){
		if($(element).val().trim() == '') return false;
		var Soma;
		var Resto;
		var CPF = $(element).val().trim();
		CPF = CPF.replace(/\./g,'');
		CPF = CPF.replace(/-/g,'');
		Soma = 0;

		if (CPF == "00000000000" || CPF == "11111111111" || CPF == "22222222222" || CPF == "33333333333" ||
			CPF == "44444444444" || CPF == "55555555555" || CPF == "66666666666" || CPF == "77777777777" ||
			CPF == "88888888888" || CPF == "99999999999") {
			if($('.validaCPF')) $('.validaCPF').remove()
			$(element).after('<small class="w-100 validaCPF text-danger">CPF inválido<small>');
			return false;
		}

		for (i=1; i<=9; i++) Soma = Soma + parseInt(CPF.substring(i-1, i)) * (11 - i);

		Resto = (Soma * 10) % 11;

		if ((Resto == 10) || (Resto == 11))  Resto = 0;

		if (Resto != parseInt(CPF.substring(9, 10)) ){
			if($('.validaCPF')) $('.validaCPF').remove()
			$(element).after('<small class="w-100 validaCPF text-danger">CPF inválido<small>');
			return false;
		}
		Soma = 0;
		for (i = 1; i <= 10; i++) Soma = Soma + parseInt(CPF.substring(i-1, i)) * (12 - i);
		Resto = (Soma * 10) % 11;
		if ((Resto == 10) || (Resto == 11))  Resto = 0;
		if (Resto != parseInt(CPF.substring(10, 11) ) ){
			if($('.validaCPF')) $('.validaCPF').remove()
			$(element).after('<small class="w-100 validaCPF text-danger">CPF inválido<small>');
			return false;
		}
		if($('.validaCPF')) $('.validaCPF').remove()
		return true;
	}
</script>
	</script>
<?php
	$this->view("footer");
?> 