<?php
$req = $bddConnection->query('SELECT * FROM cmw_maintenance');
$donnees = $req->fetch(PDO::FETCH_ASSOC);
$maintenance[$i] = $donnees;
?>