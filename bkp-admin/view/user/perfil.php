<?php
require_once('view/user/perfil_menu.php');
?>

<br/>
<div class='row'>
	<div class='col-sm-3 col-md-2'>
		<img src='<?=$template['foto']?>' class='img-rounded perfil-pic' />
		<br/>
		<?php if(!isset($_SESSION['fbId'])): ?>
		<a href='userpic.php'>atualizar foto</a>
		<?php endif;?>
	</div>

	<div class='col-sm-9 col-md-10'>
		<h2><?=$template['nome']?></h2>
		<p><?=$template['email']?></p>
	</div>
</div>



