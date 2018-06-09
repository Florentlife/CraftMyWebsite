ALTER TABLE cmw_forum_sous_forum ADD ordre INT UNSIGNED NOT NULL, ADD close TINYINT UNSIGNED NOT NULL;

ALTER TABLE cmw_forum ADD perms INT UNSIGNED NOT NULL;
ALTER TABLE cmw_forum_categorie ADD perms INT UNSIGNED NOT NULL;
ALTER TABLE cmw_forum_post ADD perms INT UNSIGNED NOT NULL;
ALTER TABLE cmw_forum_sous_forum ADD perms INT UNSIGNED NOT NULL;

ALTER TABLE cmw_users ADD show_email TINYINT UNSIGNED NOT NULL;

ALTER TABLE cmw_boutique_offres ADD nbre_vente INT NOT NULL AFTER prix;

ALTER TABLE `cmw_maintenance` ADD `dateFin` INT(11) NOT NULL AFTER `maintenanceEtat`;