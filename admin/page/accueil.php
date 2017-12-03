<div class="cmw-page-content-header"><strong>Slider & Miniature</strong> - Gérez vos sliders & miniatures de votre site</div>

<div class="row">
    <div class="alert alert-success">
        <strong>L'accueil de votre site, la vitrine de votre serveur, ne négligez jamais cette page, ajoutez de belles images de slider ou encore des liens de navigations rapides le plus ergonomiques possibles !</strong>
    </div>
    <div class="col-xs-12 col-md-6 text-center">
        <?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['home']['actions']['uploadSlider'] == false AND $_PGrades_['PermsPanel']['home']['actions']['editSlider'] == false AND $_PGrades_['PermsPanel']['home']['actions']['uploadMiniature'] == false AND $_PGrades_['PermsPanel']['home']['actions']['editMiniature'] == false)) { ?>

        
        <div class="alert alert-danger">
            <strong>Vous avez aucune permission pour accéder aux réglagles de l'accueil.</strong>
        </div>

        <?php } else { ?>
        <?php } if($_Joueur_['rang'] == 1 OR ($_PGrades_['PermsPanel']['home']['actions']['uploadSlider'] == true OR $_PGrades_['PermsPanel']['home']['actions']['editSlider'] == true)) { ?>

        <h2>Slider</h2>

        <?php } if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['actions']['uploadSlider'] == true) { ?>

        <div class="panel panel-default cmw-panel">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Uploader un slider</strong></h3>
            </div>
            <div class="panel-body">
                <form method="POST" action="?&action=postSlider" enctype="multipart/form-data">
                    <div class="form-group col-md-7">
                        <input type="file" name="img">
                        <p class="help-block">Image slider (1400 x 500)</p>
                    </div>
                    <div class="form-group col-md-5">
                        <input type="submit" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>

        <?php } if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['actions']['editSlider'] == true) { ?>


        <h3>Configuration de votre slider</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                <form method="POST" action="?&action=changeSlider">
                    
                        <label class="control-label">Titre au dessus du slider</label>
                        <input class="form-control text-center" type="text" placeholder="Sliders">
                        <ul class="nav nav-tabs">
                            <?php for($i = 0;$i < count($lectureAccueil['Slider']);$i++) { ?>
                            <li <?php if($i == 0) echo 'class="active"'; ?>><a href="#slider<?php echo $i; ?>" data-toggle="tab">Image <?php echo $i + 1; ?></a></li>
                            <?php }
                            if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['actions']['addSlider'] == true) { ?>
                            <li><a href="#newSlider" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span></a></li>
                            <?php } ?>
                        </ul>

                    
                        <div class="tab-content">
                            <?php for($i = 0;$i < count($lectureAccueil['Slider']);$i++) { ?>
                            <div class="tab-pane well <?php if($i == 0) echo 'active"'; ?>" id="slider<?php echo $i; ?>">
                                <label class="control-label">Message de l'image</label>
                                <a href="?action=supprSlider&id=<?php echo $i; ?>" class="btn btn-danger btn-xs">Supprimer</a>
                                <input type="text" class="form-control text-center" name="message<?php echo $i; ?>" value="<?php echo $lectureAccueil['Slider'][$i]['message']; ?>">
                                <select class="form-control text-center" name="image<?php echo $i; ?>">
                                    <option value="<?php echo $lectureAccueil['Slider'][$i]['image']; ?>"><?php echo $lectureAccueil['Slider'][$i]['image']; ?></option>
                                    <?php for($j = 2;$j < count($imagesSlider);$j++) {
                                        if($lectureAccueil['Slider'][$i]['image'] != $imagesSlider[$j])  echo '<option value="' .$imagesSlider[$j]. '">' .$imagesSlider[$j]. '</option>';
                                    } ?>
                                </select>
                            </div>
                            <?php } ?>
                            <input type="submit" class="btn btn-success" value="Modifier le slider"/>
                        </div>
                    
                </form>
            </div>
        </div>
    </div>


    <?php } if($_Joueur_['rang'] == 1 OR ($_PGrades_['PermsPanel']['home']['actions']['uploadMiniature'] == true OR $_PGrades_['PermsPanel']['home']['actions']['editMiniature'] == true)) { ?>

    <div class="col-xs-12 col-md-6 text-center">
        <h2>Miniature</h2>

        <?php } if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['actions']['uploadMiniature'] == true) { ?>

        <div class="panel panel-default cmw-panel">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Uploader une miniature</strong></h3>
            </div>
            <div class="panel-body">
                <form method="POST" action="?&action=postNavRap" enctype="multipart/form-data">
                    <div class="form-group col-md-7">
                        <input type="file" name="img">
                        <p class="help-block">Image miniature (400 x 160)</p>
                    </div>
                    <div class="form-group col-md-5">
                        <input type="submit" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>

        <?php } if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['actions']['editMiniature'] == true) { ?>

        <h3>Configuration de votre miniature</h3>

        <div class="panel panel-default">
            <div class="panel-body">
                <form method="POST" action="?&action=editRapNav">
                    
                        <ul class="nav nav-tabs">
                            <?php for($i = 0;$i < 3;$i++) { ?>
                            <li <?php if($i == 0) echo 'class="active"'; ?>><a href="#navRap<?php echo $i; ?>" data-toggle="tab">Lien rapide <?php echo $i + 1; ?></a></li>
                            <?php } ?>
                        </ul>
                    
                    
                        <div class="tab-content">
                            <?php for($i = 0;$i < 3;$i++) { ?>
                            <div class="tab-pane well <?php if($i == 0) echo 'active'; ?>" id="navRap<?php echo $i; ?>">
                                <h3>Miniature #<?php echo $i + 1; ?></h3>
                                <div class="row">
                                    <img class="col-md-4 thumbnail" src="theme/upload/navRap/<?php echo $lectureAccueil['Infos'][$i]['image']; ?>"/>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Message</label>
                                            <textarea class="form-control" placeholder="Petit message qui se situera en dessous de l'image ^^" rows="3" name="message<?php echo $i;?>"><?php echo $lectureAccueil['Infos'][$i]['message']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <label>Image</label>
                                <select class="form-control" name="image<?php echo $i; ?>">
                                    <?php for($j = 2;$j < count($images);$j++) {
                                        if($images[$j] == $lectureAccueil['Infos'][$i]['image']) { ?>
                                        <option value="<?php echo $images[$j]; ?>"><?php echo $images[$j]; ?></option>
                                        <?php } ?>
                                        <?php }
                                        for($j = 2;$j < count($images);$j++) { ?>
                                        <option value="<?php echo $images[$j]; ?>"><?php echo $images[$j]; ?></option>
                                        <?php } ?>        
                                    </select>
                                    <label>Nom de la page (Option 1)</label>
                                    <select name="page<?php echo $i; ?>" class="form-control">
                                        <?php if($typeNavRap[$i] == 1) {
                                            echo '<option value="'. $pageActive[$i] .'">'. $pageActive[$i] .'</option>';
                                        } else {
                                            echo '<option value="#">-- Page --</option>';
                                        } ?>
                                        <option value="boutique">Boutique</option>
                                        <option value="support">Support</option>
                                        <option value="voter">Voter</option>
                                        <option value="tokens">Jetons</option>
                                        <option value="forum">Forum</option>
                                        <?php $j = 0;
                                        while($j < count($pages)) { ?>
                                        <option value="<?php echo $pages[$j]; ?>"><?php echo $pages[$j]; ?></option>
                                        <?php $j++; } ?>
                                    </select>
                                    <label>Adresse du lien (Option 2)</label>
                                    <input type="text" class="form-control" name="lien<?php echo $i;?>" value="<?php if($typeNavRap[$i] == 2) echo $lectureAccueil['Infos'][$i]['lien']; ?>" placeholder="http://minecraft.net/"/>
                                    <h3>Choisissez quel mode de redirection vous souhaitez</h3>
                                    <label>
                                        <input type="radio" name="typeLien<?php echo $i; ?>" value="page" <?php if($typeNavRap[$i] == 1) echo 'checked'; ?>>
                                        Option 1: Je souhaite rediriger vers une page existante
                                    </label></br>
                                    <label>
                                        <input type="radio" name="typeLien<?php echo $i; ?>" value="lien" <?php if($typeNavRap[$i] == 2) echo 'checked'; ?>>
                                        Option 2: Je souhaite rediriger vers un lien personnalisé
                                    </label></br>
                                </div>
                                <?php } ?>
                                <input type="submit" class="btn btn-warning" value="Modifier la navigation rapide"/>
                            </div>
                        
                    </form>
                </div>
            </div>
        </div>

        <?php } if($_Joueur_['rang'] == 1 OR ($_PGrades_['PermsPanel']['home']['actions']['editMiniature'] == true AND $_PGrades_['PermsPanel']['home']['actions']['addSlider'] == true)) { ?>

        <div class="modal fade" id="newSlider" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Créer un slider</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-offset-3 text-center">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label>Message de l'image</label>
                                        <input type="text" class="form-control" name="message"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Choisissez une image <small>(les images se trouvent dans theme/upload/img/slider/</small></label>
                                        <select class="form-control" name="image">
                                            <?php for($j = 2;$j < count($imagesSlider);$j++) { ?>
                                            <option value="<?php echo $imagesSlider[$j]; ?>"><?php echo $imagesSlider[$j]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <input type="submit" class="btn btn-default" value="Ajouter une image au slider">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-lg-offset-3 text-center">
                            <div class="row">
                                <div class="col-lg-8">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php } ?>


    </div>