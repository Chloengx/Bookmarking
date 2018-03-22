<?php
	require_once file::build_path(array ("model","model.php"));

	class ModelLien extends model {
	    private $IdL;
	    private $url;
	    private $nbLike;
	    private $IdU;
	    private $description;

	    protected static $object = 'lien';
	    protected static $primary = 'IdL';

	    //méthode générique pour getter
	    public function get($nom_attribut){
	      	if (property_exists($this, $nom_attribut))
	        	return $this->$nom_attribut;
	      	return false;
	    }

	    //setter
	    public function set($nom_attribut, $valeur) {
	    	if (property_exists($this, $nom_attribut))
	    		$this->$nom_attribut = $valuer;
	      	return false;
	    }

	    public function __construct($IdL = NULL, $IdU = NULL, $url = NULL, $description = NULL){
		    if (!is_null($IdU) && !is_null($url) && !is_null($description)){
		        $this->IdU = $IdU;
		        $this->url = $url;
		        $this->description = $description;
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

		public static function my_link($IdU){
      		try{
		        $sql = "SELECT * FROM lien WHERE IdU=:IdU_tag";
		        $value = array("IdU_tag" => $IdU);
		        $req_prep = model::$pdo->prepare($sql);
		        $req_prep->execute($value);
		        $res = $req_prep->fetchAll();
		        return $res;
      		}
      		catch (Exception $e){
        		echo 'Exception recue : ',$e->getMessage(), "\n";
      		}
    	}

    	public static function deleteLien($IdL){
      		try {
		        $sql = "DELETE FROM lien WHERE IdL=:IdL_tag";
		        $value = array("IdL_tag"=> $IdL);
		        $req_prep = model::$pdo->prepare($sql);
		        $req_prep->execute($value);
		    }
      		catch (Exception $e){
        		echo 'Exception recue : ', $e->getMessage(), "\n";
      		}
    	}

	}
?>