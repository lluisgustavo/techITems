<?php

Class User{
    private $error = "";
    
    public function signUp($POST){
        $data = array();
        $db = Database::getInstance();
        $data['username'] = trim($POST['name']);
        $data['email'] = trim($POST['email']);
        $data['password'] = trim($POST['password']);
        $passwordretype = trim($POST['password-retype']);

        $regex = '/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

        if (empty($data['email']) || !preg_match($regex, $data['email'])) {
            $this->error .= "Digite um e-mail válido <br>";
        }

        $regex = "/^[a-zA-Z]+$/";

        if(empty($data['username']) || !preg_match($regex, $data['username'])){
            $this->error .= "Digite um usuário válido <br>";
        }

        if($data['password'] !== $passwordretype){
            $this->error .= "Senhas não são iguais <br>";
        }

        if(strlen($data['password']) < 8){
            $this->error .= "Senha deve ter pelo menos 8 caracteres <br>";
        }

        //verificar se e-mail já está cadastrado
        $sqlEmail = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $arr['email'] = $data['email'];
        $checkEmail = $db->read($sqlEmail, $arr);
        
        if(is_array($checkEmail)){
            $this->error .= "O e-mail já está em uso <br>";
        }

        //verificar se a url_address não existe
        $arr = false;
        $data['url_address'] = $this->get_random_string_max(60);

        $sqlUrl = "SELECT * FROM users WHERE url_address = :url_address LIMIT 1";
        $arr['url_address'] = $data['url_address'];
        $checkUrl = $db->read($sqlUrl, $arr);
        
        if(is_array($checkEmail)){
            $data['url_address'] = $this->get_random_string_max(60);
        }

        if($this->error == ""){ 
            $data['rank'] = "customer";
            $data['date'] = date("Y-m-d H:i:s");
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            $query = "INSERT INTO users (url_address, name, email, password, date, rank) values (:url_address, :username, :email, :password, :date, :rank)";
        
            $result = $db->write($query, $data);

            if($result){
                header("Location: " . ROOT . "login");
                die;
            } 
        }

        $_SESSION['error'] = $this->error;
    }

    public function login($POST){
        $data = array();
        $db = Database::getInstance();
        $data['email'] = trim($POST['email']);
        $data['password'] = trim($POST['password']);

        $regex = '/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

        if (empty($data['email']) || !preg_match($regex, $data['email'])) {
            $this->error .= "Digite um e-mail válido <br>";
        }

        $regex = "/^[a-zA-Z]+$/";

        if(strlen($data['password']) < 8){
            $this->error .= "Senha deve ter pelo menos 8 caracteres <br>";
        }

        if($this->error == ""){ 
            //confirmar senha
            $sqlUser = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $arr['email'] = $data['email'];
            $databaseUser = $db->read($sqlUser, $arr);
            if(is_array($databaseUser) && password_verify($data['password'], $databaseUser[0]->password)) {
                //verificar se usuario existe
                $_SESSION['user_url'] = $databaseUser[0]->url_address;
                header("Location: " . ROOT . "admin");
                die;
            }

            $this->error = "E-mail ou senha incorretos <br>";
        }

        $_SESSION['error'] = $this->error;        
    }

    public function logout(){
       if(isset($_SESSION['user_url'])){
           unset($_SESSION['user_url']);
       }
       
       header("Location: " . ROOT . "home");
       die;
    }

    public function getUser($user){

    }

    private function get_random_string_max($length){
        $array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'x', 'w', 'y', 'z', 
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'W', 'Y', 'Z');
                    
        $text = "";

        $length = rand(4, $length);

        for($i = 0; $i < $length; $i++){
            $random = rand(0, 61);

            $text .= $array[$random];
        }

        return $text;
    }

    public function check_login($redirect = false, $allowed = array()){
        $db = Database::getInstance();
        if(count($allowed) > 0){
            $arr['url_address'] = $_SESSION['user_url'];
            $sqlUser = "SELECT * FROM users WHERE url_address = :url_address LIMIT 1";
            $result = $db->read($sqlUser, $arr);

            if(is_array($result)){
                $result = $result[0];
                if(in_array($result->rank, $allowed)){
                    return $result;
                }
            } 

            header("Location: " . ROOT . "home");
            die;

        } else{
            if(isset($_SESSION['user_url'])){
                $arr = false;
                $arr['url_address'] = $_SESSION['user_url'];
                $query = "SELECT * FROM users WHERE url_address = :url_address LIMIT 1";
                $result = $db->read($query, $arr);

                if(is_array($result)){
                    return $result[0];
                }
            }
           
            if($redirect){
                header("Location: " . ROOT . "login");
                die;
            }
        }

        return false;
    }
}