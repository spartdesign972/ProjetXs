<?php

namespace Controller;

use Behat\Transliterator\Transliterator;
use Intervention\Image\ImageManagerStatic as Image;
use Respect\Validation\Validator as v;
use Model\UsersModel;
use Model\ProductsModel;
use Model\ProductsCategoryModel;
use Model\OrdersModel;
use \W\Security\AuthentificationModel;
use \W\Security\StringUtils;

class AdminController extends MasterController
{
	/**
	 * Vérifie les droits d'accès de l'utilisateur en fonction de son rôle
	 * @param  string  	$role Le rôle pour lequel on souhaite vérifier les droits d'accès
	 * @return boolean 	true si droit d'accès, false sinon
	 */
	public function isGranted($role)
	{
		$app = getApp();
		$roleProperty = $app->getConfig('security_role_property');

		//récupère les données en session sur l'utilisateur
		$authentificationModel = new AuthentificationModel();
		$loggedUser = $authentificationModel->getLoggedUser();

		// Si utilisateur non connecté
		if (!$loggedUser){
			// Redirige vers le login
			$this->redirectToRoute('admin_login');
		}

		if (!empty($loggedUser[$roleProperty]) && $loggedUser[$roleProperty] === $role){
			return true;
		}

		return false;
	}

	/**
	 * Autorise l'accès à un ou plusieurs rôles
	 * @param mixed $roles Tableau de rôles, ou chaîne pour un seul
	 */
	public function allowTo($roles)
	{
		if (!is_array($roles)){
			$roles = [$roles];
		}
		foreach($roles as $role){
			if ($this->isGranted($role)){
				return true;
			}
		}

		$this->redirectToRoute('default_home');
	}

  /**
   * Page d'accueil Admin
   */
  public function showadmin()
  {
  	// Accessible que pour l'admin
		$this->allowTo('admin');

    $this->show('Admin/admin');
  }

  /**
   * Page de connexion
   */
	public function login()
	{
		if(!empty($this->getUser())) {
			$this->redirectToRoute('admin_showadmin');
		}

		$errorsText = '';
		if(!empty($_POST)){
			// nettoyage des données
			$post = array_map('trim', array_map('strip_tags', $_POST));

			$err = [
				(!v::notEmpty()->validate($post['login'])) ? 'Veuillez saisir votre email !' : null,
				(!v::notEmpty()->validate($post['password'])) ? 'Veuillez saisir votre mot de passe !' : null,
			];
			$errors = array_filter($err);


			if(count($errors) !== 0){
				$errorsText = implode('<br>', $errors);
			}
			else {				
				$authentification = new AuthentificationModel();				

				if(empty($authentification->isValidLoginInfo($post['login'], $post['password']))) {
					$errorsText = 'Indentifiants invalides';
				}
				else {
					$usersModel = new UsersModel();
					$authentification->logUserIn($usersModel->getUserByUsernameOrEmail($post['login']));

          $this->redirectToRoute('admin_showadmin');
				}
			}
		}
		$this->show('admin/login', ['errorsText' => $errorsText]);
	}

	/**
	 * Page de déconnexion
	 */
	public function logout()
	{
		$authentification = new AuthentificationModel();
		$authentification->logUserOut();
		$this->redirectToRoute('admin_showadmin');
	}

	/**
	 * Liste des utilisateurs
	 */
	public function users()
	{
    $this->allowTo('admin');
    
		$page		= (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int) $_GET['page'] : 1;
		$limit 	= (isset($_GET['limit']) && is_numeric($_GET['limit'])) ? (int) $_GET['limit'] : 10;
		
		$params = $this->paginate($page, $limit, new UsersModel(), 'findAll');

    $this->show('admin/users', $params);
	}

	/**
	 * Détails utilisateur
	 */
	public function user_details($user_id)
  {
    $this->allowTo('admin');

		if(isset($user_id) && !empty($user_id)) {

			$selectUser = new UsersModel();
			$user = $selectUser->find((int) $user_id);
		}
		else {
			$this->showForbidden();
		}
		$this->show('admin/user_details', ['user' => $user]);
  }

	/**
	 * Supprimer utilisateur
	 */
  public function delete_user()
  {
		$this->allowTo('admin');

    if(isset($_POST['id']) && !empty($_POST['id']) && is_numeric($_POST['id'])){

      $user_id = (int) $_POST['id'];
			$usersModel = new UsersModel();
			
      if($usersModel->delete($user_id)){
        $this->showJson(['status' => 'success', 'message' => 'Utilisateur #'.$user_id.' supprimé']);
      }
    }
    else {
      $this->showJson(['status' => 'error', 'message' => 'Erreur: ID invalide']);
    }
  }

