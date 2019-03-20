<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('include/phpmailer/Exception.php');
require('include/phpmailer/PHPMailer.php');
require('include/phpmailer/SMTP.php');

if(isset($_POST['email']) AND !empty($_POST['email']))
{
	
	$bddConnection = $base->getConnection();
	require_once('modele/joueur/mail.class.php');
	$userConnection = new Mail($_POST['email'], $bddConnection);
	$ligneReponse = $userConnection->getReponseConnection();
	
	$donneesJoueur = $ligneReponse->fetch(PDO::FETCH_ASSOC);
	if(empty($donneesJoueur))
	{
		header('Location: ?&page=erreur&erreur=4');
	}
	else
	{
		if($donneesJoueur['email'] == $_POST['email'])
		{ 

			$resetToken = md5(microtime(TRUE)*100000);
			
			require_once('modele/joueur/maj.class.php');
			$maj = new Maj($donneesJoueur['pseudo'], $bddConnection);
			$maj->setNouvellesDonneesResetToken($resetToken);
			
			$lien = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"].'?&action=passRecoverConfirm&token='.urlencode($resetToken);

			$mail = new PHPMailer(true);
			//Décommentez les deux lignes suivantes pour avoir un meilleur débug ! 
			//$mail->SMTPDebug = 2; // 0 -> off 1-> CLIENT 2 -> CLIENT et SERVER
			//$mail->Debugoutput = 'html';
			$retourligne = "\r\n";
			
            $to = $donneesJoueur['email'];
            $subject = "[".$_Serveur_['General']['name']."]Recuperation de mot de passe";
            $txt = 'Bonjour, '.$donneesJoueur['pseudo'].$retourligne
                    .$retourligne
                    .'Suite à une demande de récupération de mail, vous recevez ce message.'.$retourligne
                    .'Voici votre lien de récupération : '.$lien.$retourligne
                    .$retourligne
					.'Si vous n\'avez pas fait de demande de récupération veuillez ignorer cet e-mail...'.$retourligne
					.'Adresse IP de l\'envoyeur de la demande : '.$_SERVER['REMOTE_ADDR'].$retourligne
                    .'Il est inutile de répondre à ce mail automatique.'.$retourligne
                    .$retourligne
                    .'Cordialement, '.$_Serveur_['General']['name'].'.';

			if(isset($_Serveur_['SMTP']))
			{
				$host = $_Serveur_['SMTP']['Host'];
				$username = $_Serveur_['SMTP']['Username'];
				$password = $_Serveur_['SMTP']['Password'];
				$port = $_Serveur_['SMTP']['Port'];
				$protocole = $_Serveur_['SMTP']['Protocole'];
				$mail->isSMTP();
				$mail->Host = $host;
				$mail->SMTPAuth = true;
				$mail->Username = $username;
				$mail->Password = $password;
				$mail->SMTPSecure = $protocole;
				$mail->Port = $port;
				$mail->setFrom('mot_de_passe_perdu@cmw-craftmywebsite.fr' , $_Serveur_['General']['name']);
				$mail->AddAddress($to);
				$mail->isHTML(true);
				$mail->Subject = $subject;
				$mail->Body = $txt;
				$mail->AltBody = $txt;
				$mail->send();
			}
			else
	            mail($to,$subject,$txt);
			header('Location: index.php?envoieMail=true');
		}
		else header('Location: ?&page=erreur&erreur=4');
	}
}
else
{
	header('Location: ?&page=erreur&erreur=4');
}       
?>
