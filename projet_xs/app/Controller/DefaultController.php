<?php

namespace Controller;



use \Model\ProductsCustomModel;


use Behat\Transliterator\Transliterator;
use Intervention\Image\ImageManagerStatic as Image;
use Model\ContactFormModel;
use Respect\Validation\Validator as v;
use \W\Controller\Controller;
use Model\UsersModel;
use \W\Security\AuthentificationModel;
use \W\Security\StringUtils;

class DefaultController extends Controller
{
	private $mail;

	private function mailer($fromAddress, $fromName, $toAddress, $toName, $subject, $msgHTML)
	{
		$app = getApp();

		//Create a new PHPMailer instance
		$this->mail = new \PHPMailer;
		//Tell PHPMailer to use SMTP
		$this->mail->isSMTP();
		$this->mail->CharSet = 'utf-8';
		//Set the hostname of the mail server
		$this->mail->Host = $app->getConfig('phpmailer_host');
		// if your network does not support SMTP over IPv6
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$this->mail->Port = $app->getConfig('phpmailer_port');
		//Set the encryption system to use - ssl (deprecated) or tls
		$this->mail->SMTPSecure = $app->getConfig('phpmailer_SMTPSecure');
		//Whether to use SMTP authentication
		$this->mail->SMTPAuth = $app->getConfig('phpmailer_SMTPAuth');
		//Username to use for SMTP authentication - use full email address for gmail
		$this->mail->Username = $app->getConfig('phpmailer_username');
		//Password to use for SMTP authentication
		$this->mail->Password = $app->getConfig('phpmailer_password');

		//Set who the message is to be sent from
		$this->mail->setFrom($fromAddress, $fromName);
		//Set who the message is to be sent to
		$this->mail->addAddress($toAddress, $toName);
		//Set the subject line
		$this->mail->Subject = $subject;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$this->mail->msgHTML($msgHTML);
		//send the message, check for errors
		if (!$this->mail->send()) {
			echo "Mailer Error: " . $this->mail->ErrorInfo;
		}
	}

