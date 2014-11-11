<h2>Informações sobre o projeto</h2>

<br/>
<p><strong><?=$template['nome']?></strong></p>
<br/>

<p><strong>Proponente:</strong></p>
<p><?=$template['owner']?></p>
<br/>

<p><strong>Email:</strong></p>
<p><?=$template['email']?></p>
<br/>

<p><strong>Dias restantes:</strong></p>
<p><?=$template['diasRestantes']?>/<?=$template['prazo']?></p>
<br/>

<p><strong>Já financiado:</strong></p>
<p><?=$template['pct']?>%</p>
<br/>

<p><strong>Status do projeto:</strong></p>
<p><?=$template['ativo']?> 
	<?php
	if ($template['ativo'] == "ativo") {
		echo " / " . $template['analise'];
	}

	?></p>
	<br/>
<?php if($template['projAnalise'] == 1 && $template['projAtivo'] == 0): ?>
	<a href="adm_ativar_proj.php?id=<?=$template['id']?>">Clique para ativar o projeto</a><br/><br/>
	<a href="alterar_projeto.php?id=<?=$template['id']?>&admin=1" target='blank'>Clique para editar o projeto</a><br/><br/>
	<a href="adm_devolver_proj.php?id=<?=$template['id']?>">Clique para devolver o projeto</a>
<?php endif; ?>

<?php if($template['projAtivo'] == 1): ?>
	<a href="adm_desativar_proj.php?id=<?=$template['id']?>">Clique para desativar o projeto</a><br/><br/>
<?php endif; ?>

<br/><br/>