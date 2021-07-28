<?php

Class AjaxStock extends Controller{
    public function index(){
        $data = file_get_contents("php://input");
        $data = json_decode($data);
        if(is_object($data) && isset($data->data_type)){
            $db = Database::getInstance();
            $stock = $this->load_model('Stock');

            if($data->data_type == "add-movement"){  
                $check = $stock->create($data);  
                
                if($check){ 
                    $arr['message'] = "Estoque atualizado.";
    
                    $arr['message_type'] = "info";
                    $arr['data_type'] = "add-new";
    
                    $stockMovement = $db->read("SELECT p.title, s.id, s.product_id, s.obs, s.movement
                                                FROM tb_products as p
                                                INNER JOIN tb_stock s ON s.product_id = p.id");
            
                    $stockProducts = $db->read("SELECT p.title, SUM(s.movement) as quantity
                                                FROM tb_products as p
                                                INNER JOIN tb_stock s ON s.product_id = p.id
                                                group by s.product_id");

                    $product = $this->load_model("Product");  
             
                    $arr['data-movement'] = $stock->make_table_movement($stockMovement, $product); 
                    $arr['data-stock'] = $stock->make_table_stock($stockProducts, $product); 
    
                    echo json_encode($arr);
                }else{
                    $arr['message_type'] = "Ocorreu um erro ao movimentar o estoque.";
                    $arr['message_type'] = "info";
                    $arr['data_type'] = "error";
                    $arr['data'] = $stock->make_table_movement($stockMovement, $product); 
    
                    echo json_encode($arr);
                }

            }
        }
    }
}