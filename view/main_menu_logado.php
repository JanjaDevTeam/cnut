<ul class="nav navbar-nav navbar-right">
	<li><a href="index.html">EXPLORAR</a></li>
	<li class="active"><a href="#">ENVIAR PROJETO</a></li>
	
	<?php 
	// se fb, pega foto do fb
	$sufixo  = isset($_SESSION['fbId']) ? '-fb.jpg' : '.jpg';
	$userpic = 'img/userpics/' . $_SESSION['id'] . $sufixo;
	
	if(!isset($_SESSION['fbId']) && !file_exists($userpic)) {
		$userpic = "img/user-default.jpg";
	}
	
	
	?>
	<li><a href="logout.php">LOGOUT</a></li>
	<li class="userpic"><a href="index.html"><img src="<?= $userpic ?>" class="img-circle"/></a></li>
	
</ul>
