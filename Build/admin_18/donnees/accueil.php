<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['showPage'] == true) {
    $lectureAccueil = new Lire('modele/config/accueil.yml');
    $lectureAccueil = $lectureAccueil->GetTableau();

    if(isset($lectureAccueil['Infos'])) {
        for($i = 1; $i < count($lectureAccueil['Infos']); $i++) {
            $explode = explode('=', $lectureAccueil['Infos'][$i + 1]['lien']);
            if($explode[0] == '?page')
            {    
                $typeNavRap[$i] = 1;
                $pageActive[$i] = $explode[1];
            }
            else 
            {
                $typeNavRap[$i] = 2;
            }
        }
    }

    $images = scandir('theme/upload/navRap/');
   // $imagesSlider = scandir('theme/upload/slider');

    $pagesReq = $bddConnection->query('SELECT titre FROM cmw_pages');
    $i = 0;
    while($pagesDonnees = $pagesReq->fetch(PDO::FETCH_ASSOC))
    {
       $pages[$i] = $pagesDonnees['titre'];
       $i++;
   }
   $pages[$i] = 'boutique';
    $i++;
    $pages[$i] = 'voter';
    $i++;
    $pages[$i] = 'tokens';
    $i++;
    $pages[$i] = 'forum';
    $i++;
    $pages[$i] = 'support';
}
?>