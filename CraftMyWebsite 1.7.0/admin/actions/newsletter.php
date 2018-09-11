<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('include/phpmailer/Exception.php');
require('include/phpmailer/PHPMailer.php');
require('include/phpmailer/SMTP.php');

if(isset($_POST['contenu'], $_POST["sujet"]) && ($_Joueur_['rang'] == 1 || $_PGrades_['PermsPanel']['news']['actions']['addNews'])) {
	if(isset($_POST['useSMTP']))
	{
		$mail = new PHPMailer(true);
		//Décommentez les deux lignes suivantes pour avoir un meilleur débug ! 
		//$mail->SMTPDebug = 2; // 0 -> off 1-> CLIENT 2 -> CLIENT et SERVER
		//$mail->Debugoutput = 'html';
		try {
			if(isset($_POST['memoireSMTP']))
			{
				$_Serveur_['SMTP']['Host'] = $_POST['host'];
				$_Serveur_['SMTP']['Username'] = $_POST['username'];
				$_Serveur_['SMTP']['Password'] = $_POST['password'];
				$_Serveur_['SMTP']['Port'] = $_POST['port'];
				$_Serveur_['SMTP']['Protocole'] = $_POST['protocol'];
				$ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
			}
			if(isset($_Serveur_['SMTP']))
			{
				$host = $_Serveur_['SMTP']['Host'];
				$username = $_Serveur_['SMTP']['Username'];
				$password = $_Serveur_['SMTP']['Password'];
				$port = $_Serveur_['SMTP']['Port'];
				$protocole = $_Serveur_['SMTP']['Protocole'];
			}
			else
			{
				$host = $_POST['host'];
				$username = $_POST['username'];
				$password = $_POST['password'];
				$port = $_POST['port'];
				$protocole = $_POST['protocol'];
			}
			$mail->isSMTP();
			$mail->Host = $host;
			$mail->SMTPAuth = true;
			$mail->Username = $username;
			$mail->Password = $password;
			$mail->SMTPSecure = $protocole;
			$mail->Port = $port;
			$mail->setFrom($_POST['from'], $_Serveur_['General']['name']);
			$newsletter = $bddConnection->query('SELECT pseudo,email FROM cmw_users WHERE newsletter = 1');
			while($dnewsletter = $newsletter->fetch(PDO::FETCH_ASSOC)){
				$mail->addAddress($dnewsletter['email'], $dnewsletter['pseudo']);		
			}
			if(!empty($_POST['reply']))
				$mail->addReplyTo($_POST['reply'], $_Serveur_['General']['name']);
			else
				$mail->addReplyTo($_POST['from'], $_Serveur_['General']['name']);
			$mail->isHTML(true);
			$subject = htmlspecialchars($_POST["sujet"]);
			$mail->Subject = $subject;
			$mail->Body = $_POST['contenu'];
			$message = strip_tags($_POST["contenu"]);
			$mail->AltBody = $message;
			
			$mail->send();
			header('Location: ?page=newsletter&success=true');
		}
		catch (Exception $e)
		{
			die("Erreur lors de l'envoie du mail: ". $mail->ErrorInfo);
		}
	}
	else
	{
		$newsletter = $bddConnection->query('SELECT pseudo,email FROM cmw_users WHERE newsletter = 1');
		while($dnewsletter = $newsletter->fetch(PDO::FETCH_ASSOC)){
			$to = $dnewsletter['email'];
			$subject = htmlspecialchars($_POST["sujet"]);
			$message = htmlspecialchars($_POST["contenu"]);
			$headers = 'From: ' . htmlspecialchars($_POST["from"]) . "\r\n" .
					'Reply-To: EMAIL DE RÉPONSE ( pas forcément de serveur )' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();	
					mail($to, $subject, $message, $headers);			
		}
	}
}
?>