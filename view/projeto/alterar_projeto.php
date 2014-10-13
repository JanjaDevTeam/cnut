<div class="col-sm-8 col-sm-offset-2">
	<form action="alterar_projeto.php" method="post" name="formProjeto" onsubmit="return validateFormProjeto()">
		<div class="form-group">
			<label for="inputNome">Nome do projeto</label>
			<input name="nome" type="text" class="form-control" id="inputNome" value="<?=$template['nome']?>" />
		</div>
		<div class="form-group">
			<label for="inputDescricao">Histórico e como você vai utilizar o valor financiado</label>
			<textarea name="descricao" class="form-control" id="inputDescricao" ><?=$template['descricao']?></textarea>
		</div>
		<div class="form-group">
			<label for="inputFrase">Frase de efeito</label>
			<p>Escolha uma frase impactante para promover seu projeto.</p>
			<input name="frase" type="text" class="form-control" id="inputFrase" value="<?=$template['frase']?>" \>
		</div>
		<div class="form-group">
			<label for="categoria">Categoria</label>
			<select name="categoria" class="form-control" id="categoria" />
				<?php foreach($template['categorias'] as $cat): ?>
					<?php if($cat['id'] == $template['categoria']){$sel="selected";}else{$sel="";}?>
					<option value="<?=$cat['id']?>" <?=$sel?>><?=$cat['categoria']?></option>
				<? endforeach; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="inputValor">Valor pretendido</label>
			<p>Em R$ (reais). Não utilize ponto ou vírgula.</p>
			<input name="valor" type="text" class="form-control" id="inputValor" value="<?=$template['valor']?>" />
		</div>
		<div class="form-group">
			<label for="inputPrazo">Prazo máximo para atingir a meta</label>
			<p>Número de dias. Máximo: 60</p>
			<input name="prazo" type="text" class="form-control" id="inputPrazo" value="<?=$template['prazo']?>" />
		</div>
		<div class="form-group">
			<label for="inputVideo">Video do youtube</label>
			<?php if (isset($template['image'])): ?>
				<br/><img src="<?=$template['image']?>"/>
			<?php endif; ?>
			<p>Ex: https://www.youtube.com/watch?v=<strong>rFOl-9SNxLY</strong></p>
			<p>Coloque somente o código do video, como em negrito no exemplo.</p>
			<input name="video" type="text" class="form-control" id="inputVideo" value="<?=$template['video']?>" />
		</div>
		<div class="form-group">
			<label for="inputLinks">Links relacionados</label>
			<p>Coloque links importantes para seu projeto separados por vírgula e utilize http://</p>
			<p>Exemplo: http://www.google.com, http://www.gmail.com</p>
			<input name="links" type="text" class="form-control" id="inputLinks" value="<?=$template['links']?>" />
		</div>
		<input type="hidden" name="id" value="<?=$template['id']?>"/>
		<input type="submit" value="Alterar" class="btn btn-success pull-right"/>
		<br/>
		<br/>
		<br/>
	</form>
	<a href='projeto.php?id=<?=$template['id']?>' class='btn btn-primary pull-right'>Voltar</a>
	<br/>
	<br/>
	<br/>
	<br/>
</div>
