<h2><?=$template['projeto']?></h2>

<br/>
<br/>
<?php if(isset($template['msg'])): ?>
<div class="alert alert-success"><?=$template['msg']?></div>
<?php endif; ?>
<a href="projeto.php?id=<?=$template['idProjeto']?>" class="btn btn-primary">Voltar</a>
<hr/>
<?php foreach($template['colab'] as $colab): ?>
	<p><?=$colab['descricao']?></p>
	<?php if($colab['qtdTotal'] == 0): ?>
		<p>Quantidade: ilimitada</p>
	<?php else: ?>
		<p>Quantidade: <?=$colab['qtdTotal']?> vagas</p>
	<?php endif; ?>
	
	<form id="delete" action="colaboracao.php" method="post">
		<input type="hidden" name="idProjeto" value="<?=$template['idProjeto']?>"/>
		<input type="hidden" name="idColab" value="<?=$colab['id']?>"/>
		<input type="hidden" name="action" value="del"/>
		<input type="submit" class="btn btn-danger" value="Deletar"/>
	</form>
	<hr/>
<?php endforeach; ?>

<div class="col-sm-6 col-lg-4">
	<h2>Nova colaboração</h2>
	<form id="cadastro" method="post" action="colaboracao.php">
		<div class="form-group">
			<label for="inputValor">Valor (em R$ sem vírgula ou ponto)</label>
			<input name="valor" type="text" class="form-control" id="inputValor" required>
		</div>
		
		<div class="form-group">
			<label for="inputDescricao">Descrição</label>
			<textarea name="descricao" id="inputDescricao" class="form-control" required></textarea>
		</div>
		
		<div class="form-group">
			<label for="inputQtd">Quantidade (0 para ilimitada)</label>
			<input name="quantidade" type="text" class="form-control" id="inputQtd" required>
		</div>
		<input name="idProjeto" type="hidden" value="<?=$template['idProjeto']?>" required>
		<button type="submit" class="btn btn-success pull-right">Registrar</button>
		<br/>
		<br/>
		<br/>
	</form>
</div>
