<div class="cmw-page-content-header"><strong>Votes</strong> - Gérez vos votes</div>
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
        <?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['vote']['actions']['editSettings'] == false AND $_PGrades_['PermsPanel']['vote']['actions']['addVote'] == false)) { ?>
            <div class="col-lg-12 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux votes.</strong>
                </div>
            </div>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['actions']['editSettings'] == true) { ?>
        <div class="col-lg-12 text-justify">
            <div class="alert alert-success">
                <strong>Dans cette section vous pourrez configurez vos votes.</strong><br/>
                Pour le message, vous pouvez utilisez les tags : <ul>
                    <li> {JOUEUR} qui sera remplacé par le nom du joueur qui a voté</li>
                    <li> {QUANTITE} qui sera remplacé par la quantité de jetons site, ou d'item IG give</li>
                    <li> {ID} qui sera remplacé par l'id de l'item give IG </li>
                </ul>
                Pour la commande, vous pourrez utiliser : <ul>
                    <li> {JOUEUR} qui correspond au nom du joueur qui vote. </li>
                </ul>
                Bonne configuration ! 
            </div>
        </div>
    </div>
    <form method="POST" action="?&action=creerLienVote">
        <div class="col-lg-12">
            <div class="panel panel-default cmw-panel">
                <div class="panel-heading cmw-panel-header">
                    <h3 class="panel-title"><strong>Configuration des votes</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-5">
                        <h3>Réglages des votes</h3>
                        <div class="row">
                            <label class="control-label">Message affiché lors du vote</label>
                            <input type="text" name="message" class="form-control"/>
                        </div>
                        <div class="row">
                            <label class="control-label">Afficher le message ?</label>
                            <input type="radio" name="display" value="1" id="1" checked />
                            <label for="1"> Oui </label>
                            <input type="radio" name="display" value="2" id="2"/>
                            <label for="2"> Non </label>
                        </div>
                        <div class="row">
                            <label class="control-label">Executer une Commande/Give d'item</label>
                            <select name="action" class="form-control">
                                <option value="1"> Executer une commande </option>
                                <option value="2"> Give d'item </option>
                                <option value="3"> Give de jetons site</option>
                            </select>
                        </div>
                        <div class="row">
                            <label class="control-label">Obtention de la récompense</label>
                            <select name="methode" class="form-control">     
                                <option value="1"> Le serveur où il est en ligne </option>
                                <option value="2"> Le serveur de la catégorie </option>
                            </select>
                        </div>
                        <div class="row">
                            <label class="control-label">Commande à éxecuter (SANS /)</label>
                            <input type="text" name="cmd" class="form-control" />
                        </div>
                        <div class="row">
                            <label class="control-label">ID de l'item</label>
                            <input type="text" name="id" class="form-control" value="264" />
                        </div>
                    </div>
                    <div class="col-md-offset-1 col-md-6">
                        <div class="row">
                            <label class="control-label">Quantité de l'item à donné <strong>OU</strong> quantité de jeton à donner</label>
                            <input type="text" name="quantite" class="form-control" value="4" />
                        </div>
                        <div class="row">
                            <label class="control-label">Lien de vote du serveur</label>
                            <select name="serveur" class="form-control">        
                                <?php for($i = 0; $i < count($lectureServs); $i++) {        ?>
                                    <option value="<?php echo $i ?>"> <?php echo $lectureServs[$i]['nom']; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="row">
                            <label class="control-label">Lien de vote</label>
                            <input type="text" name="lien" placeholder="ex: http://serveurs-minecraft.com/...../" class="form-control" />
                        </div>
                        <div class="row">
                            <label class="control-label">Titre du lien</label>
                            <input type="text" name="titre" placeholder="ex: Voter sur McServ !" class="form-control" />
                        </div>
                        <div class="row">
                            <label class="control-label">Temps de vote</label>
                            <input type="number" name="temps" placeholder="ex: 86400 pour 24h" class="form-control" />
                        </div>
                        <hr>
                        <div class="row text-center">
                            <input type="submit" class="btn btn-success" value="Valider les changements !"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    <?php }
    if($_Joueur_['rang'] == 1 OR ($_PGrades_['PermsPanel']['vote']['actions']['resetVote'] == true OR $_PGrades_['PermsPanel']['vote']['actions']['deleteVote'] == true)) { ?>
        <div class="col-lg-12">
            <div class="panel panel-default cmw-panel">
                <div class="panel-heading cmw-panel-header">
                    <h3 class="panel-title"><strong>Edition des votes</strong></h3>
                </div>
                <div class="panel-body">
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['actions']['resetVote'] == true) { ?>
                        <div class="row text-center">
                            <h3>Réinitialisation</h3>
                            <a href="?action=resetVotes" class="btn btn-danger">Réinitialiser les votes</a>
                        </div>
                    <?php }
                    if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['actions']['deleteVote'] == true) { ?>
                        <div class="row">
                            <h3 class="text-center">Gestion des votes</h3>
                        </div>
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>Titre</th>
                                <th>Lien de vote</th>
                                <th>Catégorie</th>
                                <th>Récompense donnée sur</th>
                                <th>Récompense</th>
                                <th>Message</th>
                                <th>Temps entre chaque vote</th>
                                <th>Action</th>
                            </tr>
                        <?php while($donnees = $req_donnees->fetch())
                        {
                            ?><tr>
                                <td><?=$donnees['titre'];?></td>
                                <td><a href="<?=$donnees['lien'];?>" class="badge badge-primary"><?=$donnees['lien'];?></a></td>
                                <td><?php 
                                    $serv = intval($donnees['serveur']);
                                    echo $lectureServs[$serv]['nom'];
                                ?></td>
                                <td><?php echo ($donnees['methode'] == 1) ? 'Le serveur où le joueur est en ligne lors du vote' : 'Le serveur : '.$lectureServs[$donnees['serveur']]['nom']; ?></td>
                                <td><?php $action = explode(':', $donnees['action'], 2);
                                    if($action[0] == 'cmd')
                                        echo 'Commande : '.$action[1];
                                    elseif($action[0] == 'jeton')
                                        echo 'Give de '.$action[1].' jetons sur le site';
                                    else
                                    {
                                        $action = explode(':', $action[1]);
                                        echo 'Give de '.$action[3].' item : '.$action[1];
                                    }
                                    ?>
                                </td>
                                <td><?php echo (empty($donnees['message'])) ? 'Pas de message' : $donnees['message']; ?></td>
                                <td><?=$donnees['temps'];?></td>
                                <td><a href="?action=supprVote&id=<?=$donnees['id'];?>" class="btn btn-danger">Supprimer</a></td>
                            </tr><?php 
                        }
                        ?>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<!-- /.row -->