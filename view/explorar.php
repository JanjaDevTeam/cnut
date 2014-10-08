<div class=''>
	<div class='row'>

		<?php foreach($template['projetos'] as $proj): ?>

		<div class='col-sm-4 col-md-3'>
			<div class='card'>

				<div class='col-sm-12'>
					<a href='projeto.php?id=<?=$proj['id']?>'><img src='<?=$proj['coverArt']?>'/></a>
				</div>

				<div class='cardTextoContainer'>
					<div class='col-sm-12 cardNome'>
						<?=$proj['nome']?>
					</div>

					<div class='col-sm-12 cardFrase'>
						<?=$proj['frase']?>
					</div>
					<div class='col-sm-12 cardFinanciado'>
						<strong><?=$proj['pct']?>%</strong>&nbsp;de&nbsp;<strong><?=$proj['valor']?></strong>
					</div>

					<div class='col-sm-12'>
						<div class='barraContainer'>
							<div class='barra' style='width: <?=$proj['pct']?>%'></div>
						</div>
					</div>

					<div class='row'>
						<div class='col-xs-6'>
							<div class='col-sm-12 cardArrecadado'>
								<strong>R$&nbsp;<?=$proj['valorArrecadado']?></strong>
							</div>
							<div class='col-xs-12 cardArrecadado'>
								arrecadado
							</div>
						</div>
						
						<div class='col-sm-6'>
							<div class='col-sm-12 cardArrecadado'>
								<strong><?=$proj['diasRestantes']?></strong>&nbsp;dias
							</div>
							<div class='col-sm-12 cardArrecadado'>
								restantes
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>