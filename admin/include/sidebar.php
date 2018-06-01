<div class="panel panel-default cmw-sidebar-panel">
  <div class="panel-body cmw-sidebar-panel-body">
    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['showPage'] == true) { ?>
    <a href="?page=accueil" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if($pageadmin == 'accueil' OR $pageadmin == ''){ echo 'active'; } ?>"  role="button">Accueil & Stats<i class="fa fa-area-chart cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['general']['showPage'] == true) { ?>
    <a href="?page=configsite" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'configsite'){ echo 'active'; } ?>" role="button">Réglage site <i class="fa fa-heartbeat cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['theme']['showPage'] == true) { ?>
    <a href="?page=theme" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'theme'){ echo 'active'; } ?>" role="button">Thème <i class="fa fa-object-group cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['showPage'] == true) { ?>
    <a href="?page=slidemini" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'slidemini'){ echo 'active'; } ?>" role="button">Slider & Miniature <i class="fa fa-file-image-o cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['server']['showPage'] == true) { ?>
    <a href="?page=reglagejsonapi" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'reglagejsonapi'){ echo 'active'; } ?>" role="button">Réglages JsonAPI <i class="fa fa-sitemap cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['pages']['showPage'] == true) { ?>
    <a href="?page=custompages" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'custompages'){ echo 'active'; } ?>" role="button">Pages personnalisées <i class="fa fa-puzzle-piece cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['showPage'] == true) { ?>
    <a href="?page=boutique" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'boutique'){ echo 'active'; } ?>" role="button">Réglage boutique <i class="fa fa-shopping-cart cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['payment']['showPage'] == true) { ?>
    <a href="?page=paiement" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'paiement'){ echo 'active'; } ?>" role="button">Réglage paiement <i class="fa fa-credit-card-alt cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['menus']['showPage'] == true) { ?>
    <a href="?page=menus" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'menus'){ echo 'active'; } ?>" role="button">Menus personnalisées <i class="fa fa-bars cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1) { ?>
    <a href="?page=grade" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'grade'){ echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fa fa-arrow-right" aria-hidden="true"></i> Rangs <i class="fa fa-users cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['news']['showPage'] == true) { ?>
    <a href="?page=news" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'news'){ echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fa fa-arrow-right" aria-hidden="true"></i> News <i class="fa fa-info-circle cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['showPage'] == true) { ?>
    <a href="?page=voter" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'voter'){ echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fa fa-arrow-right" aria-hidden="true"></i> Vote <i class="fa fa-star cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['members']['showPage'] == true) { ?>
    <a href="?page=membres" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'membres'){ echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fa fa-arrow-right" aria-hidden="true"></i> Membres <i class="fa fa-users cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } 

         if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['forum']['showPage'] == true) { ?>
    <a href="?page=forum" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'forum') { echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fa fa-arrow-right" aria-hidden="true"></i> Forum <i class="fa fa-font cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php }

         if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['widgets']['showPage'] == true) { ?>
    <a href="?page=widgets" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'widgets'){ echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fa fa-arrow-right" aria-hidden="true"></i>  Widgets <i class="fa fa-share-square-o cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['tickets']['showPage'] == true) { ?>
    <a href="?page=support" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'support'){ echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fa fa-arrow-right" aria-hidden="true"></i> Support <i class="fa fa-life-ring cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['showPage'] == true) { ?>
    <a href="?page=maintenance" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'maintenance'){ echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fa fa-arrow-right" aria-hidden="true"></i> Maintenance <i class="fa fa-wrench cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['showPage'] == true) { ?>
    <a href="?page=newsletter" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'newsletter'){ echo 'active'; } ?>" role="button"><strong>Gestion </strong><i class="fa fa-arrow-right" aria-hidden="true"></i> NewsLetter <i class="fa fa-wrench cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>

    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['update']['showPage'] == true) { ?>
    <a href="?page=maj" class="btn btn-default btn-block cmw-sidebar-btn hvr-bounce-to-right <?php if(isset($pageadmin)&& $pageadmin == 'maj'){ echo 'active'; } ?>" role="button">Mise à jour <i class="fa fa-free-code-camp cmw-fa-sidebar" aria-hidden="true"></i></a>
    <?php } ?>
  </div>
</div>
