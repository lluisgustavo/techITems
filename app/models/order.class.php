<?php 

Class Order{
    public function create($data = []){
        $db = Database::newInstance(); 
        $order['customer_id'] = $data->customer_id;
        $order['ordered_at'] = date("Y-m-d H:i:s");
        

        $sqlNewOrder = "INSERT INTO tb_orders (customer_id, ordered_at) VALUES (:customer_id, :ordered_at)";
        $newOrder = $db->write($sqlNewOrder, $order);

        $sqlGetOrder = "SELECT LAST_INSERT_ID() as order_id";
        $order_id = $db->read($sqlGetOrder);
        $order_id = $order_id[0]->order_id;
 
        $products_order['order_id'] = $order_id;
        foreach($data->product_IDs as $keyPro => $product_id){
            $products_order['product_id'] = $product_id;
            $products_order['product_quantity'] = $data->product_Qtd[$keyPro];  
            
            $sqlNewProductOrder = "INSERT INTO tb_orders_products (order_id, product_id, product_quantity) VALUES (:order_id, :product_id, :product_quantity)";
            $newProductOrder = $db->write($sqlNewProductOrder, $products_order);
        }
         
        if($newProductOrder){
            return true;
        }

        return false;
    }

    public function readAll($data = ""){
        $db = Database::newInstance();
        return $db->read("SELECT * FROM tb_orders ORDER BY id ASC");
    }

    public function getOne($id){
        $id = (int)$id;
        $db = Database::newInstance(); 

        $arr['id'] = $id;
        $sqlGetOne = "SELECT * FROM tb_orders WHERE id = :id LIMIT 1";
        $category = $db->read($sqlGetOne, $arr);  
        if($category) return $category[0];
        return ""; 
    }

    public function update($data){
        $db = Database::newInstance();
        $arr['id'] = $data->id;
        $arr['category'] = $data->category;
        $arr['parent'] = $data->parent; 
  
        $sqlUpdateCategory = "UPDATE tb_orders SET category = :category, parent = :parent WHERE id = :id";
        $db->write($sqlUpdateCategory, $arr);
    }

    public function delete($id){
        $db = Database::newInstance();
        $id = (int)$id;
        $sqlDeleteCategory = "DELETE FROM tb_orders WHERE id = '$id' LIMIT 1";
        return $db->write($sqlDeleteCategory);
    }

    public function make_table($orders, $model = null){
        $result = "";
        if(is_array($orders)){   
            foreach($orders as $Order){ 
                if($Order->status == 0):
                    $result .= '<tr>
                                <td><s>' . $Order->id . '</s></td>
                                <td><s>' . $Order->products . '</s></td>
                                <td><s>R$ ' . number_format($Order->total_value, 2, ',', '.') . '</s></td>   
                                <td>Pedido cancelado</td>
                        </tr>';  
                else:
                    $result .= '<tr>
                                <td>' . $Order->id . '</td>
                                <td>' . $Order->products . '</td>
                                <td>R$ ' . number_format($Order->total_value, 2, ',', '.') . '</td>  
                                <td><button onclick="cancelOrder(' . $Order->id . ')" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td> 
                            </td>
                        </tr>';  
                endif;
            }
        }

        return $result;
    }

    public function make_table_customer($orders, $model = null ){
        $result = "";
        if(is_array($orders)){   
            foreach($orders as $Order){ 
                if($Order->status == 0):
                    $result .= '<tr>
                                <td><s>' . $Order->id . '</s></td>
                                <td><s>' . $Order->products . '</s></td>
                                <td><s>R$ ' . number_format($Order->total_value, 2, ',', '.') . '</s></td>   
                                <td>Pedido cancelado</td>
                        </tr>';  
                else:
                    $result .= '<tr>
                                <td>' . $Order->id . '</td>
                                <td>' . $Order->products . '</td>
                                <td>R$ ' . number_format($Order->total_value, 2, ',', '.') . '</td>  
                                <td><button onclick="cancelOrder(' . $Order->id . ')" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td> 
                            </td>
                        </tr>';  
                endif;
            }
        }

        return $result;
    }
}