	/**
	 * Change un rôle utilisateur
	 */
  public function change_role()
  {
		$this->allowTo('admin');

    if(isset($_POST['user_id']) && !empty($_POST['user_id']) && is_numeric($_POST['user_id'])){

      $user_id = (int) $_POST['user_id'];

			$usersModel = new UsersModel();
			$roleAvailables = $usersModel->findAllRoles();

			if(isset($_POST['user_role']) && !empty($_POST['user_role']) && in_array($_POST['user_role'], $roleAvailables)){

      	$user_role = $_POST['user_role'];

				if($usersModel->update(['role' => $user_role], $user_id)){
					$this->showJson(['status' => 'success', 'message' => 'Le rôle de l\'Utilisateur #'.$user_id.' a bien été changé en '.$user_role]);
				}
			}
			else{
				$this->showJson(['status' => 'error', 'message' => 'Erreur: Rôle invalide']);	
			}
    }
    else {
      $this->showJson(['status' => 'error', 'message' => 'Erreur: ID invalide']);
    }
  }

	/**
	 * Liste des produits
	 */
	public function products()
	{
    $this->allowTo('admin');
    
		$page		= (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int) $_GET['page'] : 1;
		$limit 	= (isset($_GET['limit']) && is_numeric($_GET['limit'])) ? (int) $_GET['limit'] : 10;

		$params = $this->paginate($page, $limit, new ProductsModel(), 'findAllWithCategory');

    $this->show('admin/products', $params);
	}

	/**
	 * Ajouter un produit
	 */
	public function add_product()
	{
		$this->allowTo('admin');

		$productsCategoryModel = new ProductsCategoryModel();
		$categories = $productsCategoryModel->findAll('name');

		$categories_id = [];
		foreach($categories as $category){
			$categories_id[] = $category['id'];
		}

		if(!empty($_POST)){
			// nettoyage des données
			$post = array_map('trim', array_map('strip_tags', $_POST));

			$err = [
				(!v::notEmpty()->validate($post['category_id']) || !in_array($post['category_id'], $categories_id)) ? 'Veuillez choisir une Catégorie.' : null,
				(!v::notEmpty()->validate($post['reference'])) ? 'Veuillez saisir une Référence.' : null,
				(!v::notEmpty()->validate($post['size'])) ? 'Veuillez saisir une Taille.' : null,
				(!v::notEmpty()->validate($post['color'])) ? 'Veuillez saisir une Couleur.' : null,
			];
			$errors = array_filter($err);

			if(count($errors) !== 0) {
				$this->showJson(array('status' => 'error', 'message' => implode('<br>', $errors)));
			}
			// données valides
			else {
					
				$productsModel = new ProductsModel();
				if(!empty($productsModel->insert($post))) {
					$this->showJson(array('status' => 'success', 'message' => 'Le produit a été ajouté avec succès'));
				}
			}
		}
		else{
		  $productsCategoryModel = new ProductsCategoryModel();

			$this->show('admin/add-product', ['categories' => $categories]);
		}

	}

	/**
	 * Supprimer un produit
	 */
  public function delete_product()
  {
		$this->allowTo('admin');

    if(isset($_POST['id']) && !empty($_POST['id']) && is_numeric($_POST['id'])){

      $prod_id = (int) $_POST['id'];
			$productsModel = new ProductsModel();

      if($productsModel->delete($prod_id)){
        $this->showJson(['status' => 'success', 'message' => 'Produit #'.$prod_id.' supprimé']);
      }
    }
    else {
      $this->showJson(['status' => 'error', 'message' => 'Erreur: ID invalide']);
    }
  }

	/**
	 * Liste des catégories
	 */
	public function categories()
	{
    $this->allowTo('admin');

		$page		= (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int) $_GET['page'] : 1;
		$limit 	= (isset($_GET['limit']) && is_numeric($_GET['limit'])) ? (int) $_GET['limit'] : 10;

		$params = $this->paginate($page, $limit, new ProductsCategoryModel(), 'findAll');

		$this->show('admin/categories', $params);
	}

