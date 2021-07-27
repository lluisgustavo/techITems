<?php

Class User{
    private $error = "";
    
    public function signUp($POST){
        $data = array();
        $db = Database::getInstance(); 
        $user['email'] = trim($POST['register-email']);
        $user['password'] = trim($POST['password']);
        $passwordretype = trim($POST['password-retype']);
        $person['name'] = trim($POST['register-name']);
        $person['phone'] = trim($POST['register-tel']);
        $person['CPF'] = trim($POST['register-CPF']);
        $person['birth'] = trim($POST['register-birth']);
        $address['postalcode'] = trim($POST['register-CEP']);
        $address['street'] = trim($POST['register-street']);
        $address['number'] = trim($POST['register-number']);

        if($POST['register-complement']){
            $address['complement'] = trim($POST['register-complement']);
        } else {
            $address['complement'] = "";
        }

        $address['district'] = trim($POST['register-district']);
        $address['state'] = trim($POST['register-state']);
        $address['city'] = trim($POST['register-city']);
        $address['country'] = trim($POST['register-country']);

        if($POST['register-ref']){
            $address['ref'] = trim($POST['register-ref']);
        } else {
            $address['ref'] = "";
        }

        $regex = '/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

        if (empty($user['email']) || !preg_match($regex, $user['email'])) {
            $this->error .= "Digite um e-mail válido <br>";
        }

        $regex = "/^[a-zA-Z]+$/";

        if($user['password'] !== $passwordretype){
            $this->error .= "Senhas não são iguais <br>";
        }

        if(strlen($user['password']) < 8){
            $this->error .= "Senha deve ter pelo menos 8 caracteres <br>";
        }

        //verificar se e-mail já está cadastrado
        $sqlEmail = "SELECT * FROM tb_users WHERE email = :email LIMIT 1";
        $arr['email'] = $user['email'];
        $checkEmail = $db->read($sqlEmail, $arr);
        
        if(is_array($checkEmail)){
            $this->error .= "O e-mail já está em uso <br>";
        }

        //verificar se a url_address não existe
        $arr = false;
        $user['url_address'] = $this->get_random_string_max(60);

        $sqlUrl = "SELECT * FROM tb_users WHERE url_address = :url_address LIMIT 1";
        $arr['url_address'] = $user['url_address'];
        $checkUrl = $db->read($sqlUrl, $arr);
        
        if(is_array($checkEmail)){
            $user['url_address'] = $this->get_random_string_max(60);
        }

        $arr = false;
        //Criar o usuário -> criar o endereço da pessoa -> criar a pessoa -> criar um customer
        if($this->error == ""){ 
            $user['rank'] = "customer";
            $user['created_at'] = date("Y-m-d H:i:s");
            $user['avatar'] = 'uploads/avatar/customer.png'; 
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
 
            $query = "INSERT INTO tb_users (url_address, email, password, rank, avatar, created_at) values (:url_address, :email, :password, :rank, :avatar, :created_at)";
            $result = $db->write($query, $user);

            $query = "SELECT LAST_INSERT_ID() AS user_id";
            $user_id = $db->read($query);
            $user_id = $user_id[0]->user_id;
 
            $query = "INSERT INTO tb_address (street, number, complement, district, city, state, postalcode, country, ref) values (:street, :number, :complement, :district, :city, :state, :postalcode, :country, :ref)";
            $result = $db->write($query, $address);

            $query = "SELECT LAST_INSERT_ID() AS address_id";
            $address_id = $db->read($query);
            $address_id = $address_id[0]->address_id;

            $person['user_id'] = $user_id;
            $person['address_id'] = $address_id;

            $query = "INSERT INTO tb_people (user_id, address_id, name, CPF, phone, birth) values (:user_id, :address_id, :name, :CPF, :phone, :birth)";
            $result = $db->write($query, $person);

            $query = "SELECT LAST_INSERT_ID() AS person_id";
            $person_id = $db->read($query);
            $person_id = $person_id[0]->person_id;

            $customer['person_id'] = $person_id;

            $query = "INSERT INTO tb_customers (person_id) values (:person_id)";
            $result = $db->write($query, $customer);

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
            $sqlUser = "SELECT * FROM tb_users WHERE email = :email LIMIT 1";
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
            $sqlUser = "SELECT u.id as user_id, u.url_address, u.email, u.rank, u.avatar, u.created_at, p.id as id_person, p.address_id, p.name, p.CPF, p.phone, p.birth, c.id as id_customer, c.person_id FROM tb_users AS u 
                        INNER JOIN tb_people p ON u.id = p.user_id 
                        INNER JOIN tb_customers c ON p.id = c.person_id 
                        WHERE url_address = :url_address
                        LIMIT 1";

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
                $query = "SELECT * FROM tb_users WHERE url_address = :url_address LIMIT 1";
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

    public function updateImage($data, $files){
        $db = Database::newInstance();
        $arr['id'] = $data->id;
        
        $size = (5 * 1024 * 1024);
        $allowed[] = "image/jpeg";
        $allowed[] = "image/png";
        $allowed[] = "image/gif";
        $folder = "uploads/avatar/";
        $image = $files['image'];
 
        if(!file_exists($folder)){
            mkdir($folder, 0777, true);
        }
 
        if($image['error'] == 0 && in_array($image['type'], $allowed)){
            if($image['size'] < $size){
                $destination = $folder . $image['name'];
                move_uploaded_file($image['tmp_name'], $destination);
                $arr['avatar'] = $destination;  
            } else {
                $_SESSION['error'] .= "Imagem " . $key .  " é maior do que o tamanho permitido.";
            }
        } 

        if(!isset($_SESSION['error']) || $_SESSION['error'] == ""){ 
            $sqlUpdateUser = "UPDATE tb_users SET avatar = :avatar WHERE id = :id"; 
            $check = $db->write($sqlUpdateUser, $arr);
        
            if($check){
                return true;
            }
        }
    }
    
    public function make_table($users, $model = null){
        $result = "";
        if(is_array($users)){   
            foreach($users as $User){   
                if($User->rank === "admin"){
                    $rank = "Administrador";
                } elseif($User->rank === "employee"){
                    $rank = "Colaborador";
                } elseif($User->rank === "customer"){
                    $rank = "Cliente"; 
                }

                $result .= '<tr>
                            <td>' . $User->id . '</td>
                            <td>' . $User->email . '</td>
                            <td>' . $rank . '</td>    
                            <td>' . date('d-m-Y', strtotime($User->created_at)) . '</td>    
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit-user" 
                                data-bs-id="' . $User->id . '" data-bs-email="' . $User->email . '"><i class="fa fa-cogs"></i>
                                </button>
                            </td> 
                            
                    </tr>';    
            }
        }

        return $result;
    }
}