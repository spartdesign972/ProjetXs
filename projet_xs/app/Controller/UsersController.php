<?php

namespace Controller;

use Behat\Transliterator\Transliterator;
use Intervention\Image\ImageManagerStatic as Image;
use Model\ContactFormModel;
use Respect\Validation\Validator as v;
use Model\OrdersModel;
use \W\Controller\Controller;

class UsersController extends \W\Controller\Controller
{

    /**
     * Page d'accueil par défaut
     */
    public function showuser()
    {
        $this->show('User/userAdmin');
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function ListOrders($orderBy = 'id', $orderDir = 'ASC')
    {


        $listorders = new OrdersModel();
        $Order      = $listorders->findAll();
        $params     = [
            'Order' => $Order,
        ];

        $this->show('User/listOrders', $params);

    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}
