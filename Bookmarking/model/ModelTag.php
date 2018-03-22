<?php
	require_once file::build_path(array("model.php","model.php"));

	class ModelTag extends model {
		private $genre;
		protected static $object = 'tag';
		protected static $primary = 'genre';

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


	public function __constructeur($genre = NULL){
		if (!is_null($genre)){
			$this->genre = $genre;
		}
	}

	



	}


?>