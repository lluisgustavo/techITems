<?php 

Class Supplier{
    public function create($data = []){
        $db = Database::newInstance();
        $arr['supplier'] = ucwords($data->supplier);
        $arr['parent'] = ucwords($data->parent);
 

        if(!preg_match("/^([a-zA-Zà-úÀ-Ú0-9]|-|_|\s)+$/", $arr['category'])){
            $_SESSION['error'] = "Digite um nome de categoria válido <br>";
        }

        if(!isset($_SESSION['error']) || $_SESSION['error'] == ""){
            $sqlCategory = "INSERT INTO categories (category, parent) VALUES (:category, :parent)";
 
            $check = $db->write($sqlCategory, $arr);

            if($check){
                return true;
            }
        }

        return false;
    }

    public function readAll($data = ""){
        $db = Database::newInstance();
        return $db->read("SELECT * FROM suppliers ORDER BY supplier_name ASC");
    }

    public function getOne($id){
        $id = (int)$id;
        $db = Database::newInstance(); 

        $arr['id'] = $id;
        $sqlGetOne = "SELECT * FROM suppliers WHERE id = :id LIMIT 1";
        $category = $db->read($sqlGetOne, $arr);  
        if($category) return $category[0];
        return "";
        
    }

    public function update($data){
        $db = Database::newInstance();
        $arr['id'] = $data->id;
        $arr['category'] = $data->category;
        $arr['parent'] = $data->parent; 
  
        $sqlUpdateCategory = "UPDATE categories SET category = :category, parent = :parent WHERE id = :id";
        $db->write($sqlUpdateCategory, $arr);
    }

    public function delete($id){
        $db = Database::newInstance();
        $id = (int)$id;
        $sqlDeleteCategory = "DELETE FROM categories WHERE id = '$id' LIMIT 1";
        return $db->write($sqlDeleteCategory);
    }

    public function make_table($suppliers, $model = null){
        $result = "";
        if(is_array($suppliers)){
            foreach($suppliers as $Supplier){ 
                if(null !== $model->getOne($Supplier->address_id) && is_object($model->getOne($Supplier->address_id))) {
                    $address = $model->getOne($Supplier->address_id);
                    $address_string = $address->street . ', ' . $address->number;
                    if(!empty($address->complement)) $address_string .= ' - ' . $address->complement . ' - ';
                    $address_string .= ' - ' . $address->district . ' - ';
                    $address_string .= ' - ' . $address->city . ',' . $address->state;
                    $address_string .= ' - ' . $address->country;
                }else{
                    $address = "";
                }     
 
                $result .= '<tr>
                                <td>' . $Supplier->id . '</td>
                                <td>'  . $Supplier->supplier_name . '</td>
                                <td>'  . $Supplier->contact_name . '</td>
                                <td>'  . $Supplier->contact_mail . '</td>
                                <td>'  . $Supplier->contact_phone . '</td>
                                <td>'  . $address_string . '</td>';
                                
                
                ($Supplier->status == 1) ? $result .= '<td><span style="cursor: pointer" onclick="toggleStatus(' . $Supplier->id . ')" class="badge rounded-pill bg-success">Ativo</span></td>' : $result .= '<td><span style="cursor: pointer" onclick="toggleStatus(' . $Supplier->id . ')" class="badge rounded-pill bg-warning text-dark">Inativo</span></td>';
                 
                $result .= '<td>  
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit-supplier" 
                                    data-bs-id="' . $Supplier->id . '" data-bs-supplier="' . $Supplier->supplier_name . '" data-bs-contact="' . $Supplier->contact_name . '"
                                    data-bs-email="' . $Supplier->contact_mail . '" data-bs-phone="' . $Supplier->contact_phone . '" data-bs-address_id="' . $address->id . '"
                                    data-bs-address_street="' . $address->street . '" data-bs-address_no="' . $address->number . '" data-bs-address_complement="' . $address->complement . '"
                                    data-bs-address_district="' . $address->district . '" data-bs-address_city="' . $address->city . '" data-bs-address_state="' . $address->state . '"
                                    data-bs-address_postalcode="' . $address->postalcode . '" data-bs-address_country="' . $address->country . '">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button onclick="deleteRow(' . $Supplier->id . ')" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>';  
            }
        }

        return $result;
    }

}