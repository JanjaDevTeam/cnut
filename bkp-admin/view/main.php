<!-- avisos -->
<div class="container">
	<?php if (isset($template['alertaFoto']) && $template['alertaFoto'] == true): ?>
	<div class="alert alert-info">
		<p>Você ainda não tem foto. <a href="userpic.php">Clique aqui</a> para enviar.</p>
	</div>
	<?php endif; ?>
	
	<div class="row destaque">
		<div class="col-sm-4">
			<img src="img/destaque-3.jpg"/>
			<h4>EXPLORE</h4>
		</div>
		<div class="col-sm-4">
			<img src="img/destaque-2.jpg"/>
			<h4>PARTICIPE</h4>
		</div>
		<div class="col-sm-4">
			<img src="img/destaque-1.jpg"/>
			<h4>CRIE UM PROJETO</h4>
		</div>
	</div>
</div>
<!-- /avisos -->
