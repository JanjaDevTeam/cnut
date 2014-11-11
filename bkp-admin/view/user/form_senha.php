<div class="col-sm-6 col-md-4">
	<p>Digite sua nova senha duas vezes</p>
	<form action="recuperar_senha.php" method="post" name="formRecuperarSenha" onsubmit="return validaRecuperarSenha()">
		<div class="form-group">
			<label for="inputSenha">Senha</label>
			<input name="senha" type="password" class="form-control" id="inputSenha">
		</div>
		<div class="form-group">
			<label for="inputSenha">Repetir senha</label>
			<input name="senha2" type="password" class="form-control" id="inputSenha">
			<input name="token" type="hidden" value="<?=$template['token']?>">
		</div>
		<button type="submit" class="btn btn-success pull-right">Redefinir</button>
		<br/>
	</form>
</div>
