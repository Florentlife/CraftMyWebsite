<?php

if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['theme']['actions']['editTheme']) {
	if(isset($_POST['color_main'], $_POST['color_hover'], $_POST['color_focus'])) {
		$configTheme = new Lire('modele/config/config.yml');
		$_Theme_ = $configTheme->GetTableau();
		$_Theme_['color']['main'] = $_POST["color_main"];
		$_Theme_['color']['hover'] = $_POST["color_hover"];
		$_Theme_['color']['focus'] = $_POST["color_focus"];
		new Ecrire('modele/config/config.yml', $_Theme_);
	}
}

?>