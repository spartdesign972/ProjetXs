<?php

namespace Controller;

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
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function ViewOrder($id)
    {
        $success = false;
        $error   = [];

        $view = new OrdersModel();
        $order  = $view->find($id);

        // $listAll = new CommentsModel();
        // $arti = $id;
        // $viewComment = $listAll->findAllcomment($arti);
        // // echo json_encode($viewComment);

        $params = [
            'view_order' => $order,
            // 'commentos' => $viewComment,
            "success"       => $success,
            "error"         => $error,
        ];
        //affiche un template
        $this->show('User/viewOrder', $params);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
