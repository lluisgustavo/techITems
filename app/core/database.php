<?php

Class Database{
    public static $con;

    public function __construct() {
        try {

            $string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME;
            self::$con = new PDO($string, DB_USER, DB_PASS);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance(){
        if(self::$con){
            return self::$con;
        }

        return $instance = new self();
    }

    public static function newInstance(){
        return $instance = new self();
    }

    public function write($query, $data = array()){  
        $statement = self::$con->prepare($query);  
        $result = $statement->execute($data);

        if($result){
            return true;
        }

        return false;
    }

    public function read($query, $data = array()){
        $statement = self::$con->prepare($query); 
        $result = $statement->execute($data);

        if($result){
            $data = $statement->fetchAll(PDO::FETCH_OBJ);
            if(is_array($data) && count($data) > 0){
                return $data;
            }
        }

        return false;
    }
}