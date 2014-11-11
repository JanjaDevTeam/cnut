<div id="quadroProjeto">
	<div class="container">
		<?php if(isset($template['action']) && $template['action']=='alt'):?>
		<div class="alert alert-success"><p>Projeto alterado com sucesso.</p></div>
		<?php endif; ?>
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
			

			<?php if($template['ativo'] == 0): ?>
				<div class="btn-group">
					<?php if($template['analise'] == 1): ?>
						<a href="#" class="btn btn-danger">Em análise</a>
					<?php else: ?>
						<a href="alterar_projeto.php?id=<?=$template['idProjeto']?>" class="btn btn-default">Alterar</a>
						<?php if(!isset($template['bloqueado'])): ?>
						<a href="analise.php?id=<?=$template['idProjeto']?>" class="btn btn-default">Enviar para análise</a>
						<?php endif; ?>
						<a href="colaboracao.php?id=<?=$template['idProjeto']?>" class="btn btn-default">Valores de apoio</a>
					<?php endif; ?>
				</div>
				<br/>
				<br/>
			<?php endif; ?>
		<?php endif; ?>
		<!-- /temp -->
		
		<p class="lead"><?=$template['frase']?></p>
		<p><?=$template['descricao']?></p>
		<br/>
		<br/>
		<br/>
	</div>
	<div class="col-sm-4">
		<h1><?=$template['backers']?></h1><h4> participantes</h4>
		<h1>R$ <?=$template['arrecadado']?></h1><h4> de R$ <?=$template['total']?></h4>
		<h1><?=$template['diasRestantes']?></h1><h4>dias restantes</h4>

		<div class=''>
			<br/>
			<p><?=$template['pct']?> % arrecadado</p>
			<div class='barraContainer'>
				<?php 
				$barra = ($template['pct'] > 100)? 100 : $template['pct'];
				?>
				<div class='barra' style='width: <?=$barra?>%'></div>
			</div>
		</div>
		
		<?php if($template['arrecadado'] >= $template['total']): ?>
		<div class='alert alert-success'><p><img src='img/medal.png'/>  &nbsp;&nbsp;Projeto financiado com sucesso!</p></div>
		<?php endif; ?>
		
		<div class="quadroProponente">
			<div class="">
				<img src="<?=$template['fotoProponente']?>"/>
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
			<?php if($apoio['qtdTotal'] == 0): ?>
			<p>(ilimitado)</p>
			<?php else: ?>
			<p> (<?=$apoio['qtdComprada']?> de <?=$apoio['qtdTotal']?>)</p>
			<?php endif; ?>

			<?php if(isset($_SESSION['id']) && $template['ativo'] == 1 && $template['diasRestantes'] > 0):?>
					
					<a href="colaborar.php?id=<?=$apoio['id']?>">apoiar</a>
					
				
			<?php endif; ?>


			<?php if($count < sizeof($template['apoio'])):?>
			<hr/>
			<?php endif; ?>
		</div>
		<?php endforeach; ?>
		<br/>
		<div id="chart_div" style=""></div>

		
	</div>
	<br/>
	<br/>
</div>

