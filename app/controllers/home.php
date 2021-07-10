<?php

Class Home extends Controller{
    public function index(){
        $User = $this->load_model('User');
        $category = $this->load_model("Category");  
        $user_data = $User->check_login();

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }
 
        $data['page_title'] = "techITems";

        $DB = Database::newInstance();

        $rows = $DB->read("select * from products"); 
 
        $result = "";

        if(is_array($rows)){
            foreach($rows as $key => $row){  
                $rows[$key]->writtenCat = $category->getOne($row->category)->category; 
                $result .= '<div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <div class="overflow-hidden">
                                                <a href="' . ROOT . 'product/' . $row->slug . '">
                                                <img class="product-image style="max-height: 200px; width: auto" src="' . ROOT . $row->image . '" alt="" />
                                                </a>
                                            </div>
                                            <h2>R$' . $row->price . '</h2>
                                            <p>' . $row->description . '</p>
                                            <a href="#" class= "btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Adicionar ao carrinho</a>
                                        </div> 
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Adicionar a sua lista de desejos :)</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Comparar</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>';
            } 
        }
  
        $data[ 'rows'] = $rows;
        $data['products_show'] = $result;  
 
        $this->view('index', $data); 
        
    }
}