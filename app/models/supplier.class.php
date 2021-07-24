<?php 

Class Supplier{
    public function create($data = []){
        $db = Database::newInstance(); 
        $arr_supplier['supplier_name'] = ucwords($data->supplier_name);
        $arr_supplier['CNPJ'] = $data->CNPJ;
        $arr_supplier['contact_name'] = ucwords($data->contact_name);
        $arr_supplier['contact_mail'] = $data->contact_mail;
        $arr_supplier['contact_phone'] = $data->contact_phone;
        $arr_address['street'] = ucwords($data->street);
        $arr_address['number'] = ucwords($data->number);
        $arr_address['complement'] = ucwords($data->complement);
        $arr_address['district'] = ucwords($data->district);
        $arr_address['city'] = ucwords($data->city);
        $arr_address['state'] = ucwords($data->state);
        $arr_address['postalcode'] = $data->postalcode;
        $arr_address['country'] = ucwords($data->country);
        $arr_address['ref'] = $data->ref;

        $_SESSION['error'] = "";
  
		$nameRegex = '/^([a-zA-Zà-úÀ-Ú0-9]|-|_|\s)+$/';;
		$CNPJRegex = '/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/';
		$emailRegex = '/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

        if(!preg_match($nameRegex, $arr_supplier['supplier_name'])){
            $_SESSION['error'] = "Digite um nome de fornecedor válido";
        }

        if(!preg_match($CNPJRegex, $arr_supplier['CNPJ'])){
            $_SESSION['error'] = "Digite um CNPJ válido";
        }

        if(!preg_match($nameRegex, $arr_supplier['contact_name'])){
            $_SESSION['error'] = "Digite um nome de fornecedor válido";
        }

        if(!preg_match($emailRegex, $arr_supplier['contact_mail'])){
            $_SESSION['error'] = "Digite um e-mail válido";
        }

        $arrCheckAddress['street'] = ucwords($data->street);
        $arrCheckAddress['number'] = ucwords($data->number);
        $arrCheckAddress['city'] = ucwords($data->city);
        $arrCheckAddress['complement'] = ucwords($data->complement);

        if(!isset($_SESSION['error']) || $_SESSION['error'] == ""){
            $sqlCheckAddress = "SELECT * FROM tb_address WHERE street = :street AND number = :number AND complement = :complement AND city = :city LIMIT 1";
            $checkAddress = $db->read($sqlCheckAddress, $arrCheckAddress);

            if(isset($checkAddress) && !empty($checkAddress)){  
                $checkAddress = $checkAddress[0]; 
                $address_id = $checkAddress->id;
            }

            if(empty($checkAddress)){  
                $sqlAddress = "INSERT INTO address(street, number, complement, district, city, state, postalcode, country, ref) VALUES (:street, :number, :complement, :district, :city, :state, :postalcode, :country, :ref)";
                $db->write($sqlAddress, $arr_address);  
                $address_id = $db->read("SELECT LAST_INSERT_ID()");
                $address_id = (Array) $address_id[0];
                $address_id = $address_id['LAST_INSERT_ID()'];
            }
                  
            $arr_supplier['address_id'] = $address_id;

            $sqlSupplier = "INSERT INTO suppliers (supplier_name, CNPJ, contact_name, contact_mail, contact_phone, address_id, status) VALUES (:supplier_name, :CNPJ, :contact_name, :contact_mail, :contact_phone, :address_id, 1)";

            $check = $db->write($sqlSupplier, $arr_supplier); 

            if($check){
                return true;
            }
        }

        return false;
    }

    public function readAll($data = ""){
        $db = Database::newInstance();
        return $db->read("SELECT * FROM tb_suppliers ORDER BY supplier_name ASC");
    }

    public function getOne($id){
        $id = (int)$id;
        $db = Database::newInstance(); 

        $arr['id'] = $id;
        $sqlGetOne = "SELECT * FROM tb_suppliers WHERE id = :id LIMIT 1";
        $category = $db->read($sqlGetOne, $arr);  
        if($category) return $category[0];
        return "";
        
    }

    public function update($data){
        $db = Database::newInstance();
        $arr_supplier['id'] = ucwords($data->id);
        $arr_supplier['supplier_name'] = ucwords($data->supplier_name);
        $arr_supplier['CNPJ'] = $data->CNPJ;
        $arr_supplier['contact_name'] = ucwords($data->contact_name);
        $arr_supplier['contact_mail'] = $data->contact_mail;
        $arr_supplier['contact_phone'] = $data->contact_phone;
        $arr_address['address_id'] = ucwords($data->address_id);
        $arr_address['street'] = ucwords($data->street);
        $arr_address['number'] = ucwords($data->number);
        $arr_address['complement'] = ucwords($data->complement);
        $arr_address['district'] = ucwords($data->district);
        $arr_address['city'] = ucwords($data->city);
        $arr_address['state'] = ucwords($data->state);
        $arr_address['postalcode'] = $data->postalcode;
        $arr_address['country'] = ucwords($data->country);
        $arr_address['ref'] = $data->ref;

        $_SESSION['error'] = "";

		$nameRegex = '/^([a-zA-Zà-úÀ-Ú0-9]|-|_|\s)+$/';;
		$CNPJRegex = '/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/';
		$emailRegex = '/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

        if(!preg_match($nameRegex, $arr_supplier['supplier_name'])){
            $_SESSION['error'] = "Digite um nome de fornecedor válido";
        }

        if(!preg_match($CNPJRegex, $arr_supplier['CNPJ'])){
            $_SESSION['error'] = "Digite um CNPJ válido";
        }

        if(!preg_match($nameRegex, $arr_supplier['contact_name'])){
            $_SESSION['error'] = "Digite um nome de fornecedor válido";
        }

        if(!preg_match($emailRegex, $arr_supplier['contact_mail'])){
            $_SESSION['error'] = "Digite um e-mail válido";
        }  

        if(!isset($_SESSION['error']) || $_SESSION['error'] == ""){
            $sqlUpdateAddress = "UPDATE tb_address SET street = :street, number = :number, complement = :complement, district = :district, city = :city, state = :state, postalcode = :postalcode, country = :country, ref = :ref WHERE id = :address_id";  
            $db->write($sqlUpdateAddress, $arr_address); 
             
            $sqlSupplier = "UPDATE tb_suppliers SET supplier_name = :supplier_name, CNPJ = :CNPJ, contact_name = :contact_name , contact_mail = :contact_mail, contact_phone = :contact_phone WHERE id = :id";
 
            $check = $db->write($sqlSupplier, $arr_supplier); 

            if($check){
                return true;
            }
        }

        return false; 
    }

    public function delete($id){
        $db = Database::newInstance();
        $arr['id'] = (int)$id;
        $sqlDeleteCategory = "DELETE FROM tb_suppliers WHERE id = :id LIMIT 1"; 
        return $db->write($sqlDeleteCategory, $arr);
    }

    public function make_table($suppliers, $model = null){
        $result = "";
        if(is_array($suppliers)){
            foreach($suppliers as $Supplier){ 
                if(null !== $model->getOne($Supplier->address_id) && is_object($model->getOne($Supplier->address_id))) {
                    $address = $model->getOne($Supplier->address_id);
                    $address_string = $address->street . ', ' . $address->number;
                    if(!empty($address->complement)) $address_string .= ' - ' . $address->complement . ' - ';
                    $address_string .= ' - ' . $address->district . ' - ' . $address->city . ', ' . $address->state . ' - ' . $address->country;
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
                                    data-bs-id="' . $Supplier->id . '" data-bs-supplier="' . $Supplier->supplier_name . '" data-bs-contact="' . $Supplier->contact_name . '" data-bs-CNPJ="' . $Supplier->CNPJ . '"
                                    data-bs-email="' . $Supplier->contact_mail . '" data-bs-phone="' . $Supplier->contact_phone . '" data-bs-address_id="' . $address->id . '"
                                    data-bs-address_street="' . $address->street . '" data-bs-address_no="' . $address->number . '" data-bs-address_complement="' . $address->complement . '"
                                    data-bs-address_district="' . $address->district . '" data-bs-address_city="' . $address->city . '" data-bs-address_state="' . $address->state . '"
                                    data-bs-address_postalcode="' . $address->postalcode . '" data-bs-address_country="' . $address->country . '" data-bs-address_country="' . $address->ref . '">
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