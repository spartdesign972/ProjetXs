<?php
namespace Controller;

use Respect\Validation\Validator as v;
use \Model\ProductsCustomModel;
use \W\Controller\Controller;

class CartController extends Controller
{
    public function showcart()
    {
        $emptyCart = (!isset($_SESSION['cart']) || empty($_SESSION['cart']['id'])) ? 'Votre panier est vide' : null;

        $this->show('default/cart', ['emptyCart' => $emptyCart]);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function createcart($id)
    {
        if (!isset($id) || empty($id) || !is_numeric($id)) {
            $this->showJson([
                'status'  => 'error',
                'message' => 'Erreur : ID invalide',
            ]);
        } else {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [
                    'id'             => [],
                    'libelleProduit' => [],
                    'ref'            => [],
                    'qty'            => [],
                    'image'          => [],
                    'price'          => [],
                ];
            }

            $itemModel = new ProductsCustomModel();
            $product   = $itemModel->find($id);

            // Mise à jour de la Qté si déjà présent dans le panier
            $cartCount = 0;
            foreach ($_SESSION['cart']['id'] as $key => $value) {
                if ($id == $value) {
                    $_SESSION['cart']['qty'][$key]++;
                    break;
                }
                $cartCount++;
            }
            // Ajout si absent du panier
            if ($cartCount == count($_SESSION['cart']['id'])) {

                $_SESSION['cart']['id'][]             = $id;
                $_SESSION['cart']['libelleProduit'][] = $product['design_label'];
                $_SESSION['cart']['ref'][]            = $product['product_reference'];
                $_SESSION['cart']['qty'][]            = 1;
                $_SESSION['cart']['image'][]          = $product['model'];
                $_SESSION['cart']['price'][]          = $product['price'];
            }

            $this->showJson([
                'status'  => 'success',
                'message' => 'Design ajouté au panier',
            ]);

        }

    }

    public function edit_cart()
    {
        if (!empty($_POST)) {
            // nettoyage des données
            $post = array_map('trim', array_map('strip_tags', $_POST));

            // gestion des erreurs
            $err = [
                (!v::notEmpty()->numeric()->validate($post['design_id'])) ? 'Erreur: Design ID invalide' : null,
                (!v::notEmpty()->intVal()->validate($post['qty'])) ? 'Erreur: Quantité invalide' : null,
            ];
            $errors = array_filter($err);

            if (count($errors) !== 0) {
                $this->showJson([
                    'status'  => 'error',
                    'message' => implode('<br>', $errors),
                ]);
            } else {
                // mise à jour de la quantité
                foreach ($_SESSION['cart']['id'] as $key => $value) {
                    if ($post['design_id'] == $value) {
                        $_SESSION['cart']['qty'][$key] = $post['qty'];
                        break;
                    }
                }

                $this->showJson([
                    'status'  => 'success',
                    'message' => 'Quantité modifiée',
                ]);

            }
        }
    }

    public function remove_cart()
    {
        if (!empty($_POST)) {
            // nettoyage des données
            $post = array_map('trim', array_map('strip_tags', $_POST));

            // gestion des erreurs
            $err = [
                (!v::notEmpty()->numeric()->validate($post['design_id'])) ? 'Erreur: Design ID invalide' : null,
            ];
            $errors = array_filter($err);

            if (count($errors) !== 0) {
                $this->showJson([
                    'status'  => 'error',
                    'message' => implode('<br>', $errors),
                ]);
            } else {
                // On crée un panier temporaire
                $tmp = [
                    'id'             => [],
                    'libelleProduit' => [],
                    'ref'            => [],
                    'qty'            => [],
                    'image'          => [],
                    'price'          => [],
                ];

                foreach ($_SESSION['cart']['id'] as $key => $value) {
                    if ($post['design_id'] != $value) {

                        $tmp['id'][]             = $value;
                        $tmp['libelleProduit'][] = $_SESSION['cart']['libelleProduit'][$key];
                        $tmp['ref'][]            = $_SESSION['cart']['ref'][$key];
                        $tmp['qty'][]            = $_SESSION['cart']['qty'][$key];
                        $tmp['image'][]          = $_SESSION['cart']['image'][$key];
                        $tmp['price'][]          = $_SESSION['cart']['price'][$key];
                    }
                }
                //On remplace le panier en session par notre panier temporaire à jour
                $_SESSION['cart'] = $tmp;
                //On efface notre panier temporaire
                unset($tmp);

                $this->showJson([
                    'status'  => 'success',
                    'message' => 'Design retiré',
                ]);

            }
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function order($id)
    {
        $successText = '';
        $errorsText  = '';
        $panierCommande = [];
        $datas       = [
            // colonne sql => valeur à insérer
            'user_id'     => $_SESSION['user']['id'],
            'products'    => json_encode($_SESSION['cart']),
            'total'       => array_sum($_SESSION['cart']['price']),
            'date_create' => date("Y-m-d H:i:s"),
        ];
        $order = new OrdersModel();
        if ($order->insert($datas)) {

        $vieworder = $order->find($id);


            $successText = 'Votre commande a été ajoutée avec succès';
        } else {
            $errorsText = 'Il y a eu un problem à l\'ajout de votre commande';
        }
        $params = [
            'successText' => $successText,
            'errorsText'  => $errorsText,

        ];
        $this->show('default/messageOrder',$params);
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}