	/**
	 * Ajouter une catégorie
	 */
	public function add_category()
	{
		$this->allowTo('admin');

		$upload_dir = 'assets/custom/';
		$maxSize    = (1024 * 1000) * 2;
		$extAllowed = ['jpg', 'jpeg', 'png', 'gif'];

		if(!empty($_POST)){
			// nettoyage des données
			$post = array_map('trim', array_map('strip_tags', $_POST));

			$err = [
				(!v::notEmpty()->validate($post['category'])) ? 'Veuillez saisir un Libellé.' : null,
				(!v::notEmpty()->validate($post['category_reference'])) ? 'Veuillez saisir une Référence.' : null,
				(!v::notEmpty()->validate($post['name'])) ? 'Veuillez saisir un Nom.' : null,
				(!v::notEmpty()->validate($post['description'])) ? 'Veuillez saisir une Description.' : null,
				(!v::notEmpty()->numeric()->validate($post['price'])) ? 'Veuillez saisir un Prix.' : null,
				(!v::notEmpty()->numeric()->validate($post['tax'])) ? 'Veuillez saisir un taux TVA.' : null,
			];
			$errors = array_filter($err);

			//-On verifie si la super Global $_FILES est definie et qu'elle ne comporte pas d'erreurs.
			if (isset($_FILES['view']) && $_FILES['view']['error'] == 0) {
					if (!is_dir($upload_dir)) { //-Si le fichier n'existe pas
							mkdir($upload_dir, 0755); // on le cree
					}

					$x = explode('.', $_FILES['view']['name']);
					if (in_array($x[1], $extAllowed)) {

							$img = Image::make($_FILES['view']['tmp_name']); //- créer une nouvelle ressource d'image à partir du fichier
							if ($img->filesize() > $maxSize) {
									//-Si la taille de l'image est superieure à la dimension donnée
									$errors[] = 'Image trop lourde, 2 Mo maximum';
							}
							if (!v::image()->validate($_FILES['view']['tmp_name'])) {
									//-On verifie si l'image est valide en verifiant son mimetype
									$errors[] = 'Image invalide';
							} else {
									switch ($img->mime()) {
											case 'image/jpg':
											case 'image/jpeg':
											case 'image/pjpeg':
													$ext = '.jpg';
													break;

											case 'image/png':
													$ext = '.png';
													break;
											case 'image/gif':
													$ext = '.gif';
													break;
									}
									$save_name = Transliterator::transliterate(time() . '-' . preg_replace('/\\.[^.\\s]{3,4}$/', '', $_FILES['view']['name']));
									$img->save($upload_dir . $save_name . $ext);
							}
					} else {
							$errors[] = 'Image invalide';
					}
			}

			if(count($errors) !== 0) {
				$this->showJson(array('status' => 'error', 'message' => implode('<br>', $errors)));
			}
			// données valides
			else {
				
				$post['view'] = $save_name.$ext;
				$productsCategoryModel = new ProductsCategoryModel();
				if(!empty($productsCategoryModel->insert($post))) {
					$this->showJson(array('status' => 'success', 'message' => 'La catégorie a été ajoutée avec succès'));
				}
			}
		}
		else{
			$this->show('admin/add-category');
		}

	}

	/**
	 * Supprimer une categorie
	 */
  public function delete_category()
  {
		$this->allowTo('admin');

    if(isset($_POST['id']) && !empty($_POST['id']) && is_numeric($_POST['id'])){

      $category_id = (int) $_POST['id'];

			$productsCategoryModel = new productsCategoryModel();
      if($productsCategoryModel->delete($category_id)){
        $this->showJson(['status' => 'success', 'message' => 'Catégorie #'.$category_id.' supprimée']);
      }
    }
    else {
      $this->showJson(['status' => 'error', 'message' => 'Erreur: ID invalide']);
    }
  }

	/**
	 * Liste des commandes
	 */
  public function orders()
  {
		$this->allowTo('admin');

    if(isset($_GET['json']) && $_GET['json']){
			$ordersModel = new OrdersModel();			
		  $this->showJson($ordersModel->findAllWithUsers());
    }
    else{
			$this->show('admin/orders');
		}
	}

	/**
	 * Change un état de commande
	 */
  public function change_status()
  {
		$this->allowTo('admin');

    if(isset($_POST['order_id']) && !empty($_POST['order_id']) && is_numeric($_POST['order_id'])){

      $order_id = (int) $_POST['order_id'];
			
			$ordersModel = new OrdersModel();
			$statusAvailables = $ordersModel->findAllStatus();

			if(isset($_POST['order_status']) && !empty($_POST['order_status']) && in_array($_POST['order_status'], $statusAvailables)){

      	$order_status = $_POST['order_status'];

				if($ordersModel->update(['status' => $order_status], $order_id)){
					$this->showJson(['status' => 'success', 'message' => 'L\'état de la commande #'.$order_id.' a bien été changé en '.$order_status]);
				}
			}
			else{
				$this->showJson(['status' => 'error', 'message' => 'Erreur: Etat invalide']);	
			}
    }
    else {
      $this->showJson(['status' => 'error', 'message' => 'Erreur: ID invalide']);
    }
  }

	public function send_order()
	{
		$this->allowTo('admin');

		if(isset($_POST['user_id']) && !empty($_POST['user_id']) && is_numeric($_POST['user_id'])){

			$usersModel = new UsersModel();
			$user = $usersModel->find((int) $_POST['user_id']);

			$fromAddress = 'noreply@factory-xs.com';
			$fromName    = 'Tshirt Factory XS';
			$toAddress   = $user['email'];
			$toName      = $user['firstname'] . ' ' . $user['lastname'];
			$subject     = 'Votre commande';

			$msgHTML     = '<html><head><title>Votre commande</title></head>';
			$msgHTML 		.= '<body><p>Votre commande est prête</p>';
			$msgHTML 		.= '</body></html>';

			$this->mailer($fromAddress, $fromName, $toAddress, $toName, $subject, $msgHTML);

			$this->showJson(['status' => 'success', 'message' => 'Le mail a bien été envoyé']);
		}
    else {
      $this->showJson(['status' => 'error', 'message' => 'Erreur: ID invalide']);
    }

	}

}