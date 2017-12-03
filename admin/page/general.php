<div class="cmw-page-content-header"><strong>Réglages site</strong> - Modifiez votre accès MySQL ou les informations de votre site</div>

<?php if($_Joueur_['rang'] != 1 AND $_PGrades_['PermsPanel']['general']['actions']['editGeneral'] == false) { ?>

<div class="text-center">
    <div class="alert alert-danger">
        <strong>Vous avez aucune permission pour accéder aux réglages généraux.</strong>
    </div>
</div>

<?php } else { ?>

<div class="text-center">
    <div class="alert alert-success">
        <strong>Modifiez ici les informations principales de votre serveur. La plupart des autres données du site dépendent de la base de données, qui est donc essentielle, changez les identifiants de la base seulement si vous savez ce que vous faites ! </strong>
    </div>
</div>

<?php } if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['general']['actions']['editGeneral'] == true) { ?>

<form method="POST" action="?&action=general">
    <div class="text-center">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                  <div class="col-xs-12 col-md-6" style="padding: 10px;">
                    <h3>Informations</h3>
                    
                        <label class="control-label">Adresse du site</label>
                        <input type="url" name="adresseWeb" class="form-control text-center" placeholder="http://monsiteminecraft.fr/" value="<?php echo $lecture['General']['url']; ?>">
                    
                        <label class="control-label">Nom du serveur</label>
                        <input type="text" name="nom" class="form-control text-center" placeholder="MineServeur" value="<?php echo $lecture['General']['name']; ?>">

                        <label class="control-label">Description</label>
                        <input type="text" name="description" class="form-control text-center" placeholder="Mon super serveur minecraft !" value="<?php echo $lecture['General']['description']; ?>">
                </div>

                <div class="col-xs-12 col-md-6" style="padding: 10px;">
                    <h3>Base de données</h3>
                        <label class="control-label">Adresse</label>
                        <input type="text" name="adresse" class="form-control text-center" placeholder="localhost" value="<?php echo $lecture['DataBase']['dbAdress']; ?>">

                        <label class="control-label">Nom de la base</label>
                        <input type="text" name="dbNom" class="form-control text-center" placeholder="BaseSite" value="<?php echo $lecture['DataBase']['dbName']; ?>">

                        <label class="control-label">Nom d'utilisateur</label>
                        <input type="text" name="dbUtilisateur" class="form-control text-center" placeholder="root" value="<?php echo $lecture['DataBase']['dbUser']; ?>">

                        <label class="control-label">Mot de passe</label>
                        <input type="password" name="dbMdp" class="form-control text-center" placeholder="Balançoire" value="<?php echo $lecture['DataBase']['dbPassword']; ?>">
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <input type="submit" class="btn btn-danger" value="Valider les changements" />
            </div>
            <br/>
        </div>
    </div>
</div>
</form>
<?php } ?>