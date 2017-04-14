<?php

namespace Controller;

use Behat\Transliterator\Transliterator;
use Intervention\Image\ImageManagerStatic as Image;
use Respect\Validation\Validator as v;
use Model\UsersModel;
use Model\ProductsModel;
use Model\ProductsCategoryModel;
use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \W\Security\StringUtils;

class AdminController extends Controller
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
    
    if(isset($_GET['json']) && $_GET['json']){
		  $selectUsers = new UsersModel();
		  $this->showJson($selectUsers->findAll());
    }
    else{
      $this->show('admin/users');
    }
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

    if(isset($_POST['user_id']) && !empty($_POST['user_id']) && is_numeric($_POST['user_id'])){

      $user_id = (int) $_POST['user_id'];

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
	 * Supprimer un utilisateur
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
    
    if(isset($_GET['json']) && $_GET['json']){
		  $productsModel = new ProductsModel();
		  $this->showJson($productsModel->findAllWithCategory());
    }
    else{
      $this->show('admin/products');
    }
	}

	/**
	 * Ajouter un produit
	 */
	public function add_product()
	{
		$this->allowTo('admin');

		$productsCategoryModel = new ProductsCategoryModel();
		$categories = $productsCategoryModel->findAllGroupByName();

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

    if(isset($_POST['prod_id']) && !empty($_POST['prod_id']) && is_numeric($_POST['prod_id'])){

      $prod_id = (int) $_POST['prod_id'];

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
    
    if(isset($_GET['json']) && $_GET['json']){
		  $productsCategoryModel = new ProductsCategoryModel();
		  $this->showJson($productsCategoryModel->findAll());
    }
    else{
      $this->show('admin/categories');
    }
	}

	/**
	 * Ajouter une catégorie
	 */
	public function add_category()
	{
		$this->allowTo('admin');

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

			if(count($errors) !== 0) {
				$this->showJson(array('status' => 'error', 'message' => implode('<br>', $errors)));
			}
			// données valides
			else {
					
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

    if(isset($_POST['category_id']) && !empty($_POST['category_id']) && is_numeric($_POST['category_id'])){

      $category_id = (int) $_POST['category_id'];

			$productsCategoryModel = new productsCategoryModel();
      if($productsCategoryModel->delete($category_id)){
        $this->showJson(['status' => 'success', 'message' => 'Catégorie #'.$category_id.' supprimée']);
      }
    }
    else {
      $this->showJson(['status' => 'error', 'message' => 'Erreur: ID invalide']);
    }
  }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}