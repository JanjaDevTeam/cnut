<div id="quadroProjeto">
	<div class="container">
		<h2><?=$template['nome']?></h2>
		<h4>(<?=$template['categoria']?>)</h4>
		<br/>
	</div>
	<div class="col-sm-8">
		<div class='youtubeVideo'>
			<iframe src="http://www.youtube.com/embed/<?=$template['video']?>" frameborder="0" allowfullscreen></iframe>
		</div>
		<br/>
		
		<!-- somente logado -->
		<?php if(isset($template['session']) && $template['session'] = 'owner'): ?>
		<?php if(isset($template['msg'])): ?>
		<div class="alert alert-info">
			<p><?=$template['msg']?></p>
		</div>
		<?php endif; ?>
		
		<div class="btn-group">
			<?php if($template['analise'] == 1): ?>
				<a href="#" class="btn btn-danger">Em análise</a>
			<?php else: ?>
				<a href="alterar_projeto.php?id=<?=$template['idProjeto']?>" class="btn btn-default">Alterar</a>
				<?php if(!isset($template['bloqueado'])): ?>
				<a href="analise.php?id=<?=$template['idProjeto']?>" class="btn btn-default">Enviar para análise</a>
				<?php endif; ?>
				<a href="colaboracao.php?id=<?=$template['idProjeto']?>" class="btn btn-default">Apoio</a>
			<?php endif; ?>
			
			
		</div>
		<br/>
		<br/>
		<?php endif; ?>
		<!-- /temp -->
		
		<p class="lead"><?=$template['frase']?></p>
		<p><?=$template['descricao']?></p>
	</div>
	<div class="col-sm-4">
		<h1><?=$template['backers']?></h1><h4> participantes</h4>
		<h1><?=$template['arrecadado']?></h1><h4> de <?=$template['total']?></h4>
		<h1><?=$template['diasRestantes']?></h1><h4>dias restantes</h4>
		
		<br/>
		<button class="btn btn-success apoiarBtn">Apoiar</button>
		<br/>
		
		<div class="quadroProponente">
			<div class="">
				<img src="img/userpics/1.jpg"/>
			</div>
			<div class="quadroProponenteDados">
				<span><?=$template['proponente']?></span>
			</div>
		</div>
		
		<!-- cotas de apoio -->
		<br/>
		
		<?php $count = 0 ?>
		<?php foreach($template['apoio'] as $apoio): ?>
		<?php $count++; ?>
		<div class="quadroApoio">
			<h4><strong>R$<?=$apoio['valor']?></strong></h4>
			<p><?=$apoio['descricao']?></p>
			<?php if(isset($_SESSION['id'])):?>
			<a href="colaborar.php?id=<?=$apoio['id']?>">apoiar</a>
			<?php endif; ?>
			<?php if($count < sizeof($template['apoio'])):?>
			<hr/>
			<?php endif; ?>
		</div>
		<?php endforeach; ?>
		<br/>
		
	</div>
	<br/>
	<br/>
</div>
