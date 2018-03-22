<?php

	require_once file::build_path(array("model","ModelUtilisateur.php"));

	class ControllerUtilisateur {
		protected static $object = 'utilisateur';

		public static function read(){
			if (!isset($_SESSION['mail'])){
				$view = 'pasConnect';
				$controller = 'utilisateur';
				$pagetitle = 'pas Connect';
				require_once file::build_path(array("view","view.php"));
				return ;
			}

			//your profile or profile of anorther person
			$bool = (isset($_GET['mail']) || isset($_GET['IdU']));
			if ($bool){
				echo "OK";
			}
		}

		public static function create(){

			if (isset($_SESSION['email'])){
				$view = 'accueil';
				$controller = 'utilisateur';
				$pagetitle = 'Bienvenue';
				require file::build_path(array("view","view.php"));
			}

			if (!isset($_SESSION['email'])){
				$user = new ModelUtilisateur("","","","");
				$todo = 'Inscription';
				$controller = 'utilisateur';
				$view = 'update';
				$verif = 'true';
				$action = 'created';
				$pagetitle = 'Formule de création';
				require_once file::build_path(array("view","view.php"));
			}
		}

		public static function created(){
			if (!isset($_SESSION['email'])){
				//Filtre une variable avec un filtre spécifique
				if (filter_var($_GET["email"], FILTER_VALIDATE_EMAIL) && ModelUtilisateur::verif_mail_exist($_GET['email']) == 0){
					if ($_GET["verif_mdp"] == $_GET['mdp']){
						try{
							$user = new ModelUtilisateur(NULL,
														$_GET["email"],
														$_GET["mdp"],
														$_GET["pseudo"]);
						}
						catch(Exception $e){
							echo "erreur de création un objet";
						}
						ModelUtilisateur::save($user);
						$view = 'created';
						$controller = 'utilisateur';
						$pagetitle = 'Formule de création';
						require_once file::build_path(array("view","view.php"));
					}
					else{
			            $user = new ModelUtilisateur("", "", "", "");
			            $view = 'update';
			            $champ = 'required';
			            $action = 'created';
			            $verif = "mdp";
			            $controller = 'utilisateur';
			            $pagetitle = 'Formulaire de creation';
			            $message = 'Les deux mots de passes ne correspondent pas!';
			            require file::build_path(array("view", "view.php"));
			        }
        		}
	        	else {
				    $user = new ModelUtilisateur("", "", "", "");
				    $view = 'update';
				    $champ = 'required';
				    $action = 'created';
				    $verif = "email";
				    $controller = 'utilisateur';
				    $pagetitle = 'Formulaire de création';
				    $message = 'Mail invalide òu il a été déjà utilisé';
				    require file::build_path(array("view", "view.php"));
				}
			}
		}

		public static function connect(){
			if (isset($_SESSION['email'])){
				$view = 'connected';
				$controller = 'utilisateur';
				$pagetitle = 'Déjà connecté';
				require file::build_path(array("view","view.php"));
			}

			if (!isset($_SESSION['email'])){
				$controller = 'utilisateur';
				$view = 'connect';
				$action = 'connected';
				$pagetitle = 'Formulaire de connexion';
				require file::build_path(array("view", "view.php")); 
			}
		}

		public static function connected(){
			if (isset($_SESSION['email'])){
				$view = 'dejaConnected';
				$controller ='utilisateur';
				$pagetitle = 'Déjà connecté';
				require file::build_path(array("view","view.php"));
			}
			else {
				if (!empty($_GET['email'] && !empty($_GET['mdp']))){
					$isConnect = ModelUtilisateur::isUser($_GET['email'], $_GET['mdp']);
					if ($isConnect == 1){
						$idUtilisateur = ModelUtilisateur::getIdByMail($_GET['email']);
						$res = ModelUtilisateur::select($idUtilisateur);
						$_SESSION['email'] = $_GET['email'];
			            $_SESSION['IdU'] = $idUtilisateur;
			            $pseudo = $res->get('pseudo');
			            $_SESSION['pseudo'] = $pseudo;
			            $view = 'connected';
			            $controller = 'utilisateur';
			            $pagetitle = 'Bienvenue';
			            require file::build_path(array("view", "view.php"));
					}
					else {
						$view = 'erreurConnect';
						$controller = 'utilisateur';
						$pagetitle = 'Erreur de connexion';
						require file::build_path(array("view", "view.php"));
					}
				}
				else {
					$view = 'connect';
					$controller = 'utilisateur';
					$action = 'connected';
					$pagetitle = 'Formulaire de Connexion';
					require file::build_path(array("view","view.php"));
				}
			}
		}

		public static function deconnect(){
			if (isset($_SESSION['email'])){
				unset($_SESSION['email']);
				unset($_SESSION['pseudo']);
				$view = 'deconnexion';
				$controller = 'utilisateur';
				$pagetitle = 'Au revoir';
				require file::build_path(array("view","view.php"));
			}
			else {
				$view = 'pasConnect';
				$controller = 'utilisateur';
				$pagetitle = 'Echec de déconnexion';
				require file::build_path(array("view","view.php"));
			}
		}

		public static function update(){
			if (isset($_SESSION['email'])){
				$idUtilisateur = ModelUtilisateur::getIdByMail($_SESSION['email']);
				$user = ModelUtilisateur::select($idUtilisateur);
				$view = 'update';
				$verif = 'empty';
				$todo = 'Modifier';
				$action = 'updated'; 
				$controller = 'utilisateur';
				$pagetitle = 'Modifier votre profil';
				require file::build_path(array("view","view.php"));
			}

			if (!isset($_SESSION['email'])){
				$view = 'erreur';
				$controller = 'utilisateur';
				$pagetitle = 'Erreur';
				require file::build_path(array("view","view.php"));
			}
		}

		public static function updated(){
			if (isset($_SESSION['email'])){
				if($_SESSION['email'] == $_GET['email']){
					if ($_GET['mdp'] == $_GET['verif_mdp']){
						$idUtilisateur = ModelUtilisateur::getIdByMail($_GET['email']);
						$user = new ModelUtilisateur($idUtilisateur,
													$_GET['email'],
													$_GET['mdp'],
													$_GET['pseudo']);
						ModelUtilisateur::update($user);
						$view ='updated';
						$controller = 'utilisteur';
						$pagetitle = 'Mise à jour';
						require file::build_path(array("view","view.php"));
					}
					else {
						$view = 'update';
						$action = 'update';
						$verif = 'mdp';
						$controller = 'utilisateur';
						$pagetitle = 'erreur';
						$message = 'Les mots de passes ne correspondent pas';
						require file::build_path(array("view","view.php"));
					}
				}
				else {
					$view = 'pasConnect';
					$controller = 'utilisateur';
					$pagetitle = 'Erreur';
					require file::build_path(array("view","view.php"));
				}
			}
		}



	}
?>