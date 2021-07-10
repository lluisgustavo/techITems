
<?php
	$this->view("header", $data);
?>
	<section id="form"><!--form-->
		<div class="container">
			<div class="row text-center">
				<span style="font-size: 1.5em; font-weight: bold; color: red"><?php check_error() ?></span>
				<div class="col-md-4" style="display: inline-block; float: none">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form method="post">
							<input name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : ''?>" type="text" placeholder="Name"/>
							<input name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''?>" type="email" placeholder="Email Address"/>
							<input name="password" type="password" placeholder="Password"/>
							<input name="password-retype" type="password" placeholder="Retype Password"/>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
<?php
	$this->view("footer");
?>