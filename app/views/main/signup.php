

<?php
	$this->view("header", $data);  
?>
	<div id="signup-page" class="">
		<div class="container px-4 px-lg-5 h-100">
			<div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center"> 
				<div class="col-sm-12 col-md-6">
					<div class="card">
						<div class="card-header">
							<h2>Entre na sua conta</h2>
						</div>
						<div class="card-body"> 
							<div class="row justify-content-center text-center">
								<span style="font-size: 1.5em; font-weight: bold; color: red"><?php check_error() ?></span>
								<div class="col-md-4" style="display: inline-block; float: none">
								</div>
							</div> 
							<form method="POST">
								<div class="mb-3">
									<label for="name">Nome</label>
									<input class="form-control" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : ''?>" type="text" placeholder="Name"/>
								</div>
								<div class="mb-3">
									<label for="email" class="form-label">E-mail</label>
									<input class="form-control" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''?>" type="email" placeholder="Email Address"/>
									<div id="emailHelp" class="form-text">Não compartilharemos seu e-mail com ninguém.</div>
								</div>
								<div class="mb-3">
									<label for="password" class="form-label">Senha</label>
									<input class="form-control" name="password" type="password" placeholder="Senha" />
								</div>
								<div class="mb-3">
									<label for="password-retype" class="form-label">Confirme a senha</label>
									<input class="form-control" name="password-retype" type="password" placeholder="Confirme a Senha" />
								</div> 
								<button type="submit" class="btn btn-primary mb-3">Entrar</button>
							</form>  
						</div>
						<div class="card-footer">
							<p>Não tem uma conta? <a href="<?= ROOT ?>signup">Registre-se</a>
						</div>
					</div>
				</div> 
			</div>
		</div>  
	</div>	
<?php
	$this->view("footer");
?> 