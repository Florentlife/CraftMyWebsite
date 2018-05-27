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
        <div class="panel panel-default cmw-panel">
			<div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Configuration des données de base</strong></h3>
            </div>
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

                        <label class="control-label">Adresse de votre serveur Minecraft (textuel)</label>
                        <input type="text" name="ipTexte" class="form-control text-center" placeholder="cmw.minesr.com" value="<?php echo $lecture['General']['ipTexte']; ?>">

                        <label class="control-label">Adresse de votre serveur Minecraft (sous forme d'IP, sans le port !)</label>
                        <input type="text" name="ip" class="form-control text-center" placeholder="172.16.254.1" value="<?php echo $lecture['General']['ip']; ?>">

                        <label class="control-label">Port de votre serveur Minecraft</label>
                        <input type="number" name="port" class="form-control text-center" placeholder="25565" value="<?php echo $lecture['General']['port']; ?>">
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
</form>
<form action="?action=ajout_favicon" method="POST" enctype="multipart/form-data">
    <div class="text-center">
        <div class="panel panel-default cmw-panel">
           <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Configuration du favicon</strong></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col">
                        <h3>Favicon du site</h3>

                        <label class="control-label">Fichier favicon (le précédent sera écrasé)
                        <input type="file" id="file" name="favicon" class="custom-file-input">
                        <span class="custom-file-control"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <input type="submit" class="btn btn-danger" value="Envoyer le Favicon"/>
            </div>
        </div>
    </div>
</form>
<?php } ?>