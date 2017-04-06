<?php
	
	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],

		// Route ou les utilisateurs sont rediriger pour se connecter
		['GET', '/connection', 'Default#connect', 'login'],

		// route de la page de souscription
		['GET', '/subscribe', 'Default#subscribe', 'default_subscribe'],
	);