<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Janja - Coconut</title>


		<!-- Bootstrap -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/admin.css" rel="stylesheet">
		


		
		
		

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="lib/janja.js"></script>
		

	</head>
	<body>



		<div class='container'>
			<nav class="navbar navbar-default" role="navigation">
			  <div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="admin.php">Solucionática</a>
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav">
			      	<li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Projetos <span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="adm_projetos_abertos.php">Abertos</a></li>
			            <li><a href="adm_projetos_ativos.php">Ativos</a></li>
			            <li class="divider"></li>
			            <li><a href="#">Relatório</a></li>
			          </ul>
			        </li>
			        <li class="active"><a href="#">MoIP</a></li>
			        <li><a href="#">Notificações</a></li>
			        
			      </ul>
			      <ul class="nav navbar-nav navbar-right">
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$template['username']?> <span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="logout.php">Logout</a></li>
			          </ul>
			        </li>
			      </ul>

			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>

			<!-- content -->
			<?php
			if(isset($template['page'])) { require_once('view/' . $template['page'] . '.php'); }
			?>

		</div>

		<nav style='text-align:center;'>
		  <ul class="pagination" >
		    <li><a href="#">&laquo;</a></li>
		    <li><a href="#">1</a></li>
		    <li><a href="#">2</a></li>
		    <li><a href="#">3</a></li>
		    <li><a href="#">4</a></li>
		    <li><a href="#">5</a></li>
		    <li><a href="#">&raquo;</a></li>
		  </ul>
		</nav>
	
	
	
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
				$(function(){
				  // bind change event to select
				  $('#dynamic_select').bind('change', function () {
					  var url = $(this).val(); // get selected value
					  if (url) { // require a URL
						  window.location = url; // redirect
					  }
					  return false;
				  });
				});
			</script>
  </body>
</html>
