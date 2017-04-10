<?php

namespace Controller;

use Behat\Transliterator\Transliterator;
use Intervention\Image\ImageManagerStatic as Image;
use Model\ContactFormModel;
use Respect\Validation\Validator as v;
use \W\Controller\Controller;
use \W\Model\UsersModel;
use \W\Security\AuthentificationModel;

class DefaultController extends Controller
{

    /**
     * Page d'accueil par défaut
     */
    public function home()
    {
        $this->show('default/home');
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
                $User = new AuthentificationModel();
                $id   = $User->isValidLoginInfo($post['email'], $post['password']);
                if (isset($id)) {
                    $ident   = new UsersModel();
                    $tmpUser = $ident->find($id);
                    $User->logUserIn($tmpUser);
                    $success = true;
                    $this->flash('Vous etes bien connecté', 'info');
                    $this->redirectToRoute('admin_showadmin');
                }
            }
        } else {
            $this->show('User/connect');
        }
    }

    public function Logout()
    {
        $user = new AuthentificationModel();
        $user->logUserOut();
        $this->redirectToRoute('article_listearticle');
    }

///////////////////////////////////////////////////////////////////////////
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function contact()
    {
        if (!empty($_POST)) {
            $post = array_map('trim', array_map('strip_tags', $_POST));
            $err  = [
                //-On verifie si l'input n'est pas vide, si il ne comporte pas de caracteres qu'on ne veut pas, et si la taille de la chaine est comprise entre 2 et 30 caracteres.
                (!v::notEmpty()->alpha('-.')->length(2, 30)->validate($post['lastname'])) ? 'Le nom de famille est invalide' : null,
                (!v::notEmpty()->alpha('-.')->length(2, 30)->validate($post['subject'])) ? 'L\'objet du message est invalide' : null,
                (!v::notEmpty()->email()->validate($post['email'])) ? 'L\'adresse email est invalide' : null,
                (!v::notEmpty()->length(2)->validate($post['comment'])) ? 'Le message est invalide' : null,
            ];

            $errors = array_filter($err);

            if (count($errors) === 0) {

                $datas = [
                    // colonne sql => valeur à insérer
                    'name'    => ucfirst($post['lastname']),
                    'subject' => ucfirst($post['subject']),
                    'email'   => $post['email'],
                    'message' => $post['comment'],
                ];

                $contact = new ContactFormModel();
                if ($contact->insert($datas)) {
                    $success = true;
                    $this->showJson(['status' => 'success', 'message' => 'Votre message est bien parti']);
                }
            } else {
                $this->showJson(['status' => 'error', 'message' => implode('<br>', $errors)]);
                // $result = '<div class="alert alert-danger">' .  . '</div>';
            }
        }
        $this->show('User/contact');

    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
                (!v::notEmpty()->alpha('-.')->length(2, 30)->validate($post['username'])) ? 'Le pseudo est invalide' : null,
                (!v::notEmpty()->email()->validate($post['email'])) ? 'L\'adresse email est invalide' : null,
                (!v::notEmpty()->length(8, 30)->validate($post['password'])) ? 'Le mot de passe est invalide' : null,
                (!v::notEmpty()->length(2, 30)->validate($post['street'])) ? 'La rue est invalide' : null,
                (!v::notEmpty()->alpha('-.')->length(2, 30)->validate($post['city'])) ? 'La ville est invalide' : null,
                (!v::notEmpty()->length(2, 10)->validate($post['zipcode'])) ? 'Le code postal est invalide' : null,
                (!v::notEmpty()->alpha('-.')->length(2, 30)->validate($post['country'])) ? 'Le pays est invalide' : null,
            ];

            $errors = array_filter($err);

