<?php

namespace Controller;

use Behat\Transliterator\Transliterator;
use Intervention\Image\ImageManagerStatic as Image;
use Model\ContactFormModel;
use Respect\Validation\Validator as v;
use \W\Controller\Controller;
use \W\Model\UsersModel;
use \W\Security\AuthentificationModel;

class DefaultController extends Controller
{

public function ListOrders($orderBy = 'id', $orderDir = 'ASC')
	{

		$listarticle = new OrdersModel();
		$arti = $listarticle->findAll();
		$params = [
		'Order' => $Order,
		];
		
		$this->show('User/listOrders', $params);

	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////





}