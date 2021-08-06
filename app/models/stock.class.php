<?php 

Class Stock{
    public function create($data){
        $_SESSION['error'] = "";
 
        $db = Database::newInstance();  
 
        $arr['product_id'] = $data->product_id;
        $arr['movement'] = $data->movement;

        if(!is_numeric($arr['movement'])){ 
            $_SESSION['error'] = "Digite uma quantidade válida";
        }

        $arr['obs'] = $data->obs;
        $arr['created_at'] = date('Y-m-d H:i:s');
        $arr['url_user_updated'] = $_SESSION['user_url']; 

        if(!isset($_SESSION['error']) || $_SESSION['error'] == ""){
            $sqlInsertStockMovement = "INSERT INTO tb_stock (product_id, movement, obs, created_at, url_user_updated) VALUES (:product_id, :movement, :obs, :created_at, :url_user_updated)";
            $check = $db->write($sqlInsertStockMovement, $arr); 

            if($check){
                return true;
            }
        }

        return false;
    }

    public function readAll($data = ""){
        $db = Database::newInstance();
        return $db->read("SELECT * FROM tb_stock");
    }

    public function make_table_stock($stocks, $model = null){
        $result = ""; 
        if(is_array($stocks) && !is_null($stocks[0]->title) ){ 
            foreach($stocks as $Stock){    
                $result .= '<tr>
                                <td>' . $Stock->title . '</a></td>
                                <td>' . $Stock->quantity . '</a></td> 
                            </tr>'; 
            }
        }

        return $result;
    } 

    public function make_table_movement($stocks, $model = null){
        $result = ""; 
        if(is_array($stocks) && !is_null($stocks[0]->id) ){ 
            foreach($stocks as $Stock){    
                $result .= '<tr>
                                <td>' . $Stock->title . '</a></td>
                                <td>' . $Stock->movement . '</a></td>
                                <td>' . $Stock->obs . '</a></td> 
                            </tr>'; 
            }
        }

        return $result;
    } 

    public function make_select_products($products){
        $result = "";
        
        if(is_array($products)){
            $result .= '<select name="produto-pedido" id="produto-pedido" class="form-control" required>
                        <option disabled selected>Selecione um produto</option>';
            foreach($products as $Product){
                $result .= '<option value="' . $Product->id . '">' . $Product->title . '</option>';
            }
            $result .= '</select>';
        }
        return $result;
    }
}