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
		<link rel="stylesheet" href="http://jcrop-cdn.tapmodo.com/v0.9.12/css/jquery.Jcrop.css" type="text/css" />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
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
    <!-- jCrop -->
    <script src="http://jcrop-cdn.tapmodo.com/v0.9.12/js/jquery.Jcrop.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
    <script src="js/bootstrap.file-input.js"></script>
    <script language="Javascript">
		$('input[type=file]').bootstrapFileInput();
		$('.file-inputs').bootstrapFileInput();
	</script>
    
	
	<script language="Javascript">

		jQuery(function(){

			jQuery('#target').Jcrop({
				aspectRatio: 1,
				onSelect: updateCoords,
			});

		});

		function updateCoords(c)
		{
			jQuery('#x').val(c.x);
			jQuery('#y').val(c.y);
			jQuery('#w').val(c.w);
			jQuery('#h').val(c.h);
		};

		function checkCoords()
		{
			document.getElementById("screen_width").value = jQuery('#target').outerWidth();
			if (parseInt(jQuery('#w').val())>0) return true;
			alert('Por favor, selecione a região a ser cortada.');
			return false;
		};
	</script>
	<?php /*
	<script language="Javascript">
		
				var img = document.getElementById('target');
				document.getElementById("screen_width").value = img.width;
			</script>
	*/ ?>
  </body>
</html>
