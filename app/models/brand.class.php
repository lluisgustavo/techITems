<?php 

Class Brand{
    public function create($data = []){
        $db = Database::newInstance(); 
        $arr['brand_name'] = ucwords($data->brand); 

        if(!isset($_SESSION['error']) || $_SESSION['error'] == ""){
            $sqlBrand = "INSERT INTO tb_brands (brand_name) VALUES (:brand_name)";
 
            $check = $db->write($sqlBrand, $arr);

            if($check){
                return true;
            }
        }

        return false;
    }

    public function readAll($data = ""){
        $db = Database::newInstance();
        return $db->read("SELECT * FROM tb_brands ORDER BY id ASC");
    }

    public function getOne($id){
        $id = (int)$id;
        $db = Database::newInstance(); 

        $arr['id'] = $id;
        $sqlGetOne = "SELECT * FROM tb_brands WHERE id = :id LIMIT 1";
        $brand = $db->read($sqlGetOne, $arr);  
        if($brand) return $brand[0];
        return ""; 
    }

    public function update($data){
        $db = Database::newInstance();
        $arr['id'] = $data->id;
        $arr['brand_name'] = $data->brand_name; 
  
        $sqlUpdateBrand = "UPDATE tb_brands SET brand_name = :brand_name WHERE id = :id";
        $db->write($sqlUpdateBrand, $arr);
    }

    public function delete($id){
        $db = Database::newInstance();
        $arr['id'] = (int)$id;
        $sqlDeleteBrand = "DELETE FROM tb_brands WHERE id = :id LIMIT 1";
        return $db->write($sqlDeleteBrand, $arr);
    }

    public function make_table($brands){
        $result = "";
        if(is_array($brands)){
            foreach($brands as $Brand){  
                $result .= '<tr>
                                <td><a href="basic_table.html#">' . $Brand->id . '</a></td>
                                <td><a href="basic_table.html#">'  . $Brand->brand_name . '</a></td>';
                                
                ($Brand->status == 1) ? $result .= '<td><span style="cursor: pointer" onclick="toggleStatus(' . $Brand->id . ')" class="badge rounded-pill bg-success">Ativo</span></td>' : $result .= '<td><span style="cursor: pointer" onclick="toggleStatus(' . $Brand->id . ')" class="badge rounded-pill bg-warning text-dark">Inativo</span></td>';
                            
                                $result .= '<td>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit-product" 
                                    data-bs-id="' . $Brand->id . '" data-bs-brand="' . $Brand->brand_name . '"><i class="fa fa-pencil"></i>
                                </button>
                                    <button onclick="deleteRow(' . $Brand->id . ')" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
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