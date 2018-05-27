<?php 

if(isset($_Joueur_) AND isset($_POST['id_answer']))
{
	$id = htmlspecialchars($_POST['id_answer']);
	$req = $bddConnection->prepare('SELECT contenue FROM cmw_forum_answer WHERE id = :id');
	$req->execute(array(
		'id' => $id
	));
	$donnee = $req->fetch();
	?><header class="heading-pagination">
	<div class="container-fluid">
		<h1 class="text-uppercase wow fadeInRight" style="color:white;">Edition d'une réponse</h1>
	</div>
</header><section class="layout" id="page"><form action="?action=edit_answer" method="POST">
	<div class="container">
		<h4 class="title">Edition d'une réponse</h4>
		<input type="hidden" name="id_answer" value="<?php echo $id; ?>"/>
		<label for="contenue" class="control-label">Editez votre réponse</label><br/>
		<textarea name="contenue" maxlength="10000" class="form-control" id="contenue" rows="20"><?php echo $donnee['contenue']; ?></textarea>
		<button type="submit" class="btn btn-primary pull-right">Envoyer</button>
      </div>
	  </form></section>
      <?php 
}
else
	header('Location: ?page=erreur&erreur=0');
