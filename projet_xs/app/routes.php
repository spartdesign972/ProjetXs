<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],
		// Route ou les utilisateurs sont rediriger pour se connecter
		['GET|POST', '/connection', 'Default#connect', 'login'],

		['GET|POST', '/logout', 'Default#logout', 'logout'],



		// route de la page de souscription
		['GET|POST', '/subscribe', 'Default#subscribe', 'default_subscribe'],
		
		['GET|POST', '/modifInfos/[i:id]', 'Default#modifInfos', 'default_modifInfos'],

		['GET|POST', '/contactez-nous', 'Default#contact', 'default_contact'],

		['GET|POST', '/admin', 'Admin#showadmin', 'admin_showadmin'],
		
		['GET|POST', '/admin/listDesigns', 'Admin#showDesigns', 'admin_showDesigns'],
		//Page de personnalisation des Tshirt
    ['GET|POST', '/custom', 'Default#custom', 'default_custom'],

    ['GET|POST', '/useradmin', 'Users#showuser', 'user_showuser'],

	);