<ul class="nav navbar-nav navbar-right">
	<li class="<?php if($template['menu']=='explorar'){echo 'active';}?>"><a href="explorar.php"><strong>EXPLORAR</strong></a></li>
	<li class="<?php if($template['menu']=='enviar'){echo 'active';}?>"><a href="enviar_projeto.php"><strong>ENVIAR PROJETO</strong></a></li>
	
	<?php 
	$userpic = Janja::Foto();
	?>
	<li><a href="logout.php"><strong>LOGOUT</strong></a></li>
	<li class="userpic"><a href="perfil.php"><img src="<?= $userpic ?>" class="img-circle"/></a></li>
	
</ul>
