<?php

if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['showPage'] == true) {
//Statistiques de la Boutique

    $boutiquesStatsReq = $bddConnection->query('SELECT * FROM cmw_boutique_stats ORDER BY id DESC LIMIT 0, 12;');
    $i = 0;
    while($boutiquesStatsDonnees = $boutiquesStatsReq->fetch(PDO::FETCH_ASSOC))
    {
        $boutiquesStats[$i]['id'] = $boutiquesStatsDonnees['id'];
        $boutiquesStats[$i]['offre_id'] = $boutiquesStatsDonnees['offre_id'];
        $boutiquesStats[$i]['date_achat'] = $boutiquesStatsDonnees['date_achat'];
        $boutiquesStats[$i]['prix'] = $boutiquesStatsDonnees['prix'];
        $boutiquesStats[$i]['pseudo'] = $boutiquesStatsDonnees['pseudo'];
        $i++;
    }
    $lastOffreReq = $bddConnection->query('SELECT * FROM cmw_boutique_offres ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastOffreDonnees = $lastOffreReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastOffre[$i]['id'] = $lastOffreDonnees['id'];
        $lastOffre[$i]['nom'] = $lastOffreDonnees['nom'];
        $lastOffre[$i]['categorie_id'] = $lastOffreDonnees['categorie_id'];
        $lastOffre[$i]['prix'] = $lastOffreDonnees['prix'];
        $i++;
    }
    $lastOffrePaypalReq = $bddConnection->query('SELECT * FROM cmw_jetons_paypal_offres ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastOffrePaypalDonnees = $lastOffrePaypalReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastOffrePaypal[$i]['id'] = $lastOffrePaypalDonnees['id'];
        $lastOffrePaypal[$i]['nom'] = $lastOffrePaypalDonnees['nom'];
        $lastOffrePaypal[$i]['prix'] = $lastOffrePaypalDonnees['prix'];
        $lastOffrePaypal[$i]['jetons_donnes'] = $lastOffrePaypalDonnees['jetons_donnes'];
        $i++;
    }
    // <!-- Statistiques des membres -->
    $membresStatsReq = $bddConnection->query('SELECT * FROM cmw_users ORDER BY id DESC LIMIT 0, 8;');
    $i = 0;
    while($membresStatsDonnees = $membresStatsReq->fetch(PDO::FETCH_ASSOC))
    {
        $membresStats[$i]['id'] = $membresStatsDonnees['id'];
        $membresStats[$i]['pseudo'] = $membresStatsDonnees['pseudo'];
        $membresStats[$i]['tokens'] = $membresStatsDonnees['tokens'];
        $membresStats[$i]['anciennete'] = $membresStatsDonnees['anciennete'];
        $membresStats[$i]['ip'] = $membresStatsDonnees['ip'];
        $membresStats[$i]['ValidationMail'] = $membresStatsDonnees['ValidationMail'];
        $i++;
    }
// Statistiques du dernier inscrit
    $lastMembreReq = $bddConnection->query('SELECT * FROM cmw_users ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastMembreDonnees = $lastMembreReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastMembre[$i]['id'] = $lastMembreDonnees['id'];
        $lastMembre[$i]['pseudo'] = $lastMembreDonnees['pseudo'];
        $lastMembre[$i]['anciennete'] = $lastMembreDonnees['anciennete'];
        $i++;
    }
// <!-- Statistiques du dernier Ticket -->
    $lastTicketReq = $bddConnection->query('SELECT * FROM cmw_support ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastTicketDonnees = $lastTicketReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastTicket[$i]['id'] = $lastTicketDonnees['id'];
        $lastTicket[$i]['auteur'] = $lastTicketDonnees['auteur'];
        $lastTicket[$i]['titre'] = $lastTicketDonnees['titre'];
        $lastTicket[$i]['date_post'] = $lastTicketDonnees['date_post'];
        $lastTicket[$i]['etat'] = $lastTicketDonnees['etat'];
        $i++;
    }
    // <!-- Statistiques du dernier Commentaire Support -->
    $lastCommentaireSuppReq = $bddConnection->query('SELECT * FROM cmw_support_commentaires ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastCommentaireDonneesSupp = $lastCommentaireSuppReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastCommentaireSupp[$i]['id'] = $lastCommentaireDonneesSupp['id'];
        $lastCommentaireSupp[$i]['id_ticket'] = $lastCommentaireDonneesSupp['id_ticket'];
        $lastCommentaireSupp[$i]['auteur'] = $lastCommentaireDonneesSupp['auteur'];
        $lastCommentaireSupp[$i]['date_post'] = $lastCommentaireDonneesSupp['date_post'];
        $i++;
    }
    $lastCommentaireNewsReq = $bddConnection->query('SELECT * FROM cmw_news_commentaires ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastCommentaireDonneesNews = $lastCommentaireNewsReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastCommentaireNews[$i]['id'] = $lastCommentaireDonneesNews['id'];
        $lastCommentaireNews[$i]['id_news'] = $lastCommentaireDonneesNews['id_news'];
        $lastCommentaireNews[$i]['pseudo'] = $lastCommentaireDonneesNews['pseudo'];
        $lastCommentaireNews[$i]['date_post'] = $lastCommentaireDonneesNews['date_post'];
        $i++;
    }
    $lastNewsReq = $bddConnection->query('SELECT * FROM cmw_news ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastNewsDonnees = $lastNewsReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastNews[$i]['id'] = $lastNewsDonnees['id'];
        $lastNews[$i]['titre'] = $lastNewsDonnees['titre'];
        $lastNews[$i]['auteur'] = $lastNewsDonnees['auteur'];
        $lastNews[$i]['date'] = $lastNewsDonnees['date'];
        $i++;
    }
    $nbrPerIPReq = $bddConnection->query('SELECT * FROM cmw_sysip ORDER BY idPerIP = 1');
    $i = 0;
    while($nbrPerIPDonnees = $nbrPerIPReq->fetch(PDO::FETCH_ASSOC))
    {
        $nbrPerIP[$i]['nbrPerIP'] = $nbrPerIPDonnees['nbrPerIP'];
        $nbrPerIP[$i]['id'] = $nbrPerIPDonnees['idPerIP'];
        $i++;
    }
    $sysMailReq = $bddConnection->query('SELECT * FROM cmw_sysmail WHERE idMail = 1');
    $i = 0;
    while($sysMailDonnees = $sysMailReq->fetch(PDO::FETCH_ASSOC))
    {
        $sysMail[$i]['idMail'] = $sysMailDonnees['idMail'];
        $sysMail[$i]['fromMail'] = $sysMailDonnees['fromMail'];
        $sysMail[$i]['sujetMail'] = $sysMailDonnees['sujetMail'];
        $sysMail[$i]['msgMail'] = $sysMailDonnees['msgMail'];
        $sysMail[$i]['strictMail'] = $sysMailDonnees['strictMail'];
        $sysMail[$i]['etatMail'] = $sysMailDonnees['etatMail'];
        $i++;
    }
    $lastVoteReq = $bddConnection->query('SELECT * FROM cmw_votes ORDER BY date_dernier DESC LIMIT 1;');
    $i = 0;
    while($lastVoteDonnees = $lastVoteReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastVote[$i]['id'] = $lastVoteDonnees['id'];
        $lastVote[$i]['pseudo'] = $lastVoteDonnees['pseudo'];
        $lastVote[$i]['date_dernier'] = $lastVoteDonnees['date_dernier'];
        $i++;
    }
    $lastMaintenanceReq = $bddConnection->query('SELECT maintenanceTime, maintenanceEtat FROM cmw_maintenance WHERE maintenanceId = 1');
    $i = 0;
    while($lastMaintenanceDonnees = $lastMaintenanceReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastMaintenance[$i]['maintenanceId'] = $lastMaintenanceDonnees['maintenanceId'];
        $lastMaintenance[$i]['maintenanceEtat'] = $lastMaintenanceDonnees['maintenanceEtat'];
        $lastMaintenance[$i]['maintenanceTime'] = $lastMaintenanceDonnees['maintenanceTime'];
        $i++;
    }
    $lastAchatmcgpassReq = $bddConnection->query('SELECT * FROM cmw_mcgpass ORDER BY id DESC LIMIT 1;');
    $i = 0;
    while($lastAchatmcgpassDonnees = $lastAchatmcgpassReq->fetch(PDO::FETCH_ASSOC))
    {
        $lastAchatmcgpass[$i]['id'] = $lastAchatmcgpassDonnees['id'];
        $lastAchatmcgpass[$i]['pseudo'] = $lastAchatmcgpassDonnees['pseudo'];
        $lastAchatmcgpass[$i]['date_achat'] = $lastAchatmcgpassDonnees['date_achat'];
        $lastAchatmcgpass[$i]['payout'] = $lastAchatmcgpassDonnees['payout'];
        $i++;
    }

}
?>