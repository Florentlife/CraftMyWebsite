<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['payment']['actions']['editPayment'] == true) {
	$lecture = new Lire('modele/config/config.yml');
	$lecture = $lecture->GetTableau();

	if(isset($_POST['paypal']))
		$lecture['Payement']['paypal'] = true;
	else
		$lecture['Payement']['paypal'] = false;	
	if(isset($_POST['mcgpass']))
		$lecture['Payement']['mcgpass'] = true;
	else
		$lecture['Payement']['mcgpass'] = false;
	if(isset($_POST['dedipass']))
		$lecture['Payement']['dedipass'] = true;
	else
		$lecture['Payement']['dedipass'] = false;
	
	$lecture['Payement']['mcgpass_id'] = $_POST['mcgpass_id'];
	$lecture['Payement']['mcgpass_idSite'] = $_POST['mcgpass_idSite'];
	$lecture['Payement']['public_key'] = $_POST['public_key'];
	$lecture['Payement']['private_key'] = $_POST['private_key'];
	$lecture['Payement']['paypalUser'] = $_POST['paypalUser'];
	$lecture['Payement']['paypalPass'] = $_POST['paypalPass'];
	$lecture['Payement']['paypalSignature'] = $_POST['paypalSignature'];
	$lecture['Payement']['paypalEmail'] = $_POST['paypalEmail'];
	$lecture['Payement']['paypalMethodeAPI'] = $_POST['paypalMethodeAPI'];
	$ecriture = new Ecrire('modele/config/config.yml', $lecture);
}
?>