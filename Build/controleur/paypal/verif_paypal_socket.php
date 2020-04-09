

<?php


$req = 'cmd=_notify-validate';
foreach ($_POST as $cle => $valeur)
{
    $valeur = urlencode(stripslashes($valeur));
    $req .= "&".$cle."=".$valeur;
}

$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

$item_name = $_POST['item_name'];
$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
$payment_amount = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['receiver_email'];
$payer_email = $_POST['payer_email'];
$return = explode(',',$_POST['custom']);
 
if ($fp) // Si la connexion avec Paypal n'a pas pu être initialisée, on affiche une erreur
{
    fputs ($fp, $header . $req);// fputs=fwrite | On envoie la variable $req à Paypal via le connexion initialisée précédemment (nommée $fp)
    while (!feof($fp))// Tant qu'on n'arrive pas à la fin de $fp
    {
        $res = fgets ($fp, 1024);
        if (strcmp ($res, "VERIFIED") == 0)// Si on trouve le mot VERIFIED (donc si les données reçues correspondent aux données de la transaction)
        {
			
			$recupOpffresPaypal = $bddConnection->prepare('SELECT * FROM cmw_jetons_paypal_offres WHERE id = :id');
			$recupOpffresPaypal->execute(array('id' => $return[1]));
			$donneesActions = $recupOpffresPaypal->fetch(PDO::FETCH_ASSOC);
            if ($payment_status=="Completed" AND $receiver_email==$_Serveur_['Payement']['paypalEmail'] AND (string)$payment_amount==(string)$donneesActions['prix'] AND $payment_currency=="EUR")// Si tous les paramètres sont bons, on peut procéder au traitement de la commande
            {

				require_once('modele/joueur/maj.class.php');
				$joueurMaj = new Maj($return[0], $bddConnection);
				$playerData = $joueurMaj->getReponseConnection();
				$playerData = $playerData->fetch(PDO::FETCH_ASSOC);
				$playerData['tokens'] = $playerData['tokens'] + $donneesActions['jetons_donnes'];
				$joueurMaj->setReponseConnection($playerData);
				$joueurMaj->setNouvellesDonneesTokens($playerData);
            }
        }
    }
	fclose ($fp);
}
?>
