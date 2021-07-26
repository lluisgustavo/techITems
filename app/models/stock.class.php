<?php 

Class Stock{
    public function create($data, $files, $imageClass = null){
        $_SESSION['error'] = "";
        $db = Database::newInstance();
        $arr['title'] = ucwords($data->title);
        $arr['description'] = ucwords($data->description); 
        $arr['category'] = ucwords($data->category);
        $arr['price'] = ucwords($data->price);
        $arr['date'] = date("Y-m-d H:i:s");

        $arr['user_url'] = $_SESSION['user_url'];
  
        if(!is_numeric($arr['category'])){
            $_SESSION['error'] .= "Digite uma categoria válida";
        }

        if(!is_numeric($arr['price'])){
            $_SESSION['error'] .= "Digite um preço válido";
        }

        $arr_slug['slug'] = $arr['slug'];  
        $sqlInsertProduct = "SELECT * FROM tb_products WHERE slug = :slug";
        $check = $db->read($sqlInsertProduct, $arr_slug);

        if($check){
            $arr['slug'] .= "-" . rand(0,99999);
        } 

        $arr['image_1'] = "";
        $arr['image_2'] = "";
        $arr['image_3'] = "";
        $arr['image_4'] = "";

        $size = (5 * 1024 * 1024);
        $allowed[] = "image/jpeg";
        $allowed[] = "image/png";
        $allowed[] = "image/gif";
        $folder = "uploads/";

        if(!file_exists($folder)){
            mkdir($folder, 0777, true); 
        }

        foreach($_FILES as $key => $img_row){
            if($img_row['error'] == 0 && in_array($img_row['type'], $allowed)){
                if($img_row['size'] < $size){
                    $destination = $folder . $img_row['name'];
                    move_uploaded_file($img_row['tmp_name'], $destination);
                    $arr[$key] = $destination;

                    //$imageClass->resize_image($destination, $destination, 1000, 1000);
                } else {
                    $_SESSION['error'] .= "Imagem " . $key .  " é maior do que o tamanho permitido.";
                }
            }
        } 

        if(!isset($_SESSION['error']) || $_SESSION['error'] == ""){
            $sqlInsertProduct = "INSERT INTO products (title, description, category, price, slug, date, user_url, image, image2, image3, image4) VALUES (:title, :description, :category, :price, :slug, :date, :user_url, :image_1, :image_2, :image_3, :image_4)";
            $check = $db->write($sqlInsertProduct, $arr); 

            if($check){
                return true;
            }
        }

        return false;
    }

    public function readAll($data = ""){
        $db = Database::newInstance();
        return $db->read("SELECT * FROM tb_products ORDER BY description ASC");
    }

    public function readOne($id){
        $db = Database::newInstance(); 
        $arr['id'] = $id;
        return $db->read("SELECT * FROM tb_products WHERE id = :id ORDER BY description ASC", $arr);
    }

    public function update($data, $files, $imageClass = null){
        $db = Database::newInstance();
        $arr['user_url'] = $_SESSION['user_url'];
        $arr['id'] = $data->id;
        $arr['title'] = $data->title;
        $arr['description'] = $data->description; 
        $arr['category'] = $data->category;
        $arr['price'] = $data->price;  
        $_SESSION['error'] = "";
 
        if(!is_numeric($arr['category'])){
            $_SESSION['error'] .= "Digite uma categoria válida";
        }

        if(!is_numeric($arr['price'])){
            $_SESSION['error'] .= "Digite um preço válido";
        }
       
        $arr_slug['slug'] = $arr['slug'];
        $sqlCheckSlugExists = "SELECT * FROM tb_products WHERE slug = ':slug'"; 
        $check = $db->read($sqlCheckSlugExists, $arr_slug);

        if($check){
            $arr['slug'] .= "-" . rand(0,99999);
        } 

        $size = (5 * 1024 * 1024);
        $allowed[] = "image/jpeg";
        $allowed[] = "image/png";
        $allowed[] = "image/gif";
        $folder = "uploads/";

        if(!file_exists($folder)){
            mkdir($folder, 0777, true);
        }

        $img_string = ""; 

        foreach($_FILES as $key => $img_row){
            if($img_row['error'] == 0 && in_array($img_row['type'], $allowed)){
                if($img_row['size'] < $size){
                    $destination = $folder . $img_row['name'];
                    move_uploaded_file($img_row['tmp_name'], $destination);
                    $arr[$key] = $destination; 
                    if(ltrim($key, 'image_') == 1) { 
                        $img_string .= ', image = :' . $key;
                    } else { 
                        $img_string .= ', image' . ltrim($key, 'image_') . ' = :' . $key;
                    }
                } else {
                    $_SESSION['error'] .= "Imagem " . $key .  " é maior do que o tamanho permitido.";
                }
            }
        } 

        $sqlArguments = '';

        foreach($arr as $key => $column){  
            if($key != "image_1" && $key != "image_2" && $key != "image_3" && $key != "image_4"){
                $sqlArguments .= ($key == 'user_url') ? $key . ' = :' . $key : ', ' . $key . ' = :' . $key; 
            }
        }
 
        if(!isset($_SESSION['error']) || $_SESSION['error'] == ""){ 
            $sqlUpdateProduct = "UPDATE tb_products SET " . $sqlArguments . $img_string . " WHERE id = :id"; 
            $check = $db->write($sqlUpdateProduct, $arr);
        
            if($check){
                return true;
            }
        }

        return false;

    }

    public function delete($id){ 
        $db = Database::newInstance();
        $id = (int)$id;
        $sqlDeleteProduct = "DELETE FROM tb_products WHERE id = '$id' LIMIT 1";
        return $db->write($sqlDeleteProduct);
    }

    public function make_table($stocks, $model = null){
        $result = "";
        if(is_array($stocks)){ 
            foreach($stocks as $Stock){   
                $result .= '<tr> 
                                <td>' . $Stock->title . '</a></td>
                                <td class="text-right">' . $Stock->quantity . '</a></td>
                                <td>   
                                    <button onclick="addStock(' . $Stock->product_id . ')" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>
                                    <button onclick="removeStock(' . $Stock->product_id . ')" class="btn btn-sm btn-danger"><i class="fa fa-minus"></i></button>
                                </td>
                            </tr>'; 
            }
        }

        return $result;
    } 
}