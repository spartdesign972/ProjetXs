<?php
namespace Controller;

use \Model\ProductsCustomModel;
use \W\Controller\Controller;

class CartController extends Controller
{
    public function showcart()
    {

        if (!empty($_SESSION['cart'])) {
            $this->show('default/cart');
        } else {
            echo '<div class="alert alert-danger">Votre panier est vide</div>';
        }
    }
    
    public function fonctionsPanier($id)
    {
        unset($_SESSION);
        $design     = new ProductsCustomModel();
        $desingCart = $design->find($id);

        $_SESSION['cart'][] = [
            'id'             => $id,
            'libelleProduit' => $desingCart['design_label'],
            'ref'            => $desingCart['product_reference'],
            'image'          => $desingCart['model'],
        ];
        $this->show('default/cart', $_SESSION['cart']);
    }
}
