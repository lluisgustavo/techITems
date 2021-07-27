<?php

Class AjaxOrder extends Controller{
    public function index(){
        $data = file_get_contents("php://input");
        $data = json_decode($data);
        if(is_object($data) && isset($data->data_type)){
            $db = Database::getInstance();
            $category = $this->load_model('Order');

            if($data->data_type == "toggle-status"){
                $id = $data->id;
                $sqlStatusUpdate = "UPDATE tb_orders SET status = IF(status = 1, 0, 1) WHERE id = '$id' LIMIT 1";
                $db->write($sqlStatusUpdate);
                
                $arr['message_type'] = "info";
                $arr['data_type'] = "toggle-status";

                if($user_data->rank === "customer"){  
                    $sqlOrders = "SELECT o.*, op.product_id ,GROUP_CONCAT(CONCAT(p.title, ' x ', op.product_quantity) SEPARATOR '<br>') as products, 
                                    SUM(p.price_sell * op.product_quantity)as total_value FROM tb_orders o
                                    INNER JOIN tb_orders_products op ON op.order_id = o.id
                                    INNER JOIN tb_products p ON p.id = op.product_id
                                    WHERE o.customer_id = :customer_id
                                    GROUP BY o.id
                                    ORDER BY o.id ASC";
                    $orders = $db->read($sqlOrders, $arr); 
                    $tableRows = $order->make_table_customer($orders); 
                } else {
                    $sqlOrders = "SELECT o.*, pe.name, op.product_id ,GROUP_CONCAT(CONCAT(p.title, ' x ', op.product_quantity) SEPARATOR '<br>') as products, SUM(p.price_sell * op.product_quantity)as total_value FROM tb_orders o
                                    INNER JOIN tb_orders_products op ON op.order_id = o.id
                                    INNER JOIN tb_products p ON p.id = op.product_id
                                    INNER JOIN tb_customers c ON c.id = o.customer_id
                                    INNER JOIN tb_people pe ON pe.id = c.person_id 
                                    GROUP BY o.id
                                    ORDER BY o.id ASC";
                    $orders = $db->read($sqlOrders);
                    $tableRows = $order->make_table($orders); 
                }

                echo json_encode($arr);
            }
        }
    }
}