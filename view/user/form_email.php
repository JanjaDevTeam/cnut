<div class="col-sm-6 col-md-4">
	<p>Enviar email para definir nova senha.</p>
	<form action="recuperar_senha.php" method="post" name="formEmail" onsubmit="return validaFormEmail()">
		<div class="form-group">
			<label for="inputEmail">Email</label>
			<input name="email" type="email" class="form-control" id="inputEmail"/>
		</div>
		<button type="submit" class="btn btn-success pull-right">Enviar</button>
		<br/>
	</form>
</div>
