<div class="col-sm-8 col-sm-offset-2">
	<form action="form_projeto.php" method="post">
		<div class="form-group">
			<label for="inputNome">Nome do projeto</label>
			<input name="nome" type="text" class="form-control" id="inputNome" required>
		</div>
		<div class="form-group">
			<label for="inputDescricao">Histórico e como você vai utilizar o valor financiado</label>
			<textarea name="descricao" class="form-control" id="inputDescricao" required></textarea>
		</div>
		<div class="form-group">
			<label for="inputFrase">Frase de efeito</label>
			<p>Escolha uma frase impactante para promover seu projeto.</p>
			<input name="frase" type="text" class="form-control" id="inputFrase" required>
		</div>
		<div class="form-group">
			<label for="categoria"Categoria</label>
			<select name="categoria" class="form-control" id="categoria" required>
				<?php foreach($template['categorias'] as $cat): ?>
				<option value="<?=$cat['id']?>"><?=$cat['categoria']?></option>
				<? endforeach; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="inputValor">Valor pretendido</label>
			<p>Em R$ (reais). Não utilize ponto ou vírgula.</p>
			<input name="valor" type="text" class="form-control" id="inputValor" required>
		</div>
		<div class="form-group">
			<label for="inputPrazo">Prazo máximo para atingir a meta</label>
			<p>Número de dias. Máximo: 60</p>
			<input name="prazo" type="text" class="form-control" id="inputPrazo" required>
		</div>
		<div class="form-group">
			<label for="inputVideo">Video do youtube</label>
			<p>Ex: https://www.youtube.com/watch?v=rFOl-9SNxLY</p>
			<input name="video" type="text" class="form-control" id="inputVideo" required>
		</div>
		<div class="form-group">
			<label for="inputLinks">Links relacionados</label>
			<p>Coloque links importantes para seu projeto separados por vírgula e utilize http://</p>
			<p>Exemplo: http://www.google.com, http://www.gmail.com</p>
			<input name="links" type="text" class="form-control" id="inputLinks" required>
		</div>
		<input type="submit" value="Enviar" class="btn btn-success pull-right">
		<br/>
		<br/>
		<br/>
	</form>
</div>
