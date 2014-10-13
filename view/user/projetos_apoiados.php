<?php
require_once('view/user/perfil_menu.php');
?>

<br/>

<?php foreach($template['projetos'] as $proj): ?>
	<div class='row container-apoiados'>
		<div class='col-sm-2'><img src='<?=$proj['coverArt']?>' style="width: 100%;" class=""/></div>
		<div class='col-sm-10'><h4><a href="projeto.php?id=<?=$proj['id']?>"><?=$proj['nome']?></a></h4></div>
	</div>
	<hr/>
<?php endforeach; ?>
