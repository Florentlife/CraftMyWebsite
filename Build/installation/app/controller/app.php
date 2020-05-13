<?php
/*
=====================
Données récolté à titre de statistique, n'est récolte que l'url du site / date d'installation ! :)
=====================
*/
if($_Serveur_['installation']){
  $URLINSTALL = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
  $SENDINSTALL = file_get_contents('http://craftmywebsite.fr/information/checksiteinstall.php?site='. $URLINSTALL .'');
}
//=====================
$serveurweb = $_SERVER['SERVER_SOFTWARE'];
if(stripos($serveurweb, 'nginx') !== FALSE){
    return['nginx'];
}
//=====================
require_once ('app/plugins/extension.php');
//=====================
require_once ('app/plugins/htpasswd.php');
//=====================
    $extensionok = "false";

    $return = VerifieChmod();
		if($return != null) {
			$chmodok = "false";
		} else { 
			SetHtpasswd();
			$chmodok = "true";
		}

	$retour = VerifieExtension();
		if($retour != "") {
			$extensionok = "false";
		} else { 
			$extensionok = "true";
        }  
//=====================
function is_ssl() {
    if (isset($_SERVER['HTTPS']) ) {
        if ( 'on' == strtolower($_SERVER['HTTPS']) )
            $return['ssl'] = 1;    
        if ( '1' == $_SERVER['HTTPS'] )
            $return['ssl'] = 1;
    } elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
        $return['ssl'] = 1;
    }
    $return['ssl'] = 0;
}
