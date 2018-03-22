<?php
	require_once file::build_path(array("model","ModelLien.php"));

	class ControllerLien{

		protected static $object = 'lien';

		public static function readAll(){
			$tab_v = ModelLien::selectAll();
			$view = 'list';
			$controller = 'lien';
			$pagetitle = 'Liste des Liens';
			require file::build_path(array("view", "view.php"));
		}

		public static function read(){
			$v = ModelLien::select($_GET['IdL']);
			if ($v){
				$controller = 'lien';
				$view = 'detail';
				$pagetitle = 'Votre lien';
				require file::build_path(array("view","view.php"));
			}
			else {
				$controller = 'lien';
				$view = 'pasLien';
				$pagetitle = 'erreur';
				require file::build_path(array("view","view.php"));
			}
		}

		public static function create(){
			if (isset($_SESSION['email'])){
				$lien = new ModelLien("", "", "", "");
				$todo = 'Ajouter un lien';
				$controller = 'lien';
				$view = 'update';
				$action = 'created';
				$pagetitle = 'Ajoutez un lien';
				require file::build_path(array("view","view.php"));
			}
			else {
				$view = 'pasConnect';
				$pagetitle = 'Veuillez-vous connecter !';
				require file::build_path(array("view","view.php"));
			}
		}

		public static function created(){
			if (isset($_SESSION['email'])){
				try{
					$lien = new ModelLien	(NULL,
											$_SESSION["IdU"],
											$_GET["url"],
											$_GET["description"]);
				}
				catch(Exception $e){
					echo "Erreur de création un object";
				}
				ModelLien::save($lien);
				$view = 'created';
				$controller = 'lien';
				$pagetitle = 'Votre lien';
				require file::build_path(array("view","view.php"));
			}
		}

		public static function mes_liens(){
			if (!isset($_SESSION['email'])){
				$view = 'pasConnect';
				$pagetitle = 'Veuillez-vous connecter';
				require file::build_path(array("view","view.php"));
			}

			if (isset($_SESSION['email'])){
				$tab_v = ModelLien::my_link($_SESSION['IdU']); //lien de ce utilisateur
				$tab_lien = ModelLien::selectAll(); //tous les liens dans BDD
				$view = 'myLink';
				$pagetitle = 'Liens partagés';
				require file::build_path(array("view","view.php"));
			}
		}

		public static function supprimerLien(){
			if (!isset($_SESSION['email'])){
				$view = 'pasConnect';
				$pagetitle = 'Veuillez-vous connecter';
				require file::build_path(array("view","view.php"));
			}

			if (isset($_SESSION['email']) && (isset($_GET['IdL']))){
				$res = ModelLien::deleteLien($_GET['IdL']);
				$view = 'deleteLien';
				$controller = 'lien';
				$pagetitle = 'Supprimer votre partage';
				require file::build_path(array("view","view.php"));
			} 
			/*else {
				$view = 'myLink';
				$controller = 'lien';
				$pagetitle = 'Vos partagés';
				require file::build_path(array("view","view.php"));
			}*/
		}

		public static function update(){
			if (isset($_SESSION['email'])){
				$lien = ModelLien::select($_GET['IdL']);
				$view = 'update';
				$todo = 'Modifier';
				$action = 'modifier';
				$controller = 'lien';
				$pagetitle = 'Modifier votre partage';
				require file::build_path(array("view","view.php"));
			}
			else {
				$view = 'pasConnect';
				$controller = 'lien';
				$pagetitle = 'Veuillez-vous connecter';
				require file::build_path(array("view","view.php"));
			}
		}

		public static function modifier(){
			if (!isset($_SESSION['email'])){
				$view = 'pasConnect';
				$controller = 'lien';
				$pagetitle = 'Veuillez-vous connecter';
				require file::build_path(array("view", "view.php"));
			}

			if (isset($_SESSION['email'])){
				$lien = new ModelLien (	NULL,
										$_SESSION["IdU"],
										$_GET["url"],
										$_GET["description"]);
				ModelLien::update($lien);
				$view = 'created';
				$controller = 'lien';
				$pagetitle = 'Mise à jour';
				require file::build_path(array("view","view.php"));
			}
		}


	}

?>