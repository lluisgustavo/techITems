<?php

Class AjaxSupplier extends Controller{
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
            $supplier = $this->load_model('Supplier'); 
            $address = $this->load_model('Address'); 

            if($data->data_type == "add-supplier"){
                $check = $supplier->create($data); 

                if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
                    $arr['message'] = $_SESSION['error'];
                    $_SESSION['error'] = "";
                    $arr['message_type'] = "error";
                    $arr['data'] = "";
                    $arr['data_type'] = "add-supplier";

                    echo json_encode($arr);
                } else {
                    $arr['message'] = "Fornecedor adicionado.";
                    $arr['message_type'] = "info";
                    $arr['data_type'] = "add-supplier";
                    $suppliers = $supplier->readAll();
                    $arr['data'] = $supplier->make_table($suppliers, $address);

                    echo json_encode($arr);
                }
            } else if($data->data_type == "delete-row"){  
                $supplier->delete($data->id);

                $arr['message'] = "Fornecedor deletado.";
                $arr['message_type'] = "info";
                $arr['data_type'] = "delete-row";

                $suppliers = $supplier->readAll();
                $arr['data'] = $supplier->make_table($suppliers, $address);

                echo json_encode($arr);
            } else if($data->data_type == "toggle-status"){
                $sqlArr['id'] = $data->id;
                $sqlStatusUpdate = "UPDATE tb_suppliers SET status = IF(status = 1, 0, 1) WHERE id = :id LIMIT 1";
                $db->write($sqlStatusUpdate, $sqlArr);
                
                $arr['message_type'] = "info";
                $arr['data_type'] = "toggle-status";

                $suppliers = $supplier->readAll();
                $arr['data'] = $supplier->make_table($suppliers, $address);

                echo json_encode($arr);
            } else if($data->data_type == "edit-supplier"){ 
                $id = $data->id; 
                $supplier->update($data);
 
                $arr['message'] = "Produto editado.";
                $arr['message_type'] = "info";
                $arr['data_type'] = "edit-supplier";
                $arr['id'] = $data->id;
                if(isset($data->supplier_name)) $arr['supplier'] = $data->supplier_name; 

                $suppliers = $supplier->readAll();
                $arr['data'] = $supplier->make_table($suppliers, $address);

                echo json_encode($arr);
            }
        }
    }
}