<?php

Class AjaxOrder extends Controller{
    public function index(){
        $data = file_get_contents("php://input");
        $data = json_decode($data);
        if(is_object($data) && isset($data->data_type)){
            $db = Database::getInstance();
            $category = $this->load_model('Order');

            if($data->data_type == "add-order"){
                $check = $category->create($data); 

                if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
                    $arr['message'] = $_SESSION['error'];
                    $_SESSION['error'] = "";
                    $arr['message_type'] = "error";
                    $arr['data'] = "";
                    $arr['data_type'] = "add-new";

                    echo json_encode($arr);
                } else {
                    $arr['message'] = "Pedido adicionado.";
                    $arr['message_type'] = "info";
                    $arr['data_type'] = "add-new";

                    $categories = $category->readAll();
                    $arr['data'] = $category->make_table($categories);

                    echo json_encode($arr);
                }
            } else if($data->data_type == "delete-row"){
                $category->delete($data->id);

                $arr['message'] = "Pedido deletado.";
                $arr['message_type'] = "info";
                $arr['data_type'] = "delete-row";

                $categories = $category->readAll();
                $arr['data'] = $category->make_table($categories);

                echo json_encode($arr);
            } else if($data->data_type == "toggle-status"){
                $id = $data->id;
                $sqlStatusUpdate = "UPDATE tb_categories SET status = IF(status = 1, 0, 1) WHERE id = '$id' LIMIT 1";
                $db->write($sqlStatusUpdate);
                
                $arr['message_type'] = "info";
                $arr['data_type'] = "toggle-status";

                $categories = $category->readAll();
                $arr['data'] = $category->make_table($categories);

                echo json_encode($arr);
            } else if($data->data_type == "edit-category"){ 
                $id = $data->id;
            
                $category->update($data);
                $arr['message'] = "Pedido editado.";
                $arr['message_type'] = "info";
                $arr['data_type'] = "edit-category";
                $arr['id'] = $data->id;
                $arr['category'] = $data->category;

                $categories = $category->readAll();
                $arr['data'] = $category->make_table($categories);

                echo json_encode($arr);
            }
        }
    }
}