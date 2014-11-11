<br/>
<h3>Projetos ativos (<?=$template['qtdAtivos']?>)</h3>
<br/>

	<form>
	<div class="input-group col-xs-4">
	  <span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span>
	  <input class="form-control" type="password" placeholder="Busca">
	</div>
	</form>
	<br/>

<table class='table'>
	<thead>
		<tr>
			<th>#</th>
			<th>CATEGORIA</th>
			<th>PROJETO</th>
			<th class='center_text'>REVISAR</th>
			<th class='center_text'>CONFIG</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach($template['projetos'] as $proj) {?>
		<tr>
			<td class='editar'><?= $proj['id']?></td>
			<td><?= $proj['categoria']?></td>
			<td><?= $proj['nome'] ?></td>
			<td class='editar center_text centro'><a href='projeto.php?id=<?= $proj['id']?>&mode=007' target="blank"><img src='img/tango/contact-new.png'></a></td>
			<td class='editar center_text centro'><a href='adm_info_proj.php?id=<?= $proj['id']?>&local=ativos'><img src='img/tango/document-properties.png'></a></td>
		</tr>
			
		<?php }
		?>
	</tbody>
</table>