<?php
	require_once file::build_path(array("model", "model.php"));

	class ModelUtilisateur extends model {
		private $IdU;
		private $email;
		private $mdp;
		private $pseudo;
    private $bio;
		protected static $object = 'utilisateur';
		protected static $primary = 'IdU';

		//méthode générique pour getter
    public function get($nom_attribut){
    	if (property_exists($this, $nom_attribut))
     		return $this->$nom_attribut;
    	return false;
   	}

    //setter
	  public function set($nom_attribut, $valeur) {
	    if (property_exists($this, $nom_attribut))
	      $this->$nom_attribut = $valeur;
	   	return false;
	  }

	//constructeur
	public function __construct($IdU = NULL, $email = NULL, $mdp = NULL, $pseudo = NULL){
		if (!is_null($email) && !is_null($mdp) && !is_null($pseudo)){
			$this->IdU = $IdU;
			$this->email = $email;
			$this->mdp = $mdp;
			$this->pseudo = $pseudo;
		}
	}

	public function tabKey(){
		$tab = array();
		foreach ($this as $key => $value) {
			$tab[] = $key;
		}
		return $tab;
	}

	public function tabVal(){
		$tab = array();
		foreach ($this as $key => $value){
			$tab[$key] = $value;
		}
		return $tab;
	}

	public static function getIdByMail($email){
      try {
        $sql = "SELECT IdU from utilisateur WHERE email=:email_tag";
        $req_prep = model::$pdo->prepare($sql);
        $value = array("email_tag" => $email);
        $req_prep->execute($value);
        $res = $req_prep->fetch();
        return $res['IdU'];
      }
      catch (Exception $e){
        echo 'Exception reçue : ', $e->getMessage(), "\n";
      }
    }

//vérif mail existe
    public static function verif_mail_exist($_email){
        $sql = "SELECT email FROM utilisateur WHERE email =:email_tag";
        $value = array("email_tag" => $_email);
        $req_prep = model::$pdo->prepare($sql);
        $req_prep->execute($value);
        $res = $req_prep->fetch();
        if($res['email'] == $_email) 
          return 1; // mail utilisé
        else 
          return 0; // mail valide
    }

    //verifier si mail et mdp (connexion) est bon
    public static function isUser($email, $mdp){
      try{
        $sql = "SELECT IdU, email, mdp FROM utilisateur WHERE email=:email_tag AND mdp=:mdp_tag";
        $value = array( "email_tag" => $email,
                        "mdp_tag" => $mdp);
        $req_prep = model::$pdo->prepare($sql);
        $req_prep->execute($value);
        $res = $req_prep->rowCount();// $res = 1 => utilisateur exist
        return $res;
        
      }
      catch(Exception $e){
        echo 'Exception reçue : ', $e->getMessage(), "\n";
      }
    }
}
?>
