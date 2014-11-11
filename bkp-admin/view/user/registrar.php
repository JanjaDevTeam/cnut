
<div class="container">
	<h2>Registrar na Solucionática</h2>
	<br/>
	<br/>
</div>
<div class="col-sm-6 col-md-4">
	<?php if (isset($template['erro'])): ?>
	<div class="alert alert-danger" role="alert"><?=$template['erro'][0]?></div>
	<?php endif; ?>
	
	<form method="post" action="registrar.php" name="registro" onsubmit="return validaFormRegistro()">
		<div class="form-group">
			<label for="inputNome">Nome Completo</label>
			<input name="nome" type="text" class="form-control" id="inputNome" >
		</div>
		<div class="form-group">
			<label for="inputEmail">Email</label>
			<input name="email" type="email" class="form-control" id="inputEmail"  >
		</div>
		<div class="form-group">
			<label for="inputPassword">Password</label>
			<input name="senha" type="password" class="form-control" id="inputPassword"  >
		</div>
		<div class="form-group">
			<label for="inputPassword">Password</label>
			<input name="senha2" type="password" class="form-control" id="inputPassword"  >
		</div>
		<button type="submit" class="btn btn-success pull-right">Registrar</button>
		<br/>
	</form>
</div>
