<?php

Class Product extends Controller{
    public function index($slug){
        $slug = (string) esc($slug);
        $User = $this->load_model('User');
        $category = $this->load_model("Category");  
        $user_data = $User->check_login();

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $DB = Database::newInstance();

        $arr['slug'] =  $slug;
        $row = $DB->read("SELECT * FROM products WHERE slug = :slug", $arr); 

        $data['productCategory'] = $category->getOne($row[0]->category); 
        if(!empty($data['productCategory']->parent)) {$data['parentCategory'] = $category->getOne($data['productCategory']->parent);}
        $data['page_title'] = "Produto"; 
        $data['row'] = is_array($row) ? $row[0] : false;
 
        $this->view('product', $data);
    }
}
  