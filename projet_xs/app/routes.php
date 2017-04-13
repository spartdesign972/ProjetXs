<?php

$w_routes = array(

    ['GET', '/', 'Default#home', 'default_home'],

    //Route qui affiche la liste des design mis a disposition par le utilisateurs
    ['GET|POST', '/creation-des-membres', 'Default#showAlldesignMembres', 'default_showalldesignmembre'],

    ['GET|POST', '/creation-des-membres/[:column]/[:ord]', 'Default#designMembres', 'default_designmembre'],
    
    ['GET|POST', '/creation-des-membres/[i:id]', 'Default#membredesignMembres', 'default_membredesignmembre'],
    
    // Route ou les utilisateurs sont rediriger pour se connecter
    ['GET|POST', '/login', 'Default#connect', 'login'],
    ['GET|POST', '/password', 'Default#password', 'default_password'],
    ['GET|POST', '/forgot-password', 'Default#forgot_password', 'forgot_password'],
    ['GET|POST', '/new-password', 'Default#new_password', 'new_password'],

    ['GET|POST', '/logout', 'Default#logout', 'logout'],
    // route de la page de souscription
    ['GET|POST', '/subscribe', 'Default#subscribe', 'default_subscribe'],

    ['GET|POST', '/informations', 'Default#modifInfos', 'default_modifInfos'],

    ['GET|POST', '/contact', 'Default#contact', 'default_contact'],
    // Administration BACK
    ['GET|POST', '/admin', 'Admin#showadmin', 'admin_showadmin'],
    ['GET|POST', '/admin/login', 'Admin#login', 'admin_login'],		
    ['GET|POST', '/admin/logout', 'Admin#logout', 'admin_logout'],
    ['GET|POST', '/admin/users', 'Admin#users', 'admin_users'],
    ['GET|POST', '/admin/user-details/[i:id]', 'Admin#user_details', 'admin_user_details'],
    ['GET|POST', '/admin/delete-user', 'Admin#delete_user', 'admin_delete_user'],
    ['GET|POST', '/admin/change-role', 'Admin#change_role', 'admin_change_role'],

    //Page de personnalisation des Tshirt
    ['GET|POST', '/custom', 'Default#custom', 'default_custom'],

    ['GET|POST', '/useradmin', 'Users#showuser', 'user_showuser'],

    ['GET|POST', '/listorders', 'Users#listOrders', 'users_listOrders'],

    ['GET|POST', '/vieworders/[i:id]','Users#viewOrder', 'users_viewOrder'],

    ['GET|POST', '/listdesigns', 'Users#listDesigns', 'user_listDesigns'],
    
    ['GET|POST', '/deletedesign', 'Users#deleteDesign', 'user_deleteDesign'],
    
    // ['GET|POST', '/cart', 'Default#showcart', 'default_showcart'],
    
    ['GET|POST', '/cart', 'Cart#creationPanier', 'cart_creationPanier'],
    
);