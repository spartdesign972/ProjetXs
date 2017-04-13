<?php 

$w_config = [
   	//information de connexion à la bdd
	'db_host' => 'localhost',						//hôte (ip, domaine) de la bdd
    'db_user' => 'root',							//nom d'utilisateur pour la bdd
    'db_pass' => '',								//mot de passe de la bdd
    'db_name' => 'project_xs',								//nom de la bdd
    'db_table_prefix' => '',						//préfixe ajouté aux noms de table

	//authentification, autorisation
	'security_user_table' => 'users',				//nom de la table contenant les infos des utilisateurs
	'security_id_property' => 'id',					//nom de la colonne pour la clef primaire
	'security_username_property' => 'username',		//nom de la colonne pour le "pseudo"
	'security_email_property' => 'email',			//nom de la colonne pour l'"email"
	'security_password_property' => 'password',		//nom de la colonne pour le "mot de passe"
	'security_role_property' => 'role',				//nom de la colonne pour le "role"

	'security_login_route_name' => 'login',			//nom de la route affichant le formulaire de connexion

	// configuration globale
	'site_name'	=> '', 								// contiendra le nom du site

	// PHPMailer
	'phpmailer_host' => 'smtp.mailtrap.io',
	'phpmailer_port' => 25,
	'phpmailer_SMTPSecure' => 'tls',
	'phpmailer_SMTPAuth' => true,
	'phpmailer_username' => '3721836baaa816',
	'phpmailer_password' => '61fe9c7abd4482',

	// Coordonnées du site
	'site_title' => 'Tshirt Factory XS',
	'site_street' => '21 rue des Rosier',
	'site_zipcode' => '97200',
	'site_city' => 'Fort de France',
	'site_country' => 'Martinique',
	'site_email' => 'tsfxs@orange.fr',
	'site_phone' => '0596 25 36 65',

];

require('routes.php');
 