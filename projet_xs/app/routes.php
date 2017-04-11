<?php

$w_routes = array(
    ['GET', '/', 'Default#home', 'default_home'],
    // Route ou les utilisateurs sont rediriger pour se connecter
    ['GET|POST', '/connection', 'Default#connect', 'login'],

    ['GET|POST', '/logout', 'Default#logout', 'logout'],

    // route de la page de souscription
    ['GET|POST', '/subscribe', 'Default#subscribe', 'default_subscribe'],

    ['GET|POST', '/modifinfos/[i:id]', 'Default#modifInfos', 'default_modifInfos'],

    ['GET|POST', '/contactez-nous', 'Default#contact', 'default_contact'],

    ['GET|POST', '/admin', 'Admin#showadmin', 'admin_showadmin'],

    //Page de personnalisation des Tshirt
    ['GET|POST', '/custom', 'Default#custom', 'default_custom'],

    ['GET|POST', '/useradmin', 'Users#showuser', 'user_showuser'],

    ['GET|POST', '/listorders', 'Users#listOrders', 'users_listOrders'],
    
    ['GET|POST', '/vieworders/[i:id]','Users#viewOrder', 'users_viewOrder'],
    
    ['GET|POST', '/listdesigns', 'Users#listDesigns', 'user_listDesigns'],
    
);