<?php

Class AjaxProduct extends Controller{
    public function index(){
        //$data = file_get_contents("php://input");
		if(count($_POST) > 0){
            $data = (object)$_POST;
       }else{
            $data = file_get_contents("php://input");
            $data = json_decode($data);
       } 

 
        if(is_object($data) && isset($data->data_type)){
            $db = Database::newInstance();
            $product = $this->load_model('Product');
            $category = $this->load_model('Category');
            $imageClass = $this->load_model('Image');

            if($data->data_type == "add-product"){
                $check = $product->create($data, $_FILES, $imageClass); 

                if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
                    $arr['message'] = $_SESSION['error'];
                    $_SESSION['error'] = "";
                    $arr['message_type'] = "error";
                    $arr['data'] = "";
                    $arr['data_type'] = "add-new";

                    echo json_encode($arr);
                } else {
                    $arr['message'] = "Produto adicionado.";
                    $arr['message_type'] = "info";
                    $arr['data_type'] = "add-new";
                    $products = $product->readAll();
                    $arr['data'] = $product->make_table($products, $category);

                    echo json_encode($arr);
                }
            } else if($data->data_type == "delete-row"){
                show('a');
                $product->delete($data->id);

                $arr['message'] = "Produto deletado.";
                $arr['message_type'] = "info";
                $arr['data_type'] = "delete-row";

                $products = $product->readAll();
                $arr['data'] = $product->make_table($products);

                echo 'a';//json_encode($arr);
            } else if($data->data_type == "toggle-status"){
                $id = $data->id;
                $sqlStatusUpdate = "UPDATE tb_products SET status = IF(status = 1, 0, 1) WHERE id = '$id' LIMIT 1";
                $db->write($sqlStatusUpdate);
                
                $arr['message_type'] = "info";
                $arr['data_type'] = "toggle-status";

                $products = $product->readAll();
                $arr['data'] = $product->make_table($products);

                echo json_encode($arr);
            } else if($data->data_type == "edit-product"){
                $id = $data->id;
               
                $product->update($data, $_FILES, $imageClass);
 
                $arr['message'] = "Produto editado.";
                $arr['message_type'] = "info";
                $arr['data_type'] = "edit-product";
                $arr['id'] = $data->id;
                if(isset($data->product)) $arr['product'] = $data->product;
                if(isset($data->description)) $arr['description'] = $data->description;

                $products = $product->readAll();
                $arr['data'] = $product->make_table($products, $category);

                echo json_encode($arr);
            }
        }
    }
}