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
 
        $this->view('index', $data); 
        
    }
}