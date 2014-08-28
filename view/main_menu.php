<ul class="nav navbar-nav navbar-right">
	<li><a href="index.html">EXPLORAR</a></li>
	<li class="active"><a href="#">ENVIAR PROJETO</a></li>
	
	<!-- logado? foto : link -->
	<?php 
	if(isset($_SESSION['id'])) {
		// se fb, pega foto do fb
		$sufixo  = isset($_SESSION['fbId']) ? '-fb.jpg' : '.jpg';
		$userpic = 'img/userpics' . $_SESSION['id'] . $sufixo;
	?>
		<li><a href="logout.php">LOGOUT</a></li>
		<li class="userpic"><a href="index.html"><img src="<?= $userpic ?>" class="img-circle"/></a></li>
	<?php} else { ?>
		<li><a href="logar.php">LOGAR</a></li>
	<?php } ?>
	
	
</ul>
