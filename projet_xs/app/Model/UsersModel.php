<?php
namespace Model;

use \W\Model\ConnectionModel;

class UsersModel extends MasterModel
{
	/**
	 * Constructeur
	 */
	public function __construct(){
		$app = getApp();
		// Définit la table en fonction de la config
		$this->setTable($app->getConfig('security_user_table'));

		$this->dbh = ConnectionModel::getDbh();
	}

	/**
	 * Récupère un utilisateur en fonction de son email ou de son pseudo
	 * @param string $usernameOrEmail Le pseudo ou l'email d'un utilisateur
	 * @return mixed L'utilisateur, ou false si non trouvé
	 */
	public function getUserByUsernameOrEmail($usernameOrEmail)
	{

		$app = getApp();

		$sql = 'SELECT * FROM ' . $this->table . 
			   ' WHERE ' . $app->getConfig('security_username_property') . ' = :username' . 
			   ' OR ' . $app->getConfig('security_email_property') . ' = :email LIMIT 1';

		$dbh = ConnectionModel::getDbh();
		$sth = $dbh->prepare($sql);
		$sth->bindValue(':username', $usernameOrEmail);
		$sth->bindValue(':email', $usernameOrEmail);
		
		if($sth->execute()){
			$foundUser = $sth->fetch();
			if($foundUser){
				return $foundUser;
			}
		}

		return false;
	}

	/**
	* Teste si un email est présent en base de données
	* @param string $email L'email à tester
	* @return boolean true si présent en base de données, false sinon
	*/
	public function emailExists($email)
	{

	   $app = getApp();

	   $sql = 'SELECT ' . $app->getConfig('security_email_property') . ' FROM ' . $this->table .
	          ' WHERE ' . $app->getConfig('security_email_property') . ' = :email LIMIT 1';

	   $dbh = ConnectionModel::getDbh();
	   $sth = $dbh->prepare($sql);
	   $sth->bindValue(':email', $email);
	   if($sth->execute()){
	       $foundUser = $sth->fetch();
	       if($foundUser){
	           return true;
	       }
	   }

	   return false;
	}

	/**
	 * Teste si un pseudo est présent en base de données
	 * @param string $username Le pseudo à tester
	 * @return boolean true si présent en base de données, false sinon
	 */
	public function usernameExists($username)
	{

	    $app = getApp();

	    $sql = 'SELECT ' . $app->getConfig('security_username_property') . ' FROM ' . $this->table .
	           ' WHERE ' . $app->getConfig('security_username_property') . ' = :username LIMIT 1';

	    $dbh = ConnectionModel::getDbh();
	    $sth = $dbh->prepare($sql);
	    $sth->bindValue(':username', $username);
	    if($sth->execute()){
	        $foundUser = $sth->fetch();
	        if($foundUser){
	            return true;
	        }
	    }

	    return false;
	}

////////////////////////////////////////////////////////////////////////////////////////////////

	/**
	 * Récupère un utilisateur en fonction de son email et de son token
	 * @param string $userEmail L'email d'un utilisateur
	 * @param string $token Le token d'un utilisateur
	 * @return mixed L'utilisateur, ou false si non trouvé
	 */
	public function getUserByEmailAndToken($userEmail, $userToken)
	{
		$app = getApp();

		$sql = 'SELECT id, email, token FROM ' . $this->table . 
			   ' WHERE ' . $app->getConfig('security_email_property') . ' = :email' .
               ' AND token = :token LIMIT 1';

		$dbh = ConnectionModel::getDbh();
		$sth = $dbh->prepare($sql);
		$sth->bindValue(':email', $userEmail);
		$sth->bindValue(':token', $userToken);
		
		if($sth->execute()){
			$foundUser = $sth->fetch();
			if($foundUser){
				return $foundUser;
			}
		}

		return false;
	}

	/**
	 * Récupère tous les rôles définis
	 * @return mixed Les rôles, ou false si non trouvé
	 */
	public function findAllRoles()
	{
		$sql = 'desc ' . $this->table . ' role';

		$sth = $this->dbh->prepare($sql);
		if($sth->execute()){

			$row = $sth->fetch();

			preg_match('/enum\((.*)\)$/', $row['Type'], $matches);
			$vals = explode(',', $matches[1]);

			$trimmedvals = [];			
			foreach($vals as $key => $value) {
				$value = trim($value, "'");
				$trimmedvals[] = $value;
			}
			return $trimmedvals;
		}

		return false;
	}

}