<?php

Class AjaxBrand extends Controller{
    public function index(){
        $data = file_get_contents("php://input");
        $data = json_decode($data);
        if(is_object($data) && isset($data->data_type)){
            $db = Database::getInstance();
            $brand = $this->load_model('Brand');

            if($data->data_type == "add-brand"){
                $check = $brand->create($data); 

                if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
                    $arr['message'] = $_SESSION['error'];
                    $_SESSION['error'] = "";
                    $arr['message_type'] = "error";
                    $arr['data'] = "";
                    $arr['data_type'] = "add-new";

                    echo json_encode($arr);
                } else {
                    $arr['message'] = "Marca adicionada.";
                    $arr['message_type'] = "info";
                    $arr['data_type'] = "add-new";

                    $brands = $brand->readAll();
                    $arr['data'] = $brand->make_table($brands);

                    echo json_encode($arr);
                }
            } else if($data->data_type == "delete-row"){
                $brand->delete($data->id);

                $arr['message'] = "Marca deletada.";
                $arr['message_type'] = "info";
                $arr['data_type'] = "delete-row";

                $brands = $brand->readAll();
                $arr['data'] = $brand->make_table($brands);

                echo json_encode($arr);
            } else if($data->data_type == "toggle-status"){
                $id = $data->id;
                $sqlStatusUpdate = "UPDATE tb_brands SET status = IF(status = 1, 0, 1) WHERE id = '$id' LIMIT 1";
                $db->write($sqlStatusUpdate);
                
                $arr['message_type'] = "info";
                $arr['data_type'] = "toggle-status";

                $brands = $brand->readAll();
                $arr['data'] = $brand->make_table($brands);

                echo json_encode($arr);
            } else if($data->data_type == "edit-brand"){ 
                $id = $data->id;
            
                $brand->update($data);
                $arr['message'] = "Marca editada.";
                $arr['message_type'] = "info";
                $arr['data_type'] = "edit-category";
                $arr['id'] = $data->id;
                $arr['category'] = $data->category;

                $brands = $brand->readAll();
                $arr['data'] = $brand->make_table($brands);

                echo json_encode($arr);
            }
        }
    }
}