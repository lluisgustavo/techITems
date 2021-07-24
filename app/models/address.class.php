<?php 

Class Address{
    public function create($data){
        $_SESSION['error'] = "";
        $db = Database::newInstance();
        $arr['street'] = ucwords($data->title);
        $arr['number'] = ucwords($data->description);
        $arr['complement'] = ucwords($data->quantity);
        $arr['district'] = ucwords($data->category);
        $arr['city'] = ucwords($data->price);
        $arr['state'] = date("Y-m-d H:i:s");
        $arr['postalcode'] = date("Y-m-d H:i:s");
        $arr['country'] = date("Y-m-d H:i:s");
        $arr['ref'] = date("Y-m-d H:i:s");
        
        if(!empty($data->slug)){ 
            $arr['slug'] = $data->slug;
        } else {
            $arr['slug'] = $this->str_to_url($data->title); 
        }
        $arr['user_url'] = $_SESSION['user_url'];
 
        if(!is_numeric($arr['quantity'])){
            $_SESSION['error'] .= "Digite uma quantidade válida";
        }

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
            $sqlInsertProduct = "INSERT INTO products (title, description, quantity, category, price, slug, date, user_url, image, image2, image3, image4) VALUES (:title, :description, :quantity, :category, :price, :slug, :date, :user_url, :image_1, :image_2, :image_3, :image_4)";
            $check = $db->write($sqlInsertProduct, $arr);

            if($check){
                return true;
            }
        }

        return false;
    }

    public function readAll($data = ""){
        $db = Database::newInstance();
        return $db->read("SELECT * FROM tb_address ORDER BY id ASC");
    }

    public function update($data){
        $db = Database::newInstance();
        $arr['user_url'] = $_SESSION['user_url'];
        $arr['id'] = $data->id;
        $arr['title'] = $data->title;
        $arr['description'] = $data->description;
        $arr['quantity'] = $data->quantity; 
        $arr['category'] = $data->category;
        $arr['price'] = $data->price;  
        $_SESSION['error'] = "";

        if(isset($data->slug)){ 
            $arr['slug'] = $data->slug;
        } else {
            $arr['slug'] = $this->str_to_url($data->description); 
        }

        if(!is_numeric($arr['quantity'])){
            $_SESSION['error'] .= "Digite uma quantidade válida";
        }

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

    public function getOne($id){
        $id = (int)$id;
        $db = Database::newInstance(); 

        $arr['id'] = $id;
        $sqlGetOne = "SELECT * FROM tb_address WHERE id = :id LIMIT 1";
        $address = $db->read($sqlGetOne, $arr);  
        if($address) return $address[0];
        return ""; 
    }

    /*public function make_table($products, $model = null){
        $result = "";
        if(is_array($products)){ 
            foreach($products as $Product){ 
                if(null !== $model->getOne($Product->category) && is_object($model->getOne($Product->category))) {
                    $categoryColumn = $model->getOne($Product->category)->category;
                }else{
                    $categoryColumn = "";
                }   

                $empty = "''";
                $result .= '<tr> 
                                <td class="text-right">' . $Product->id . '</td>
                                <td>' . $Product->title . '</a></td>
                                <td>' . $Product->description . '</a></td>
                                <td style="width:100px; height:100px"> 
                                    <div id="slider-carousel-product-'. $Product->id . '" class="justify-content-center carousel carousel-dark slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active"> 
                                                <img style="max-height: 100px" class="w-100" src="' . ROOT . $Product->image . '" alt=""> 
                                            </div>'; 
 
                                            if(!empty($Product->image2)):
                                                $result .= '<div class="carousel-item">
                                                    <img style="max-height: 100px" class="w-100" src="' . ROOT . $Product->image2 . '" alt="">
                                                </div>';
                                            endif;
                                            if(!empty($Product->image3)): 
                                                $result .= '<div class="carousel-item">
                                                    <img style="max-height: 100px;" class="w-100" src="' . ROOT . $Product->image3 . '" alt="">
                                                </div>';
                                            endif;
                                            if(!empty($Product->image4)): 
                                                $result .= '<div class="carousel-item">
                                                    <img style="max-height: 100px" class="w-100" src="' . ROOT . $Product->image4 . '" alt="">
                                                </div>';
                                            endif;
                                        $result .= '</div>';
                                        
                                        if(!empty($Product->image2) || !empty($Product->image3) || !empty($Product->image4)):
                                            $result .= '<button class="carousel-control-prev" type="button" data-bs-target="#slider-carousel-product-'. $Product->id . '" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Anterior</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#slider-carousel-product-'. $Product->id . '" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Próximo</span>
                                            </button>';
                                        endif;
                                    $result .= '</div>
                                </td>
                                <td class="text-right">' . $Product->quantity . '</td>
                                <td class="text-right">' . $categoryColumn .  '</td>
                                <td class="text-right"> R$ ' . $Product->price . '</td>
                                <td class="text-right">' . date("d/m/Y H:i:s", strtotime($Product->date)) . '</td>';
                
                ($Product->status == 1) ? $result .= '<td><span style="cursor: pointer" onclick="toggleStatus(' . $Product->id . ')" class="badge rounded-pill bg-success">Ativo</span></td>' : $result .= '<td><span style="cursor: pointer" onclick="toggleStatus(' . $Product->id . ')" class="badge rounded-pill bg-warning text-dark">Inativo</span></td>';
                 
                $result .= '<td>  
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit-product" 
                                    data-bs-id="' . $Product->id . '" data-bs-title="' . $Product->title . '" data-bs-description="' . $Product->description . '" data-bs-quantity="' . $Product->quantity . '"
                                    data-bs-price="' . $Product->price . '" data-bs-category="' . $Product->category . '" data-bs-slug="' . $Product->slug . '"
                                    data-bs-image="' . $Product->image . '"';
                                    if(!empty($Product->image2)) $result .= ' data-bs-image2="' . $Product->image2 . '"'; 
                                    if(!empty($Product->image3)) $result .= ' data-bs-image3="' . $Product->image3 . '"'; 
                                    if(!empty($Product->image4)) $result .= ' data-bs-image4="' . $Product->image4 . '"'; 
                                    $result .= '><i class="fa fa-pencil"></i>
                                </button>
                                <button onclick="deleteRow(' . $Product->id . ')" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>'; 
            }
        }

        return $result;
    } */
}