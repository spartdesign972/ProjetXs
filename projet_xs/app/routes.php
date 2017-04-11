<?php

$w_routes = array(

    ['GET', '/', 'Default#home', 'default_home'],
    // Route ou les utilisateurs sont rediriger pour se connecter
    ['GET|POST', '/connection', 'Default#connect', 'login'],
    ['GET|POST', '/forgot-password', 'Default#forgot_password', 'forgot_password'],
    ['GET|POST', '/new-password', 'Default#new_password', 'new_password'],

    ['GET|POST', '/logout', 'Default#logout', 'logout'],

    // route de la page de souscription
    ['GET|POST', '/subscribe', 'Default#subscribe', 'default_subscribe'],

    ['GET|POST', '/modifInfos', 'Default#modifInfos', 'default_modifInfos'],

    ['GET|POST', '/contactez-nous', 'Default#contact', 'default_contact'],

    // Administration BACK
    ['GET|POST', '/admin', 'Admin#showadmin', 'admin_showadmin'],
    ['GET|POST', '/admin/login', 'Admin#login', 'admin_login'],		
    ['GET|POST', '/admin/logout', 'Admin#logout', 'admin_logout'],
    ['GET|POST', '/admin/users', 'Admin#users', 'admin_users'],
    ['GET|POST', '/admin/user_details/[i:id]', 'Admin#user_details', 'admin_user_details'],
    ['GET|POST', '/admin/delete_user', 'Admin#delete_user', 'admin_delete_user'],

    ['GET|POST', '/admin/listDesigns', 'Admin#showDesigns', 'admin_showDesigns'],
    //Page de personnalisation des Tshirt
    ['GET|POST', '/custom', 'Default#custom', 'default_custom'],

    ['GET|POST', '/useradmin', 'Users#showuser', 'user_showuser'],

    ['GET|POST', '/listorders', 'Users#listOrders', 'users_listOrders'],
    ['GET|POST', '/vieworders/[i:id]','Users#viewOrder', 'users_viewOrder'],    
    
);