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
                
                $arr['message_type'] = "info";
                $arr['data_type'] = "add-new";
  
                $activeProducts = $db->read("SELECT * FROM tb_products WHERE status = 1");
                $stocks = $db->read("SELECT p.title, s.id, s.product_id, s.obs, SUM(s.movement) as quantity
                                        FROM tb_products as p
                                        INNER JOIN tb_stock s ON s.product_id = p.id");
                $stock = $this->load_model("Stock");  
                $product = $this->load_model("Product");  
         
                $arr['data'] = $stock->make_table($stocks, $product); 

                echo json_encode($arr);
            }
        }
    }
}