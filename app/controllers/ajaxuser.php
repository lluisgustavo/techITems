<?php

Class AjaxUser extends Controller{
    public function index(){
        //$data = file_get_contents("php://input");
		if(count($_POST) > 0){
            $data = (object)$_POST;
       }else{
            $data = file_get_contents("php://input");
            $data = json_decode($data);
       }  
 
        if(is_object($data) && isset($data->data_type)){
            $db = Database::newInstance();
            $user = $this->load_model('Usre'); 

            if($data->data_type == "edit-image"){
                $check = $user->create($data, $_FILES, $imageClass); 

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
                $id = $data->id;

                $arr['newPassword'] = $data->new_password;
                $sqlPasswordUpdate = "UPDATE tb_user SET password = :newPassword WHERE id = '$id' LIMIT 1";
                $db->write($sqlStatusUpdate);
                
                $arr['message_type'] = "info";
                $arr['data_type'] = "update-pass"; 

                echo json_encode($arr);
            } else if($data->data_type == "toggle-active"){
                $id = $data->id;
 
                $sqlPasswordUpdate = "UPDATE tb_user SET active = IF(active = 1, 0, 1)  WHERE id = '$id' LIMIT 1";
                $db->write($sqlStatusUpdate);
                
                $arr['message_type'] = "info";
                $arr['data_type'] = "toggle-active"; 

                echo json_encode($arr);
            }
        }
    }
}