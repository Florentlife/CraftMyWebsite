<?php 

/*	Fichier de configuration des permissions et de leur affichage sur le panel
	
	-> Pour ajouter une permission il suffit de respecter la syntaxe ! 

*/

const PERMS = array(
	"PermsDefault" => array(
		"news" => array(
			"deleteMemberComm" => "Suppression des commentaires dans les nouveautés",
			"editMemberComm" => "Edition des commentaires dans les nouveautés"
		),
		"support" => array(
			"closeTicket" => "Ouvrir/Fermer les tickets dans le support",
			"deleteMemberComm" => "Suppression des commentaires dans le support",
			"editMemberComm" => "Edition des commentaires dans le support",
			"displayTicket" => "Voir les tickets privés dans le support"
		),
		"chat" => array(
			'color' => "Écrire en couleur sur le chat" 
		),
		"forum" => array(
			"perms" => "Niveau de permissions (forum, categories, sous-forum et topics). Aura a accès à tous ce qui est inférieur ou égal a son niveau de permission.",
		)
	),
	"PermsPanel" => array(
		"access" => "Accès au panel",
		"info" => array(
			"showPage" => "Accès à la page <strong>informations</strong>",
			"details" => array(
				"player" => "Voir les joueurs en ligne",
				"console" => "Voir la console",
				"command" => "Accès aux commandes",
				"plugins" => "Voir les plugins",
				"server" => "Accès aux infos du serveur"
			),
			"stats" => array(
				"visitors" => array(
					"showTable" => "Voir les stats des visiteurs"
				),
				"members" => array(
					"showTable" => "Voir les stats des inscriptions",
					"editLimitIp" => "Edition de la limite d'inscription par IP",
					"editEmail" => "Edition de la limite d'inscription par email",
					"showIP" => "Voir les adresse IP des joueurs"
				),
				"activity" => array(
					"showTable" => "Voir les stats des activités"
				)
				"shop" => array(
					"showTable" => "Voir les stats de la boutique"
				)
			)
		),
		"general" => array(
			"showPage" => "Accès à la page <strong>Réglage Site</strong>",
			"actions" => array(
				"editGeneral" => "Edition des réglages sites (base de donnée, IP minecraft ...)"
			)
		),
		"theme" => array(
			"showPage" => "Accès à la page <strong>Thème</strong>",
			"actions" => array(
				"editTheme" => "Edition du thème",
				"editBackground" => "Edition du fond d'écran",
				"editTypeBackground" => "Edition du type de fond d'écran"
			)
		),
		"sliderMini" => array(
			"showPage" => "Accès à la page <strong>Slider & Miniatures</strong>"
		),
		"home" => array(
			"showPage" => "Accès à la page <strong>Accueil</strong>",
			"actions" => array(
				"uploadSlider" => "Uploader un slider",
				"editSlider" => "Edition des sliders",
				"uploadMiniature" => "Uploader une miniature",
				"editMiniature" => "Edition des miniatures",
				"addSlider" => "Ajouter un slider"
			)
		),
		"server" => array(
			"showPage" => "Accès à la page <strong>Réglage Serveur</strong>",
			"actions" => array(
				"addServer" => "Ajouter un serveur",
				"editServer" => "Edition d'un serveur"
			)
		),
		"pages" => array(
			"showPage" => "Accès à la page <strong>Pages Personnalisées</strong>",
			"actions" => array(
				"editPage" => "Edition des pages",
				"addPage" => "Ajouter une page"
			)
		),
		"news" => array(
			"showPage" => "Accès à la page <strong>Nouveautés</strong>",
			"actions" => array(
				"addNews" => "Ajouter une nouveauté",
				"editNews" => "Edition des nouveautés"
			)
		),
		"shop" => array(
			"showPage" => "Accès à la page <strong>Réglage Boutique</strong>",
			"actions" => array(
				"addCategorie" => "Ajouter une catégorie",
				"addOffre" => "Ajouter une offre",
				"editCategorieOffre" => "Edition des offres/catégories"
			),
			"achatEvo" => array(
				"showPage" => "Accès à la page <strong>Réglage des achats évolutifs</strong>"
			),
			"boutiqueList" => array(
				"showPage" => "Accès à la page <strong>Historique des achats</strong>"
			)
		),
		"payment" => array(
			"showPage" => "Accès à la page <strong>Payement</strong>",
			"actions" => array(
				"editPayment" => "Edition des paiements",
				"addOffrePaypal" => "Ajouter une offre PayPal",
				"editOffrePaypal" => "Edition des offres PayPal"
			)
		),
		"menus" => array(
			"showPage" => "Accès à la page <strong>Menus</strong>",
			"actions" => array(
				"addLinkMenu" => "Ajouter un lien menu",
				"addDropLinkMenu" => "Ajouter un menu déroulant",
				"editDropAndLinkMenu" => "Edition des lien menus/déroulants"
			)
		),
		"vote" => array(
			"showPage" => "Accès à la page <strong>Voter</strong>",
			"actions" => array(
				"editSettings" => "Edition des réglages",
				"addVote" => "Ajouter un lien de vote",
				"resetVote" => "Réinitialiser les votes",
				"deleteVote" => "Supprimer un lien de vote"
			),
			"recompenseAuto" => array(
				"showPage" => "Accès à la page <strong>Réglage des récompenses auto</strong>"
			)
		),
		"members" => array(
			"showPage" => "Accès à la page <strong>Membres=>Informations</strong>",
			"actions" => array(
				"editMember" => "Edition des membres"
			)
		),
		"forum" => array(
			"showPage" => "Accès à la page <strong>Forum</strong>",
			"actions" => array(
				"addSmiley" => "Ajout de smileys",
				"seeSmileys" => "Voir/Supprimer les smileys",
				"addPrefix" => "Ajouter des prefixes de discussion",
				"seePrefix" => "Voir/supprimer les prefixes de discussion"
			)
		),
		"widgets" => array(
			"showPage" => "Accès à la page <strong>Widgets</strong>",
			"actions" => array(
				"addWidgets" => "Ajouter un Widget",
				"editWidgets" => "Edition des Widgets"
			)
		),
		"support" => array(
			"tickets" => array(
				"showPage" => "Accès à la page <strong>Tickets</strong>",
				"actions" => array(
					"editEtatTicket" => "Changer l'état des tickets",
					"deleteTicket" => "Supprimer un ticket"
				)
			),
			"maintenance" => array(
				"showPage" => "Accès à la page <strong>Maintenance</strong>",
				"actions" => array(
					"editDefaultMessage" => "Edition du message par défaut",
					"editAdminMessage" => "Edition du message adressé aux admins",
					"editEtatMaintenance" => "Changer l'état de la maintenance",
					"switchRedirectMode" => "Changer le mode de redirection",
					"connexionAdmin" => "Peut se connecter pendant une maintenance"
				)
			)
		),
		"update" => array(
			"showPage" => "Accès à la page <strong>Mise à jours</strong>"
		),
		"social" => array(
			"showPage" => "Accès à la page <strong>Membres=>Social</strong>"
		),
		"newsletter" => array(
			"showPage" => "Accès à la page <strong>Newsletter</strong>",
			"actions" => array(
				"send" => "Peut envoyer une newsletter"
			)
		),
		"upload" => array(
			"showPage" => "Accès à la page <strong>Upload</strong>",
			"manager" => "Peut gérer l'upload d'images"
		)
	),
	"PermsForum" => array(
		"general" => array(
			"addCategorie" => "Ajouter des Catégories",
			"addForum" => "Ajouter des Forums",
			"deleteForum" => "Supprimer des Forums",
			"deleteCategorie" => "Supprimer des Catégories",
			"addSousForum" => "Ajouter des Sous-Forums",
			"deleteSousForum" => "Supprimer des Sous-Forums",
			"modeJoueur" => "Passer au visuel Joueur/Administrateur"
		),
		"moderation" => array(
			"editTopic" => "Editer des Topics",
			"deleteMessage" => "Supprimer des Messages",
			"deleteTopic" => "Supprimer des Topics",
			"editMessage" => "Editer des Messages",
			"closeTopic" => "Fermer/Ouvrir des Topics",
			"mooveTopic" => "Déplacer des Topics",
			"seeSignalement" => "Voir les topics/messages signalés",
			"addPrefix" => "Ajouter/Enlever des préfixes de discussions",
			"epingle" => "Epingler des topics",
			"selTopic" => "Peut sélectionner des topics (les deux précédentes permissions sont inutiles sans celle-ci)"
		)
	)
);

?>