//-On verifie si la super Global $_FILES est definie et qu'elle ne comporte pas d'erreurs.
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                if (!is_dir($upload_dir)) { //-Si le fichier n'existe pas
                    mkdir($upload_dir, 0755); // on le cree
                }
                $img = Image::make($_FILES['avatar']['tmp_name']); //- créer une nouvelle ressource d'image à partir du fichier
                if ($img->filesize() > $maxSize) {
                    //-Si la taille de l'image est superieure à la dimension donnée
                    $errors[] = 'Image trop lourde, 2 Mo maximum';
                }
                if (!v::image()->validate($_FILES['avatar']['tmp_name'])) {
                    //-On verifie si l'image est valide en verifiant son mimetype
                    $errors[] = 'L\'avatar est une image invalide';
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
                    $save_name = Transliterator::transliterate(time() . '-' . preg_replace('/\\.[^.\\s]{3,4}$/', '', $_FILES['avatar']['name']));
                    $img->save($upload_dir . $save_name . $ext);
                }
            }

            if (count($errors) === 0) {
                // var_dump($_POST);

                $passwordHash = new AuthentificationModel();

                $datas = [
                    // colonne sql => valeur à insérer
                    'firstname' => ucfirst($post['firstname']),
                    'lastname'  => ucfirst($post['lastname']),
                    'username'  => ucfirst($post['username']),
                    'email'     => $post['email'],
                    'password'  => $passwordHash->hashPassword($post["password"]),
                    'street'    => ucfirst($post['street']),
                    'city'      => ucfirst($post['city']),
                    'zipcode'   => $post['zipcode'],
                    'country'   => ucfirst($post['country']),
                    'avatar'    => $save_name,
                ];
                $User = new UsersModel();
                if ($User->insert($datas)) {
                    $success = true;
                    $this->showJson(['status' => 'success', 'message' => 'Vous avez été ajouté avec succès']);
                    // $result  = '<div class="alert alert-success"></div>';
                    // $this->flash('Bonjour vous etes bien inscrit', 'info');
                }
            } else {
                $this->showJson(['status' => 'error', 'message' => implode('<br>', $errors)]);
                // $result = '<div class="alert alert-danger">' .  . '</div>';
            }
            // echo $result;
        }
        $this->show('User/subscribe');

    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function modifInfos($id)
    {

        $UserRecup = new UsersModel();
        $newUser   = $UserRecup->find($id);

        //-Declaration des diff variables
        $post       = [];
        $upload_dir = 'upload/';
        $maxSize    = (1024 * 1000) * 2;
        $errors     = [];
        $result     = '';

        // si le post n'est pas vide, on récupère les données "nettoyées"
        if (!empty($_POST)) {
            $post = array_map('trim', array_map('strip_tags', $_POST));

            $err = [
                //-On verifie si l'input n'est pas vide, si il ne comporte pas de caracteres qu'on ne veut pas, et si la taille de la chaine est comprise entre 2 et 30 caracteres.
                (!v::notEmpty()->alpha('-.')->length(2, 30)->validate($post['lastname'])) ? 'Le nom de famille est invalide' : null,
                (!v::notEmpty()->alpha('-.')->length(2, 30)->validate($post['firstname'])) ? 'Le prénom est invalide' : null,
                (!v::notEmpty()->alpha('-.')->length(2, 30)->validate($post['username'])) ? 'Le pseudo est invalide' : null,
                (!v::notEmpty()->email()->validate($post['email'])) ? 'L\'adresse email est invalide' : null,
                (!v::notEmpty()->length(2, 30)->validate($post['street'])) ? 'La rue est invalide' : null,
                (!v::notEmpty()->alpha('-.')->length(2, 30)->validate($post['city'])) ? 'La ville est invalide' : null,
                (!v::notEmpty()->length(2, 10)->validate($post['zipcode'])) ? 'Le code postal est invalide' : null,
                (!v::notEmpty()->alpha('-.')->length(2, 30)->validate($post['country'])) ? 'Le pays est invalide' : null,
            ];

            $errors = array_filter($err);

//-On verifie si la super Global $_FILES est definie et qu'elle ne comporte pas d'erreurs.
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                if (!is_dir($upload_dir)) { //-Si le fichier n'existe pas
                    mkdir($upload_dir, 0755); // on le cree
                }
                $img = Image::make($_FILES['avatar']['tmp_name']); //- créer une nouvelle ressource d'image à partir du fichier
                if ($img->filesize() > $maxSize) {
                    //-Si la taille de l'image est superieure à la dimension donnée
                    $errors[] = 'Image trop lourde, 2 Mo maximum';
                }
                if (!v::image()->validate($_FILES['avatar']['tmp_name'])) {
                    //-On verifie si l'image est valide en verifiant son mimetype
                    $errors[] = 'L\'avatar est une image invalide';
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
                    $save_name = Transliterator::transliterate(time() . '-' . preg_replace('/\\.[^.\\s]{3,4}$/', '', $_FILES['avatar']['name']));
                    $img->save($upload_dir . $save_name . $ext);
                }
            }

            if (count($errors) === 0) {
                // var_dump($_POST);

                $datas = [
                    // colonne sql => valeur à insérer
                    'firstname' => ucfirst($post['firstname']),
                    'lastname'  => ucfirst($post['lastname']),
                    'username'  => ucfirst($post['username']),
                    'email'     => $post['email'],
                    'street'    => ucfirst($post['street']),
                    'city'      => ucfirst($post['city']),
                    'zipcode'   => $post['zipcode'],
                    'country'   => ucfirst($post['country']),
                    // 'avatar'    => $save_name,
                ];
                $User = new UsersModel();
                if ($User->update($datas, $id)) {
                    $success = true;
                    echo 'l update est passée';

                }

                // $this->showJson(['status' => 'success', 'message' => 'Vous avez été modifié avec succès']);
                // $result  = '<div class="alert alert-success">Vous avez été modifié avec succès</div>';
                // $this->flash('Bonjour vous etes bien inscrit', 'info');

            } else {
                // $this->showJson(['status' => 'error', 'message' => implode('<br>', $errors)]);
                // $result = '<div class="alert alert-danger">' . $errors  . '</div>';
            }
            echo $result;
        }
        $param = [
            'userModif' => $newUser,
            'result'    => $result,
        ];
        $this->show('User/modifInfos', $param, ["id" => $id]);
    }

}
