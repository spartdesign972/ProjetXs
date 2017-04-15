<?php
namespace Controller;

use \Model\ProductsCustomModel;
use \W\Controller\Controller;

class CartController extends Controller
{
    public function showcart()
    {

        if (!empty($_SESSION['cart'])) {
            $params = ['item' => $_SESSION['cart']];
            $this->show('default/cart', $params);
        } else {
            echo '<div class="alert alert-danger">Votre panier est vide</div>';
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function createcart($id)
    {
        // unset($_SESSION['cart']);

        $itemModel = new \Model\ProductsCustomModel();
        $product   = $itemModel->find($id);

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'][] = [
                'id'             => $id,
                'libelleProduit' => $product['design_label'],
                'ref'            => $product['product_reference'],
                'qty'            => 0,
                'image'          => $product['model'],
                'prix'           => 24,
            ];
        }

        if (isset($_SESSION['cart'])) {

            foreach ($_SESSION['cart'] as $key => $value) {
                $productsId[] = $value['id'];
            }
            if (!in_array($id, $productsId)) {
                $_SESSION['cart'][] = [
                    'id'             => $id,
                    'libelleProduit' => $product['design_label'],
                    'ref'            => $product['product_reference'],
                    'qty'            => 1,
                    'image'          => $product['model'],
                    'prix'           => 24,                  
                ];
            } else {
                foreach ($_SESSION['cart'] as $key => $value) {
                    if ($value['id'] === $id) {
                        $_SESSION['cart'][$key]['qty']++;
                       
                    }
                }
            }

        }

        $params = ['item' => $_SESSION['cart']];
        $this->show('default/cart', $params);

    }
}
