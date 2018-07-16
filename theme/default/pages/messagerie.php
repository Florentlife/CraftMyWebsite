<header class="heading-pagination">
	<div class="container-fluid">
		<h1 class="text-uppercase wow fadeInRight" style="color:white;">Messagerie</h1>
	</div>
</header>
<section class="layout" id="page">
	<div class="container">	
		<h3>Messagerie ...</h3>
		<div class="categories-edit">
			<ul class="nav nav-tabs" id="modifProfil">
				<li class="col-md-6 active"><a href="#conversation" data-toggle="tab"><center>Conversations</center></a></li>
				<li class="col-md-6"><a data-toggle="modal" data-backdrop="static" href="#modalRep"><center>Nouveau message</center></a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div class="tab-pane active" style="margin-top: 10px;" id="infos">
				<?php
				$Messagerie = new Messagerie($bddConnection, $_Joueur_['pseudo']);
				$messages = $Messagerie->getConversations();
				if(!empty($messages['conv']))
				{
					?>
					<h3 class="text-center">Vous avez <?=$messages['nbConversations'];?> conversations</h3>
					<div id="accordion">
						<?php echo $messages['conv'];?>
						</div>
						<nav aria-label="Pages Conversation">
						  <ul class="pagination">
						  	<?php
						  	for($i = 1; $i <= $messages['nbPages']; $i++)
						  	{
						  		echo '<li class="page-item"><a class="page-link" onClick="getConversations('.$i.');">'.$i.'</a></li>';
						  	}
							?>
						  </ul>
						</nav>
					<?php 
				}
				?>
			</div>
	</div>
</section>