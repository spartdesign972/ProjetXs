<?php

namespace Controller;

use Behat\Transliterator\Transliterator;
use Intervention\Image\ImageManagerStatic as Image;
use Respect\Validation\Validator as v;
use \Model\UsersModel;
use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \W\Security\StringUtils;

class AdminController extends Controller
{
  /**
   * Page d'accueil Admin
   */
  public function showadmin()
  {
  	// Accessible que pour l'admin
		// $this->allowTo('admin');
    

    $this->show('Admin/admin');
  }

 }