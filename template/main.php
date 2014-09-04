<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Janja - Coconut</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		
		

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="lib/janja.js"></script>
		<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
		<script>
				tinymce.init({selector:'textarea'});
		</script>

	</head>
	<body>
	
	
	<!-- top bar -->
	<div class="col-xs-12 topbar"></div>
	
	
	<!-- container principal -->
	<div class="container">
		<div class="navbar navbar-default" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="brand" href="index.php">
					<img src="img/logo.png" class="logo"/>
				</a>
			</div>
			
			<div class="navbar-collapse collapse">
				<?php if(isset($_SESSION['id'])) { 
						require_once('view/main_menu_logado.php');
					} else {
						require_once('view/main_menu.php');
					} 
					
				?>
			</div>
		</div>
	</div>
	
	<div class="container">
	<!-- insert data -->
	<?php
	if(isset($template['page'])) { require_once('view/' . $template['page'] . '.php'); }
	?>
	</div>
		
	<!-- footer-->	
	<?php require_once("view/footer.php") ?>
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
