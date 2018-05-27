<?php
$date = date("Y-m-d H:i:s");

$user_id = $_Serveur_['Payement']['mcgpass_id'];
$error = '';
$desc_err = '';
$merchant_data = filter_input(INPUT_POST, 'merchant_data', FILTER_SANITIZE_STRING); // Données que vous aurez désigné dans le code d'accès
$reference = filter_input(INPUT_POST, 'ref', FILTER_SANITIZE_STRING); // Référence unique de la transaction assigné par MCGPass
$gains = filter_input(INPUT_POST, 'gains', FILTER_SANITIZE_STRING); // Gains en monnaie virtuelle de cette transaction
$nom_devise = filter_input(INPUT_POST, 'nom_devise', FILTER_SANITIZE_STRING); // Le nom de votre monnaie virtuelle
$statut = filter_input(INPUT_POST, 'statut', FILTER_SANITIZE_STRING); // Doit être à "Validated"

// Vérification de la transaction

$ch = curl_init();
$post = array("merchant_data" => $merchant_data , 
				"ref" => $reference , 
				"user_id" => $user_id);

curl_setopt($ch, CURLOPT_URL, "https://secure.mcgpass.com/script_mv/v1/check_transaction");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

$result_json = curl_exec($ch);
curl_close($ch);

$result = json_decode($result_json);

do{
	if($result->statut != 'validated'){
		$error = $result->error;
		$desc_err = $result->desc_error;
		break;
	}
	
	if(floatval($result->gains) != floatval($gains)){
		$error = "ERRU01";
		$desc_err = "Erreur : Différence de gains entre mcgpass et vendeur. (".floatval($result->gains)." --- ".$gains.")";
		break;
	}
}while(false);
if(empty($error) OR ($error == "ERRU01" AND $result->gains == 0)) {
	$code = 0;
	$rate = 0;
	$virtual_currency = intval($result->gains);
	if($virtual_currency == 0)
		$virtual_currency = 1;
	$achat = $bddConnection->prepare('INSERT INTO cmw_mcgpass (pseudo, tokens, date_achat) VALUES (:pseudo, :tokens, NOW() ) ');
	$achat->execute(array(
		'pseudo' => $_Joueur_['pseudo'],
		'tokens' => $result->gains
	));
	require_once('modele/joueur/maj.class.php');
	$joueurMaj = new Maj($_Joueur_['pseudo'], $bddConnection);
	$playerData = $joueurMaj->getReponseConnection();
	$playerData = $playerData->fetch();
	$playerData['tokens'] = $playerData['tokens'] + $virtual_currency;
	$joueurMaj->setReponseConnection($playerData);
	$joueurMaj->setNouvellesDonneesTokens($playerData);
	$_Joueur_['tokens'] = $_Joueur_['tokens'] + $virtual_currency;
	header("Location: index.php?page=token&success=true&tokens={$virtual_currency}");
}
else
{
	header('Location: index.php?page=token&success=false');
}
?>