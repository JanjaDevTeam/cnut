<?php
	switch($template['msg']) {
		case 'enviado':
			$alert = 'alert-info';
			$msg   = 'Foi enviado um email com o link para redefinir sua senha.';
			break;
		case 'user': 
			$alert = 'alert-warning';
			$msg   = 'Este email não existe no banco de dados.';
			break;
		case 'token':
			$alert = 'alert-info';
			$msg   = 'Um token foi enviado para seu email nas últimas 24 horas. 
			Verifique se o mesmo se encontra na pasta de spam.';
			break;
		case 'expirou':
			$alert = 'alert-info';
			$msg   = 'Este token não existe ou seu prazo já expirou.
			Caso tenha expirado você pode requisitar um novo.';
			break;
		case 'senha_ok':
			$alert = 'alert-success';
			$msg   = 'Sua senha foi redefinida! Pode logar agora.';
			break;
		case 'senha_erro':
			$alert = 'alert-info';
			$msg   = 'Erro redefinindo senha. Tente novamente';
			break;
		default:
			$alert = 'alert-info';
			$msg   = 'Default';
			break;
	}
?>

<div class="alert <?= $alert ?>">
	<p><?= $msg ?></p>
</div>
