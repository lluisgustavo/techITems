<?php

Class SignUp extends Controller{
    public function index(){
        $data['page_title'] = "Registre-se";

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $user = $this->load_model('User');
            $user->signUp($_POST);
        }
        $this->view('signup', $data);
    }
}