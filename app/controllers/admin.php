<?php

Class Admin extends Controller{
    public function index(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $data['productObject'] = $this->load_model("Product");
        $data['page_title'] = "Painel de Controle";
        $this->view('admin/index', $data);
    }

    public function categories(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();
        $categories = $db->read("SELECT * FROM categories ORDER BY category ASC");

        $category = $this->load_model("Category");
        $tableRows = $category->make_table($categories);

        $selectCategories = $category->make_select_parent($categories);
        $data['dropdownCategories'] = $selectCategories;

        $selectEditCategories = $category->make_select_edit_category($categories);
        $data['dropdownEditCategories'] = $selectEditCategories;

        $data['tableRows'] = $tableRows;

        $data['page_title'] = "Categorias";
        $this->view('admin/categories', $data);
    }

    public function products(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();
        $products = $db->read("SELECT * FROM products ORDER BY description ASC");
        $product = $this->load_model("Product");
        $categories = $db->read("SELECT * FROM categories where status = 1 ORDER BY category ASC");
        $category = $this->load_model("Category");

        $tableRows = $product->make_table($products, $category);

        $selectCategories = $category->make_select($categories);
        $allCategories = $db->read("SELECT * FROM categories ORDER BY category ASC");
        $selectEditCategories = $category->make_select_edit_product($allCategories);
        $data['dropdownEditCategories'] = $selectEditCategories;

        $data['tableRows'] = $tableRows;
        $data['dropdownCategories'] = $selectCategories;

        $data['page_title'] = "Produtos";
        $this->view('admin/products', $data);
    }

    public function suppliers(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();
        $suppliers = $db->read("SELECT * FROM suppliers ORDER BY id ASC");
        $supplier = $this->load_model("Supplier"); 
        $adresses = $db->read("SELECT * FROM address ORDER BY id ASC"); 
        $address = $this->load_model("Address");

        $tableRows = $supplier->make_table($suppliers, $address); 

        $data['tableRows'] = $tableRows; 
        $data['page_title'] = "Fornecedores";
        $this->view('admin/suppliers', $data);
    }
}