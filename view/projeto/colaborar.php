<h2><?=$template['projeto']?></h2>
<br/>
<h4>Participar com a seguinte opção:</h4>
<p><?=$template['descricao']?></p>
<br/>
<p>Valor: R$<?=$template['valor']?></p>
<br/>
<form action='colaborar_moip.php' method='post'>
	<input type="hidden" name="id" value="<?=$template['id']?>"/>
	<input type="submit" class="btn btn-success" value="Apoiar"/>
</form>
<br/>
<button class='btn btn-primary' onclick='window.history.back()'>Voltar</button>
