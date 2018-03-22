<?php
  class conf {
    // tạo dữ liệu cho PDO
    static private $databases = array(
      'hostname' => 'localhost', //server
      'database' => 'Bookmarking', //BDD
      'login' => 'root',
      'password' => 'root'
    );

    static private $debug = True; // tester s'il y a debug

    // comme Exception dans Java
    static public function getDebug(){
      return self::$debug;
    }

    static public function getLogin(){
      return self::$databases['login'];
    }

    static public function getHostname(){
      return self::$databases['hostname'];
    }

    static public function getDatabase(){
      return self::$databases['database'];
    }

    static public function getPassword(){
      return self::$databases['password'];
    }
  }

?>
