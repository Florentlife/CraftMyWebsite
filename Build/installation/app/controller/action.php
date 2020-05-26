<?php
if (isset($_GET['action']) AND $_GET['action'] == 'setchmod'){
	chmod("../theme/upload/", 0777);
	chmod("../theme/upload/slider/", 0777);
	chmod("app/data/install.yml", 0777);
	chmod("../modele/config/accueil.yml", 0777);
	chmod("../modele/config/config.yml", 0777);
	chmod("../modele/config/configMenu.yml", 0777);
	chmod("../modele/config/configServeur.yml", 0777);
	chmod("../modele/config/configVotes.yml", 0777);
	chmod("../modele/config/configWidgets.yml", 0777);
	chmod("../modele/.htpasswd", 0777);
	chmod("../controleur/.htpasswd", 0777);
	chmod("../admin/actions/.htpasswd", 0777);
	chmod("../theme/upload/navRap/miniature-demo-1.jpg", 0777);
	chmod("../theme/upload/navRap/miniature-demo-2.png", 0777);
	chmod("../theme/upload/navRap/miniature-demo-3.png", 0777);
	chmod("../theme/upload/navRap/", 0777);
	chmod("../theme/upload/slider/slider1.png", 0777);
	chmod("../theme/upload/slider/slider2.png", 0777);
	chmod("../theme/upload/slider/slider3.png", 0777);
	chmod("../theme/upload/slider/", 0777);
	chmod("../theme/upload/cross.png", 0777);
	chmod("../theme/upload/true.png", 0777);
	chmod("../theme/upload/panel", 0777);
	chmod("../theme/upload/panel/bg.png", 0777);
	chmod("../theme/upload/panel/cross.png", 0777);
	chmod("../theme/upload/panel/true.png", 0777);
	chmod("../theme/upload/panel/index.php", 0777);
	chmod("../theme/smileys", 0777);
	chmod("../utilisateurs/", 0777);

}
// On essaie de se connecté et d'écrire les premiéres données histoire de voir si la base de données répond bien
if(isset($_GET['action']) AND $_GET['action'] == 'sql' AND isset($_POST['hote']) AND isset($_POST['nomBase']) AND isset($_POST['utilisateur']) AND isset($_POST['mdp']) AND isset($_POST['port']))
{
	if(($testPDO = verifyPDO($_POST['hote'], $_POST['nomBase'], $_POST['utilisateur'], $_POST['mdp'], $_POST['port'])) === TRUE)
	{
		$sql = getPDO($_POST['hote'], $_POST['nomBase'], $_POST['utilisateur'], $_POST['mdp'], $_POST['port']);
		require_once ('app/plugins/installSQL.php');
	}
	else if($testPDO == 3)
	{
		$erreur['type'] = 'pass';
	}
	else
	{
		$erreur['type'] = 'sql_mode';
		$erreur['data'] = $testPDO;
	}
}
// On ecrit les informations de la page "Configuration & Paramétrage du site" dans les fichier de config du cms
if(isset($_GET['action']) AND $_GET['action'] == 'infos' AND isset($_POST['nom']) AND isset($_POST['adresse']) AND isset($_POST['description']))
{    
	require('app/plugins/installInfos.php'); 
}
if(isset($_GET['action']) AND $_GET['action'] == 'cgu'){
	$installLecture = new Lire('app/data/install.yml');
	$installLecture = $installLecture->GetTableau();
	$installLecture['etape'] = 1;

	$ecriture = new Ecrire('app/data/install.yml', $installLecture);

	header('Location: index.php');
}
if(isset($_GET['action']) AND $_GET['action'] == 'compte' AND isset($_POST['pseudo']) AND isset($_POST['mdp']) AND isset($_POST['email']))
{
	$sql = getPDO($_Serveur_['DataBase']['dbAdress'], $_Serveur_['DataBase']['dbName'], $_Serveur_['DataBase']['dbUser'], $_Serveur_['DataBase']['dbPassword'], $_Serveur_['DataBase']['dbPort']);

	require_once ('app/plugins/compteAdmin.php');
	$compte = new CompteAdmin($sql, $_POST['pseudo'], $_POST['mdp'], $_POST['email']); //Création du compte admin

	$config = new Lire('../modele/config/config.yml');
	$config = $config->GetTableau();
	$config['installation'] = true;
	$ecriture = new Ecrire('../modele/config/config.yml', $config);
		
	$installLecture = new Lire('app/data/install.yml');
	$installLecture = $installLecture->GetTableau();
	$installLecture['etape'] = 4;

	$ecriture = new Ecrire('app/data/install.yml', $installLecture);
		
	header('Location: index.php');
}


// if(isset($_GET['action']) AND $_GET['action'] == "sqlforce"){
// 	if(isset($_POST['']))
// }