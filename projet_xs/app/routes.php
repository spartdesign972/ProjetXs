<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],

		// Route ou les utilisateurs sont rediriger pour se connecter
		['GET|POST', '/connection', 'Default#connect', 'login'],
		['GET|POST', 'logout', 'Default#logout', 'logout'],


		// route de la page de souscription
		['GET|POST', '/subscribe', 'Default#subscribe', 'default_subscribe'],


		['GET|POST', '/admin', 'admin#showadmin', 'admin_showadmin'],


		//Page de personnalisation des Tshirt
       ['GET|POST', '/custom', 'Default#custom', 'default_custom'],
	);