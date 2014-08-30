<?php
class ControllerUser {
	
	public function alertaFoto () {
		$id = $_SESSION['id'];
		$nomeFoto = $id . '.jpg';
		
		// verifica se o arquivo existe
		if (!file_exists('img/userpics' . $nomeFoto)) {
			return false;
		} else {
			return true;
		}
	}
	
}

?>
