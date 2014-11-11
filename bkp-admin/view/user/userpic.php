<?php
require_once('view/user/perfil_menu.php');
?>

<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		<div class="">
			<?php if (isset($template['foto'])): ?>
			<div >
				<img src="<?=$template['foto']?>" id="target" name='target' class="img-responsive"/>
			</div>
			<?php else: ?>
				<br/>
				<br/>
				<h2>Escolha uma foto</h2>
				<br/>
				<p>A foto deve estar no formato jpg.</p>
				<p>Fotos muito grandes, como de smartphones, podem demorar para fazer upload.</p>
				<br/>
			<?php endif; ?>
		</div>
	
	
	
		<?php if (isset($template['foto'])): ?>
		<div class="text-center">
			<p>Selecione a área desejada na imagem.</p>
			<form action="userpic_crop.php" method="post" onsubmit="return checkCoords();">
				<input type="hidden" id="x" name="x" />
				<input type="hidden" id="y" name="y" />
				<input type="hidden" id="w" name="w" />
				<input type="hidden" id="h" name="h" />
				<input type="hidden" name="scrw" id="screen_width" value=""/>
				<input type="hidden" id="img" name="img" value="<?=$template['foto']?>"/>
				<input type="submit" value="Cortar imagem" name="botao"/>
			</form>
		</div>
		<?php else: ?>
			<form method="post" enctype="multipart/form-data" action="userpic.php">
				<div class="form-group">
					<label for="upfile">Foto upload</label>
					<input name="upfile" type="file" class="form-control" id="upfile"  title="Escolha uma foto">
				</div>
				<button type="submit" class="btn btn-success pull-right">Upload</button>
			</form>
		<?php endif; ?>
		<br/>
		
	</div>
	

</div>

			

