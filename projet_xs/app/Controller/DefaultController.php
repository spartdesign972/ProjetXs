<?php

namespace Controller;

use Behat\Transliterator\Transliterator;
use Intervention\Image\ImageManagerStatic as Image;
use Respect\Validation\Validator as v;
use \W\Controller\Controller;

class DefaultController extends Controller
{
  /**
   * Page d'accueil par défaut
   */
  public function home()
  {
    $this->show('default/home');
  }

  /**
   * Page de connection/identification
   */
  public function connect()
  {
    // si le post n'est pas vide, on récupère les données "nettoyées"
    if (!empty($_POST)) {
      $post = array_map('trim', array_map('strip_tags', $_POST));

      $err = [
        //-On verifie si l'email est valide
        (!v::notEmpty()->email()->validate($post['email'])) ? 'L\'adresse email est invalide' : null,
        (!v::notEmpty()->length(8, 30)->validate($post['password'])) ? 'Le mot de passe est invalide' : null,
      ];

      $errors = array_filter($err);
      if (count($errors) === 0) {
        $success = true;

        $User = new AuthentificationModel();
        $id   = $User->isValidLoginInfo($post['ident'], $post['passwd']);
        if ($id) {
          $ident   = new UsersModel();
          $tmpUser = $ident->find($id);
          $User->logUserIn($tmpUser);
          $success = true;
          $this->flash('Vous etes bien connecté', 'info');
        }

      }
    }
    $this->show('default/connect');

  }

  public function subscribe()
  {
//-Declaration des diff variables
    $post       = [];
    $upload_dir = 'upload/';
    $maxSize    = (1024 * 1000) * 2;

// si le post n'est pas vide, on récupère les données "nettoyées"
    if (!empty($_POST)) {
      $post = array_map('trim', array_map('strip_tags', $_POST));

      $err = [
        //-On verifie si l'input n'est pas vide, si il ne comporte pas de caracteres qu'on ne veut pas, et si la taille de la chaine est comprise entre 2 et 30 caracteres.
        (!v::notEmpty()->alpha('-.')->length(2, 30)->validate($post['lastname'])) ? 'Le nom de famille est invalide' : null,
        (!v::notEmpty()->alpha('-.')->length(2, 30)->validate($post['firstname'])) ? 'Le prénom est invalide' : null,
        (!v::notEmpty()->alpha('-.')->length(2, 30)->validate($post['username'])) ? 'Le prénom est invalide' : null,
        (!v::notEmpty()->alpha('-.')->length(2, 30)->validate($post['username'])) ? 'Le prénom est invalide' : null,
        (!v::notEmpty()->alpha('-.')->length(2, 30)->validate($post['username'])) ? 'Le prénom est invalide' : null,
        (!v::notEmpty()->alpha('-.')->length(2, 30)->validate($post['username'])) ? 'Le prénom est invalide' : null,
        (!v::notEmpty()->alpha('-.')->length(2, 30)->validate($post['username'])) ? 'Le prénom est invalide' : null,
        //-On verifie si l'email est valide
        (!v::notEmpty()->email()->validate($post['email'])) ? 'L\'adresse email est invalide' : null,
        (!v::notEmpty()->length(8, 30)->validate($post['password'])) ? 'Le mot de passe est invalide' : null,
      ];

      $errors = array_filter($err);

      //-On verifie si la super Global $_FILES est definie et qu'elle ne comporte pas d'erreurs.
      if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        if (!is_dir($upload_dir)) { //-Si le fichier n'existe pas
          mkdir($upload_dir, 0755); // on le cree
        }
        if ($img->filesize() > $maxSize) {
          //-Si la taille de l'image est superieure à la dimension donnée
          $errors[] = 'Image trop lourde, 2 Mo maximum';
        }
        if (!v::image()->validate($_FILES['avatar']['tmp_name'])) {
          //-On verifie si l'image est valide en verifiant son mimetype
          $errors[] = 'L\'avatar est une image invalide';
        } else {
          $img = Image::make($_FILES['avatar']['tmp_name']); //- créer une nouvelle ressource d'image à partir du fichier
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
          $save_name = Transliterator::transliterate(time() . '-' . preg_replace('/\\.[^.\\s]{3,4}$/', '', $_FILES['avatar']['name']));
          $img->save($upload_dir . $save_name . $ext);
        }
      }
      if (count($errors) === 0) {
        $success = true;
        $datas   = [
          // colonne sql => valeur à insérer
          'username' => ucfirst($post['username']),
          'lastname' => ucfirst($post['lastname']),
          'lastname' => ucfirst($post['lastname']),
          'email'    => $post['email'],
          'password' => $passwordHash,
        ];
        $User = new UsersModel();
        $User->insert($datas);
        $this->flash('Bonjour vous etes bien inscrit', 'info');
      }
    }
    $this->show('default/subscribe');
  }

}
