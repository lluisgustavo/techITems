<?php

Class AjaxBuy extends Controller{
    public function index(){
        $data = file_get_contents("php://input"); 
        $data = json_decode($data); 
 
        if(is_object($data) && isset($data->data_type)){
            $db = Database::getInstance();
            $order = $this->load_model('Order');

            if($data->data_type == "add-order"){
                $check = $order->create($data);   
                
                $arr['message'] = "Pedido adicionado.";
                $arr['message_type'] = "info";
                $arr['data_type'] = "add-new";
 
                //$arr['data'] = $order->make_table($categories); 
                echo json_encode($arr);
            }
        }
    }
}