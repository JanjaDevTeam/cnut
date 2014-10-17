<?php
require_once('view/user/perfil_menu.php');
?>

<br/>

<?php foreach($template['projetos'] as $proj): ?>
	<div class='row container-apoiados'>
		<div class='col-sm-3 col-md-2'><a href="projeto.php?id=<?=$proj['projeto']->getId()?>"><img src='<?=$proj['projeto']->getImage()?>' style="width: 100%;" class=""/></a></div>
		<div class='col-sm-9 col-md-10'>
					<h4>
						<?php if($proj['projeto']->getPorcentagem() >= 100): ?>
						<img src='img/medal.png' class='medal' style="width: 16px;"/>
						<?php endif; ?>
						<a href="projeto.php?id=<?=$proj['projeto']->getId()?>"><?=$proj['projeto']->getNome()?></a>
					</h4>
			
			<p><?=$proj['projeto']->getPorcentagem()?>%</p>
			<p><?=$proj['projeto']->getDiasRestantes()?> dias restantes</p>
		</div>
	</div>
	<hr/>
<?php endforeach; ?>
