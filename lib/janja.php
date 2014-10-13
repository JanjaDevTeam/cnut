<?php
class Janja {
	static function debug($target) {
		echo "<pre>";
		print_r($target);
		echo "</pre>";
	}
	
	static function dump($target) {
		echo "<pre>";
		var_dump($target);
		echo "</pre>";
	}

	static function foto() {
		$sufixo  = isset($_SESSION['fbId']) ? '-fb.jpg' : '.jpg';
		$userpic = 'img/userpics/' . $_SESSION['id'] . $sufixo;
	
		if(!isset($_SESSION['fbId']) && !file_exists($userpic)) {
			$userpic = "img/user-default.jpg";
		}

		return $userpic . '?' . (string)(date('H-i-s'));

	}
	
	
	static function menuAdmin($selecionado=0) {

		$menu[0]['desc'] = "Home";
		$menu[0]['link'] = "admin.php";
		
		$menu[1]['desc'] = "Projetos abertos";
		$menu[1]['link'] = "adm_projetos_abertos.php";

		$menu[2]['desc'] = "Projetos ativos";
		$menu[2]['link'] = "adm_projetos_ativos.php";

		$result = "";
		for ($i=0; $i<=2; $i++) {
			if($selecionado === $i) {
				$result .= "<li class='menuSelected'>" . $menu[$i]['desc'] . "</li>";
			} else {
				$result .= "<a href='" . $menu[$i]['link'] . "' alt='" . $menu[$i]['desc'] . "'><li>" 
				. $menu[$i]['desc'] . "</li></a>";
			}
		}

		return $result;
	}
}
?>
