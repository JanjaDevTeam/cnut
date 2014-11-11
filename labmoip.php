<?php
require_once("model/database.php");
require_once("model/colaboracao.php");
require_once("model/projeto.php");

	$data['idTransacao']     = $_POST['id_transacao'];
	$data['valor']           = $_POST['valor'];
	$data['statusPagamento'] = $_POST['status_pagamento'];
	$data['codMoip']         = $_POST['cod_moip'];
	$data['formaPagamento']  = $_POST['forma_pagamento'];
	$data['tipoPagamento']   = $_POST['tipo_pagamento'];
	$data['emailConsumidor'] = $_POST['email_consumidor'];


$db = new Database;
$db->updateUserColaboracaoBySeed($data['idTransacao'], $data['statusPagamento']);
$db->insertMoipNasp($data);

$colab = $db->getColabBySeed($data['idTransacao']);
$idProj = $colab->getIdProjeto();
$proj = $db->getProjeto($idProj);

//file_put_contents('output.txt', print_r($colab, true));

// atualiza valores do projeto
if ($data['statusPagamento'] == 4) {
	$valor = $colab->getValor();
	$valorArrecadado = $proj->getValorArrecadado();
	$valorArrecadado += $valor;
	$proj->setValorArrecadado($valorArrecadado);
	$proj = $db->saveProjeto($proj);

	$qtdComprada = $colab->getQtdComprada();
	$qtdComprada += 1;
	$colab->setQtdComprada($qtdComprada);
	$colab = $db->saveColaboracao($colab);
}

if ($data['statusPagamento'] == 7) {  //implementar redução de backer
	$valor = $colab->getValor();
	$valorArrecadado = $proj->getValorArrecadado();
	$valorArrecadado -= $valor;
	$proj->setValorArrecadado($valorArrecadado);
	$proj = $db->saveProjeto($proj);

	$qtdComprada = $colab->getQtdComprada();
	$qtdComprada -= 1;
	$colab->setQtdComprada($qtdComprada);
	$colab = $db->saveColaboracao($colab);
}

?>
