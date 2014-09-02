<ul class="nav navbar-nav navbar-right">
	<li class="<?php if($template['menu']=='logar'){echo 'active';}?>"><a href="index.html"><strong>EXPLORAR</strong></a></li>
	<li class="<?php if($template['menu']=='enviar'){echo 'active';}?>"><a href="enviar_projeto.php"><strong>ENVIAR PROJETO</strong></a></li>
	
	<?php 
	// se fb, pega foto do fb
	$sufixo  = isset($_SESSION['fbId']) ? '-fb.jpg' : '.jpg';
	$userpic = 'img/userpics/' . $_SESSION['id'] . $sufixo;
	
	if(!isset($_SESSION['fbId']) && !file_exists($userpic)) {
		$userpic = "img/user-default.jpg";
	}
	
	
	?>
	<li><a href="logout.php"><strong>LOGOUT</strong></a></li>
	<li class="userpic"><a href="userpic.php"><img src="<?= $userpic ?>" class="img-circle"/></a></li>
	
</ul>
