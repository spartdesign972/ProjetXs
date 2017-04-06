<?php

namespace Controller;

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
	public function connect(){
		$this->show('default/connect');
	}

	public function subscribe(){
		$this->show('default/subscribe');
	}

}