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

    public function make_table($orders){
        $result = "";
        if(is_array($orders)){
            foreach($oreder as $Order){
                $edit_args = $Category->id . ", '" . $Category->category . "', " . $Category->parent;
                $empty = "''";
                $parent = "Sem pai";

                if(isset($Category->parent) && !empty($Category->parent) && null !== $Category->parent) $parent = $this->getOne($Category->parent)->category;
   
                $result .= '<tr>
                                <td><a href="basic_table.html#">' . $Category->category . '</a></td>
                                <td><a href="basic_table.html#">'  . $parent . '</a></td>';
                                
                
                ($Category->status == 1) ? $result .= '<td><span style="cursor: pointer" onclick="toggleStatus(' . $Category->id . ')" class="badge rounded-pill bg-success">Ativo</span></td>' : $result .= '<td><span style="cursor: pointer" onclick="toggleStatus(' . $Category->id . ')" class="badge rounded-pill bg-warning text-dark">Inativo</span></td>';
                 
                $result .= '<td>  
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit-category" 
                                    data-bs-id="' . $Category->id . '" data-bs-category="' . $Category->category . '" data-bs-parent="' . $Category->parent . '">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button onclick="deleteRow(' . $Category->id . ')" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>';  
            }
        }

        return $result;
    }

    public function make_select($categories){
        $result = "";
        
        if(is_array($categories)){
            $result .= '<select name="categoria-produto" id="categoria-produto" class="form-control">';
            foreach($categories as $Category){
                $result .= '<option value="' . $Category->id . '">' . $Category->category . '</option>';
            }
            $result .= '</select>';
        }
        return $result;
    }

    public function make_select_parent($categories){
        $result = ""; 
        if(is_array($categories)){
            $result .= '<select name="pai-categoria" id="pai-categoria" class="form-control">
                <option value="" selected>Selecione uma categoria</option>';
            foreach($categories as $Category){
                $result .= '<option value="' . $Category->id . '">' . $Category->category . '</option>';
            }
            $result .= '</select>';
        }
        return $result;
    } 

    public function make_select_edit_category($categories){
        $result = "";
        if(is_array($categories)){
            $result .= '<select name="editar-pai-categoria" id="editar-pai-categoria" class="form-control">
                <option value="" selected>Selecione uma categoria</option>';
            foreach($categories as $Category){
                $result .= '<option value="' . $Category->id . '">' . $Category->category . '</option>';
            }
            $result .= '</select>';
        }
        return $result;
    } 

    public function make_select_edit_product($categories){
        $result = "";
        if(is_array($categories)){
            $result .= '<select name="editar-categoria-produto" id="editar-categoria-produto" class="form-control">
                <option value="" selected>Selecione uma categoria</option>';
            foreach($categories as $Category){
                $result .= '<option value="' . $Category->id . '">' . $Category->category . '</option>';
            }
            $result .= '</select>';
        }
        return $result;
    } 
}