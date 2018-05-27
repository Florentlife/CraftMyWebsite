<?php 

if(isset($_Joueur_) AND isset($_POST['id_topic']))
{
	$id = htmlspecialchars($_POST['id_topic']);
	$req = $bddConnection->prepare('SELECT * FROM cmw_forum_post WHERE id = :id');
	$req->execute(array(
		'id' => $id
	));
	$donnee = $req->fetch();
	?>
	<header class="heading-pagination">
	<div class="container-fluid">
		<h1 class="text-uppercase wow fadeInRight" style="color:white;">Edition du topic :<?php echo $donnee['nom']; ?></h1>
	</div>
</header><section class="layout" id="page"><form action="?action=edit_topic" method="POST">
	<div class="container">
        <input type="hidden" name="id_topic" value="<?php echo $id; ?>"/>
        <label for="contenue" class="control-label">Editez votre contenu</label><br/>
        <textarea name="contenue" maxlength="10000" class="form-control" id="contenue" rows="20"><?php echo $donnee['contenue']; ?></textarea>
        <hr>
        <button type="submit" class="btn btn-primary pull-right">Envoyer</button>
      </div>
	  </form></section>
      <?php 
}
else
	header('Location: ?page=erreur&erreur=0');