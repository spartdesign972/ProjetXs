<?php

namespace Controller;

use Model\OrdersModel;
use Model\ProductsCustomModel;
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
        // $this->allowTo('admin');
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

        $view           = new OrdersModel();
        $order          = $view->find($id);
        $panierCommande = json_decode($order['products']);

        $params = [
            'view_order'     => $order,
            "success"        => $success,
            "error"          => $error,
            'panierCommande' => $panierCommande,
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
        $params      = [
            'design' => $design,
        ];
        $this->show('User/listDesigns', $params);
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////

    public function deleteDesign()
    {
        // $this->allowTo('admin');

        if ($_POST['design_id'] && !empty($_POST['design_id']) && is_numeric($_POST['design_id'])) {

            $design_id = (int) $_POST['design_id'];

            $deletedesign = new ProductsCustomModel();
            if ($deletedesign->delete($design_id)) {
                $this->showJson(['status' => 'success', 'message' => 'Design #' . $design_id . ' supprimé']);
            }
        } else {
            $this->showJson(['status' => 'error', 'message' => 'Erreur: ID invalide']);
        }

    }

}
