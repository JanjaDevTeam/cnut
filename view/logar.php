<?php if(isset($template['bemvindo'])): ?>
<div class="alert alert-success">
<p><strong>Bem vindo!</strong> Seu cadastro foi ativado e você já pode participar de projetos.</p>
</div>
<?php endif; ?>

<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
			<h1 class="text-center login-title">Logue para participar de projetos!</h1>
			<div class="account-wall">
				<img class="profile-img" src="img/login.png"
				alt="">
				<form class="form-signin">
					<input type="text" class="form-control" placeholder="Email" required autofocus>
					<input type="password" class="form-control" placeholder="Senha" required>
					<button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>
					<a href="<?php echo $loginUrl; ?>"><button class="btn btn-lg btn-primary btn-block btn-fb" type="button">Facebook</button></a>
					
					<a href="#" class="pull-right need-help">Esqueci a senha </a><span class="clearfix"></span>
				</form>
			</div>
			<a href="registrar.php" class="text-center new-account">Criar uma conta </a>
			<br/>
		</div>
	</div>
</div>
