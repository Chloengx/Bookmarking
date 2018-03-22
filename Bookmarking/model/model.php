<?php
  require_once file::build_path(array("config","conf.php"));

   class model {

    public static $pdo; //PHP data Object

    public static function Init() {
      $hostname = conf::getHostname();
      $database_name = conf::getDatabase();
      $login = conf::getLogin();
      $password = conf::getPassword();

      try {
        self::$pdo = new PDO("mysql:host=$hostname; dbname=$database_name", $login, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch (PDOException $e) {
        if (conf::getDebug()){
          echo $e->getMessage(); //afficher un message d'erreur
        }
        else {
          echo 'Une erreur est survenue <a href=""> retour à la page d\' accueil </a>';
        }
        die();
      }
    }

//fonction générique
  public static function selectAll(){
    $table_name = static::$object; //object = nom de table BDD
    $class_name = 'Model'.ucfirst($table_name);

    try{
      $rep = model::$pdo->query("SELECT * FROM $table_name"); //pdo->query = execute an sql, return a pdo object
      $rep->setFetchMode(PDO::FETCH_CLASS, $class_name); //return TRUE or FALSE
      $tab_all = $rep->fetchAll(); // return tous les lignes dans tab_all
      return $tab_all;
    }
    catch (Exception $e) {
      echo 'Exception reçue : ', $e->getMessage(), "\n";
    }
  }

  public static function select($primary_value){

      $table_name = static::$object;
      $class_name = 'Model'.ucfirst($table_name);
      $primary_key = static::$primary;

      try {
        $sql= "SELECT * from $table_name WHERE $primary_key=:primary_val";
        $req_prep = model::$pdo->prepare($sql);
        $value = array("primary_val" => $primary_value);
        $req_prep->execute($value);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab_select = $req_prep->fetchAll();

        if (empty($tab_select))
          return false;
        return $tab_select[0];
      }
      catch (Exception $e){
        echo 'Exception reçue : ', $e->getMessage(), "\n";
      }
    }

  public static function update($data){
    $tabK = $data->tabKey();
    $tabV = $data->tabVal();
    $table_name = static::$object;
    $primary_key = static::$primary;
     foreach ($tabK as $v) {
       try {
        $sql = "UPDATE $table_name
                SET $v=:value
                WHERE $primary_key=:primary_val";
        $values = array("primary_val" => $tabV[$primary_key],
                        "value"=> $tabV[$v]);
        $req_prep = model::$pdo->prepare($sql);
        $req_prep->execute($values);
       }
       catch(Exception $e){
        echo 'Exception recue : ', $e->getMessage(), "\n";
       }
     }
  }

 public static function save($data){
    //var_dump($data);
    $tabK = $data->tabKey();   //lấy giá trị bên trái của  constructeur (vd: this->login, this->nom...)
    $tabV = $data->tabVal();   // lấy các valeur bên phải của constructeur (vd : $login, $nom...)
    $table_name = static::$object;
    $primary_key = static::$primary;

    $strVal = ':'.$primary_key; //faire un tag comme ":idU"
    for ($i = 1; $i < count($tabK); $i++){
      $strVal = $strVal.',:'.$tabK[$i];
    }
    $strK = join(',', $tabK);


    try{
      $sql = "INSERT INTO $table_name ($strK) VALUES ($strVal)";
      $req_prep = model::$pdo->prepare($sql);
      $req_prep->execute($tabV);
    }
    catch (Exception $e){
      echo 'Exception reçue : ', $e->getMessage(),"\n";
    }
  }

}

  model::Init();
?>
