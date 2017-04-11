<?php

namespace Controller;

use Model\OrdersModel;
use \W\Controller\Controller;
use Model\ProductsCustomModel;

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
        $this->allowTo('admin');
        $loggedUser = $this->getUser();

        $listorders = new OrdersModel();
        $Order      = $listorders->findUserOrder($loggedUser['id']);
        $params     = [
            'Order' => $Order,
        ];
        $this->show('User/listOrders', $params);

    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function ViewOrder($id)
    {
        $success = false;
        $error   = [];

        $view  = new OrdersModel();
        $order = $view->find($id);

        // $listAll = new CommentsModel();
        // $arti = $id;
        // $viewComment = $listAll->findAllcomment($arti);
        // // echo json_encode($viewComment);

        $params = [
            'view_order' => $order,
            "success"    => $success,
            "error"      => $error,
        ];
        //affiche un template
        $this->show('User/viewOrder', $params);
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function listDesigns($orderBy = 'id', $orderDir = 'ASC')
    {
        // $this->allowTo('admin');
        $loggedUser = $this->getUser();

        $listdesigns = new ProductsCustomModel();
        $design      = $listdesigns->findUserDesign($loggedUser['id']);
        $params     = [
            'design' => $design,
        ];
        $this->show('User/listDesigns', $params);
    }

}
