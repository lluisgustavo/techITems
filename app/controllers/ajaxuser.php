<?php

Class AjaxUser extends Controller{
    public function index(){
	     
        if(count($_POST) > 0){
            $data = (object) $_POST;
        }else{
            $data = file_get_contents("php://input"); 
            $data = json_decode($data); 
        }   

        if(is_object($data) && isset($data->data_type)){
            $db = Database::newInstance();
            $user = $this->load_model('User'); 
 
            if($data->data_type == "edit-image"){
                $check = $user->updateImage($data, $_FILES); 

                if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
                    $arr['message'] = $_SESSION['error'];
                    $_SESSION['error'] = "";
                    $arr['message_type'] = "error";
                    $arr['data'] = "";
                    $arr['data_type'] = "edit-image";

                    echo json_encode($arr); 
                } else {
                    $arr['message'] = "Imagem editada.";
                    $arr['message_type'] = "info";
                    $arr['data_type'] = "edit-image"; 

                    echo json_encode($arr);
                }
            } else if($data->data_type == "update-pass"){
                $arr['id'] = $data->id;  
                $arr['newPassword'] = password_hash($data->new_password, PASSWORD_DEFAULT);
                $arr['updated_at'] = date("Y-m-d H:i:s");
                
                $sqlUser = "SELECT * FROM tb_users WHERE id = {$data->id} LIMIT 1";
                $databaseUser = $db->read($sqlUser);  

                if(is_array($databaseUser) && password_verify($data->new_password, $databaseUser[0]->password)){
                    $arr['message'] = 'A senha não pode ser a mesma.'; 
                } else{ 
                    $sqlPasswordUpdate = "UPDATE tb_users SET password = :newPassword, updated_at = :updated_at WHERE id = :id LIMIT 1"; 
                    $db->write($sqlPasswordUpdate, $arr);
                    
                    $arr['message_type'] = "info";
                    $arr['data_type'] = "update-pass"; 
    
                    echo json_encode($arr); 
                }

            } else if($data->data_type == "toggle-active"){
                $arr['id'] = $data->id;

                $sqlPasswordUpdate = "UPDATE tb_users SET active = IF(active = 1, 0, 1)  WHERE id = :id LIMIT 1";
                $db->write($sqlStatusUpdate, $arr);
                
                $arr['message_type'] = "info";
                $arr['data_type'] = "toggle-active"; 

                echo json_encode($arr);
            } else if($data->data_type == "update-personal"){
                $arr['user_id'] = $data->id;
                $arr['name'] = $data->name;
                $arr['CPF'] = $data->cpf;
                $arr['phone'] = $data->phone;
                $arr['birth'] = $data->birth;
                
                $sqlPersonUpdate = "UPDATE tb_people SET name = :name, CPF = :CPF, phone = :phone, birth = :birth WHERE user_id = :user_id";
                $person = $db->write($sqlPersonUpdate, $arr); 
 
                echo json_encode($arr);
            }
        }
    }
}