    /**
     * Page d'accueil par défaut
     */
    public function home()
    {
        $this->show('default/home');
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function showcart()
    {
        $this->show('default/cart');
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Page de connection/identification
     */
    public function connect()
    {
        $errorsText = '';
        $logUser = $this->getUser();

        if(!empty($logUser)){
            $this->redirectToRoute('default_home');
        }
        // si le post n'est pas vide, on récupère les données "nettoyées"
        if (!empty($_POST)) {

            $post = array_map('trim', array_map('strip_tags', $_POST));

            $err = [
                //-On verifie si l'email est valide
                (!v::notEmpty()->validate($post['email'])) ? 'L\'identifiant est incorrect' : null,
                (!v::notEmpty()->validate($post['password'])) ? 'Le mot de passe est invalide' : null,
            ];

            $errors = array_filter($err);
            if (count($errors) === 0) {
                $authentificationModel = new AuthentificationModel();
                if(empty($authentificationModel->isValidLoginInfo($post['email'], $post['password']))){
                    $errorsText = 'Identifiants invalides';

                }else{

                    $usersModel  = new UsersModel();
                    $authentificationModel->logUserIn($usersModel->getUserByUsernameOrEmail($post['email']));
                    $this->redirectToRoute('default_home');

                }
            }
            else{
                $errorsText = implode('<br>', $errors);
            }
        } 
        $this->show('User/connect',['errorsText' => $errorsText]);
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Page de changement de mot de passe
     */
    public function password()
    {
        $authentificationModel = new AuthentificationModel();
        $logUser = $this->getUser();

        if(empty($logUser)){
            $this->redirectToRoute('default_home');
        }

        $errorsText = '';
        $successText = '';
        if(!empty($_POST)){
            // nettoyage des données
            $post = array_map('trim', array_map('strip_tags', $_POST));

            // gestion des erreurs
            $err = [
                (!v::notEmpty()->validate($post['old'])) ? 'Le champ Ancien Mot de passe est vide.' : null,
                (!v::notEmpty()->validate($post['new'])) ? 'Le champ Nouveau Mot de passe est vide.' : null,
                (!v::notEmpty()->validate($post['confirm'])) ? 'Le champ Confirmation du mot de passe est vide.' : null,
            ];
            $errors = array_filter($err);

            
            if(count($errors) !== 0){
                $errorsText = implode('<br>', $errors);
            }
            elseif($post['confirm'] !== $post['new']) {
                $errorsText = 'Les Mots de passe ne correspondent pas.';
            }
            elseif(empty($authentificationModel->isValidLoginInfo($logUser['email'], $post['old']))){
                $errorsText = 'L\'Ancien mot de passe est incorrect.';
            }
            // données valides
            else {
                $usersModel = new UsersModel();
                $data = [
                    'password'  => $authentificationModel->hashPassword($post['new']),
                ];

                if($usersModel->update($data, $logUser['id'])) {
                    $successText = 'Le mot de passe a bien été changé !';
                }
            }
        }
        $this->show('user/password', ['errorsText' => $errorsText, 'successText' => $successText]);
    }
    
    /**
     * Page d'oubli de mot de passe
     */
    public function forgot_password()
    {
        $errorsText = '';
        $successText = '';

        if(!empty($_POST)){
            // nettoyage des données
            $post = array_map('trim', array_map('strip_tags', $_POST));

            // gestion des erreurs
            $err = [
                (!v::notEmpty()->validate($post['email'])) ? 'L\'identifiant est incorrect' : null,
            ];
            $errors = array_filter($err);

            if(count($errors) !== 0){
                $errorsText = implode('<br>', $errors);
            }

            // données valides
            else {
                $usersModel = new UsersModel();

                $user = $usersModel->getUserByUsernameOrEmail($post['email']);

                if(empty($user)) {
                    $errorsText = 'Utilisateur inexistant';
                }
                else {

                    $fromAddress = 'noreply@factory-xs.com';
                    $fromName = 'Tshirt Factory XS';
                    $toAddress = $user['email'];
                    $toName = $user['firstname'].' '.$user['lastname'];
                    $subject = 'Nouveau mot de passe';
                    $msgHTML = '<html><head><title>Nouveau mot de passe</title></head>';
                    $msgHTML .= '<body><p>Veuillez cliquer sur le lien ci-dessous pour générer un nouveau mot de passe</p>';
                    $msgHTML .= '<a href="/'.$_SERVER['HTTP_HOST'].$this->generateUrl('new_password').'?email='.$user['email'].'&token='.$user['token'].'">Nouveau mot de passe</a>';
                    $msgHTML .= '</body></html>';

                    $this->mailer($fromAddress, $fromName, $toAddress, $toName, $subject, $msgHTML);
                    
                    $successText = "La procédure vous a été envoyé par mail";
                    header('refresh:3;url='.$this->generateUrl('login'));
                }
            }
        }
        $this->show('user/forgotPassword', ['errorsText' => $errorsText, 'successText' => $successText]);
    }

    /**
     * Page de modification du mot de passe
     */
    public function new_password() 
    {
        $logUser = $this->getUser();
        $user;

        if(isset($_GET['email']) && isset($_GET['token']) && empty($logUser)) {

            $usersModel = new UsersModel();
            $user = $usersModel->getUserByEmailAndToken($_GET['email'], $_GET['token']);

            if(empty($user)){
                $this->redirectToRoute('default_home');
            }
        }
        else {
            $this->redirectToRoute('default_home');
        }

        $errorsText = '';
        $successText = '';
        if(!empty($_POST)){
            // nettoyage des données
            $post = array_map('trim', array_map('strip_tags', $_POST));

            // gestion des erreurs
            $err = [
                (!v::notEmpty()->validate($post['new'])) ? 'Le champ Nouveau Mot de passe est vide.' : null,
                (!v::notEmpty()->validate($post['confirm'])) ? 'Le champ Confirmation du mot de passe est vide.' : null,
            ];
            $errors = array_filter($err);

            
            if(count($errors) !== 0){
                $errorsText = implode('<br>', $errors);
            }
            elseif($post['confirm'] !== $post['new']) {
                $errorsText = 'Les mots de passe ne correspondent pas.';
            }
            // données valides
            else {
                $authentificationModel = new AuthentificationModel();
                $usersModel = new UsersModel();
                $data = [
                    'password'  => $authentificationModel->hashPassword($post['new']),
                    'token'     => StringUtils::randomString(),
                ];

                if($usersModel->update($data, $user['id'])) {
                    $successText = 'Le mot de passe a bien été changé !';
                    header('refresh:3;url='.$this->generateUrl('login'));
                }
            }
        }
        $this->show('user/newPassword', ['errorsText' => $errorsText, 'successText' => $successText]);
    }


    public function Logout()
    {
        $user = new AuthentificationModel();
        $user->logUserOut();
        $this->redirectToRoute('default_home');
    }
 
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
        $this->show('default/contact');

    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function subscribe()
    {
        //-Declaration des diff variables
        $post       = [];
        $upload_dir = 'assets/upload/';
        $maxSize    = (1024 * 1000) * 2;
        $extAllowed = ['jpg','jpeg','png','gif'];

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
                
                $x = explode('.',$_FILES['avatar']['name']);
                if(in_array($x[1],$extAllowed)){
                    
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
                else{
                    $errors[] = 'L\'avatar est une image invalide';
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
                    'token'    => StringUtils::randomString(),
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

    public function modifInfos()
    {

        $loggedUser = $this->getUser();

        $UserRecup = new UsersModel();
        $newUser   = $UserRecup->find($loggedUser['id']);

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
                
                $x = explode('.',$_FILES['avatar']['name']);
                if(in_array($x[1],$extAllowed)){
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
                }else{
                    
                    $errors[] = 'L\'avatar est une image invalide';
                    
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
                if ($User->update($datas, $loggedUser['id'])) {
                    $success = true;

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
        $this->show('User/modifInfos', $param);
    }

    
///////////////////////////////////////////////////////////////////////////////////////////  
    
    //Page de personnalisation de tShirt
    public function custom(){
        
        $params=[];
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////        
        //-Declaration des diff variables 
    $upload_dir = 'assets/upload/';
    $maxSize    = (1024 * 1000) * 2;
        
        if(!empty($_POST)){
            if(isset($_POST['img'])){
                
                $img = $_POST['img'];
                $img = str_replace('data:image/png;base64,', '', $img);
                
                $img = str_replace(' ', '+', $img);
               
                $fileData = base64_decode($img);
                //saving
                $name = time().'-model.png';
                $fileName = $upload_dir.$name;
                file_put_contents($fileName, $fileData);
                
                $reference = $_POST['ref1'].$_POST['ref2'].$_POST['ref3'];
                
                $infos = [
                    'user_id'=> '2',//Récupérer dans $_SESSION
                    'product_reference'=>$reference,
                    'picture_source'=> $_SESSION['picture_source'],
                    'model'=>$name,
                         ];
                
                $product = new ProductsCustomModel();
                
                if($product->insert($infos)){
                    
                    $success= true;
                }
                
            }
            
            //getLoggedUser()
            
        }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //-On verifie si la super Global $_FILES est definie et qu'elle ne comporte pas d'erreurs.
        if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
            if (!is_dir($upload_dir)) { //-Si le fichier n'existe pas
              mkdir($upload_dir, 0755); // on le cree
            }
            
            $img = Image::make($_FILES['picture']['tmp_name']); //- créer une nouvelle ressource d'image à partir du fichier
            if ($img->filesize() > $maxSize) {
              //-Si la taille de l'image est superieure à la dimension donnée
              $errors[] = 'Image trop lourde, 2 Mo maximum';
            }
            if (!v::image()->validate($_FILES['picture']['tmp_name'])) {
              //-On verifie si l'image est valide en verifiant son mimetype
              $errors[] = 'L\'avatar est une image invalide';
            }
            else {
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
                
                $save_name = Transliterator::transliterate(time() . '-' . preg_replace('/\\.[^.\\s]{3,4}$/', '', $_FILES['picture']['name']));
                $img->save($upload_dir . $save_name . $ext);
                $custom = $upload_dir . $save_name . $ext;
                $_SESSION['picture_source'] = $save_name.$ext;
                
                echo '<script>
                fabric.Image.fromURL(\''.$custom.'\',function(img){
                img.scaleToWidth(200);
                canvas.add(img);
                });
                </script>';
                
            }
          
        }

// 
//        if(!empty($_SESSION['user'])){//Si il y a un utilsateur connecté
//            $params[] =[
//                'log' => true, 
//            ];
//        }
//        else{//Pas d'utilisateur connecté
//            $params[] =[
//                'log' => false,  
//            ];
//        }
        
        
        if(empty($_POST)){//la super Global $_FILES n'est pas definie
            
        $this->show('default/custom');
            
        }
        
    }//Fin de custom

//******************************** Methode pour afficher les design creer par les membres ***********************
    public function showAlldesignMembres(){

        $order = '';
        $listdesigns = new ProductsCustomModel();
        $design      = $listdesigns->findDesign($order);
        $params      = [
            'design' => $design,
        ];
        $this->show('default/designMembre', $params);
    }


    public function designMembres($column, $ord){

        // $this->allowTo('admin');
        $loggedUser = $this->getUser();

        // On instancie nos variables pour éviter les erreurs de type notices

        $order = '';

            if($column == 'username'){
                $order = ' ORDER BY U.username';
            }

            elseif($column == 'like'){
                $order = ' ORDER BY P.like';
            }
            elseif($column == 'date'){
                $order = ' ORDER BY P.date_create';
            }

            if($ord == 'asc'){
                $order.= ' ASC';
            }
            elseif($ord == 'desc'){
                $order.= ' DESC';
            }



        $listdesigns = new ProductsCustomModel();
        $design      = $listdesigns->findDesign($order);
        $params      = [
            'design' => $design,
        ];
        $this->show('default/designMembre', $params);
     
    }//****************** Fin methode designMembres **********************

      public function membreDesignMembres($id)
    {

        $listdesigns = new ProductsCustomModel();
        $design      = $listdesigns->findUserDesign($id);
        $params      = [
            'design' => $design,
        ];
        $this->show('default/designMembre', $params);
    }



}//******************** fin du controller ****************************
