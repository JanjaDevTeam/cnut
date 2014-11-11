<!-- buscar
<div class='row'>
	<div class='col-sm-4'>
		<form>
		  <div class="form-group">
		    <input type="text" class="form-control" placeholder="Buscar projeto">
		  </div>
		  <button type="submit" class="btn btn-default">Buscar</button>
		</form>
	</div>
</div>
<br/>
<br/>
-->


<h2>Categorias</h2>
<br/>
<div class='hidden-xs'>
<a href='explorar.php?'>Todas as categorias</a>
<br/><br/>
<div class='row'>
		<?php foreach($template['categorias'] as $cat): ?>
		<div class='col-sm-4 col-md-3'>
			<a href='explorar.php?idCat=<?=$cat['id']?>' class=''><?=$cat['categoria']?></a>
		</div>
		<?php endforeach; ?>
	</div>
	<br/>
	<br/>
</div>

<div class='row'>
	<div class='col-xs-12 hidden-sm hidden-md hidden-lg hidden-xl'>
		<form>
			<select id="dynamic_select">
				<option value="explorar.php">Todas as categorias</option>
				<?php foreach($template['categorias'] as $cat): ?>
				<option value='explorar.php?idCat=<?=$cat['id']?>' 
				<?php if ($cat['id'] == $template['idCat']) { echo 'selected'; }?>
				><?=$cat['categoria']?></option>
				<?php endforeach; ?>
			</select>
		</form>
	</div>
</div>



<?php if(isset($template['categoria'])):?>
	<h2><?=$template['categoria']?></h2>
<?php endif; ?>

<br/>
<div class='row'>
	<?php foreach($template['projetos'] as $proj): ?>

	<div class='col-sm-4 col-md-3'>
		<div class='card'>

			<div class='col-sm-12'>
				<a href='projeto.php?id=<?=$proj['projeto']->getId()?>'><img src='<?=$proj['projeto']->getImage()?>'/></a>
			</div>

			<div class='cardTextoContainer'>
				<div class='col-sm-12 cardNome'>
					<h4>
						<?php if($proj['projeto']->getPorcentagem() >= 100): ?>
						<img src='img/medal.png' class='medal' style="width: 16px;"/>
						<?php endif; ?><?=$proj['projeto']->getNome()?>
					</h4>
				</div>
				<div class='col-sm-12 cardCategoria'>
					<?=$proj['projeto']->getCategoria()?>
				</div>

				<div class='col-sm-12 cardFrase'>
					<?=$proj['projeto']->getFrase()?>
				</div>
				<div class='col-sm-12 cardFinanciado'>
					<strong><?=$proj['projeto']->getPorcentagem()?>% financiado
				</div>

				<div class='col-sm-12'>
					<div class='barraContainer'>
						<?php 
						$barra = ($proj['projeto']->getPorcentagem() > 100)? 100 : $proj['projeto']->getPorcentagem();
						?>
						<div class='barra' style='width: <?=$barra?>%'></div>
					</div>
				</div>

				<div class='row'>
					<div class='col-xs-6'>
						<div class='col-sm-12 cardArrecadado'>
							<strong>R$&nbsp;<?=$proj['projeto']->getValorArrecadado()?></strong>
						</div>
						<div class='col-xs-12 cardArrecadado'>
							arrecadado
						</div>
					</div>
					
					<div class='col-sm-6'>
						<div class='col-sm-12 cardArrecadado'>
							<strong><?=$proj['projeto']->getDiasRestantes()?></strong>&nbsp;dias
						</div>
						<div class='col-sm-12 cardArrecadado'>
							restantes
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<?php endforeach; ?>
</div>

<br/>
<br/>