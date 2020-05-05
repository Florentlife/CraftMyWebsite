<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'showPage')) {
	$lectureP = new Lire('modele/config/config.yml');
	$lectureP = $lectureP->GetTableau();
	$lectureP = $lectureP['Payement'];

	$microTokens = new Lire('modele/config/configAlloconv.yml');
	$microTokens = $microTokens->GetTableau();

	$query = $bddConnection->query('SELECT * FROM cmw_jetons_paypal_offres');

	$i = 0;
	while($donneesQuery = $query->fetch(PDO::FETCH_ASSOC))
	{
		$paypalOffres[$i]['id'] = $donneesQuery['id'];
		$paypalOffres[$i]['nom'] = $donneesQuery['nom'];
		$paypalOffres[$i]['description'] = $donneesQuery['description'];
		$paypalOffres[$i]['prix'] = $donneesQuery['prix'];
		$paypalOffres[$i]['jetons_donnes'] = $donneesQuery['jetons_donnes'];
		$i++;
	}
}
?>