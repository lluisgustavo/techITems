<?php

Class Admin extends Controller{
    public function index(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin", "employee", "customer"]); 

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $data['productObject'] = $this->load_model("Product");
        $data['page_title'] = "Painel de Controle";
        $this->view('admin/index', $data);
    }

    public function brands(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin", "employee"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();
        $categories = $db->read("SELECT * FROM tb_categories ORDER BY category ASC");

        $category = $this->load_model("Category");
        $tableRows = $category->make_table($categories);

        /*$selectCategories = $category->make_select_parent($categories);
        $data['dropdownCategories'] = $selectCategories;

        $selectEditCategories = $category->make_select_edit_category($categories);
        $data['dropdownEditCategories'] = $selectEditCategories;

        $data['tableRows'] = $tableRows;*/

        $data['page_title'] = "Marcas";
        $this->view('admin/brands', $data);
    }

    public function categories(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin", "employee"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();
        $categories = $db->read("SELECT * FROM tb_categories ORDER BY category ASC");

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
        $user_data = $User->check_login(true, ["admin", "employee"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();
        $products = $db->read("SELECT * FROM tb_products ORDER BY description ASC");
        $product = $this->load_model("Product");
        $categories = $db->read("SELECT * FROM tb_categories where status = 1 ORDER BY category ASC");
        $category = $this->load_model("Category");

        $tableRows = $product->make_table($products, $category);

        $selectCategories = $category->make_select($categories);
        $allCategories = $db->read("SELECT * FROM tb_categories ORDER BY category ASC");
        $selectEditCategories = $category->make_select_edit_product($allCategories);
        $data['dropdownEditCategories'] = $selectEditCategories;

        $data['tableRows'] = $tableRows;
        $data['dropdownCategories'] = $selectCategories;

        $data['page_title'] = "Produtos";
        $this->view('admin/products', $data);
    }

    public function suppliers(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin", "employee"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance(); 
        $address = $this->load_model("Address");

        $supplier = $this->load_model("Supplier"); 
        $suppliers = $db->read("SELECT * FROM tb_suppliers ORDER BY id ASC");
        $tableRows = $supplier->make_table($suppliers, $address); 

        if($user_data->rank === "employee"){  
            $suppliers = $db->read("SELECT * FROM tb_suppliers WHERE status = 1 ORDER BY id ASC");
            $tableRows = $supplier->make_table_employee($suppliers, $address); 
        }

        $data['tableRows'] = $tableRows; 
        $data['page_title'] = "Fornecedores";
        $this->view('admin/suppliers', $data);
    }
    
    public function orders(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin", "employee", "customer"]); 

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }
  
        $order = $this->load_model("Order");  
        $product = $this->load_model("Product");

        $db = Database::newInstance();
        $arr['customer_id'] = $user_data->id_customer;
        if($user_data->rank === "customer"){  
            $sqlOrders = "SELECT o.*, op.product_id ,GROUP_CONCAT(CONCAT(p.title, ' x ', op.product_quantity) SEPARATOR '<br>') as products, 
                            SUM(p.price_sell * op.product_quantity)as total_value FROM tb_orders o
                            INNER JOIN tb_orders_products op ON op.order_id = o.id
                            INNER JOIN tb_products p ON p.id = op.product_id
                            WHERE o.customer_id = :customer_id
                            GROUP BY o.id
                            ORDER BY o.id ASC";
            $orders = $db->read($sqlOrders, $arr); 
            $tableRows = $order->make_table_customer($orders); 
        } else {
            $sqlOrders = "SELECT o.*, op.product_id ,GROUP_CONCAT(CONCAT(p.title, ' x ', op.product_quantity) SEPARATOR '<br>') as products, 
                            SUM(p.price_sell * op.product_quantity)as total_value FROM tb_orders o
                            INNER JOIN tb_orders_products op ON op.order_id = o.id
                            INNER JOIN tb_products p ON p.id = op.product_id 
                            GROUP BY o.id
                            ORDER BY o.id ASC";
            $orders = $db->read($sqlOrders);
            $tableRows = $order->make_table($orders); 
        }
        

        $data['tableRows'] = $tableRows; 
        if($user_data->rank === "customer"){
            $data['page_title'] = "Meus Pedidos";
        } else {
            $data['page_title'] = "Pedidos";
        }
        $this->view('admin/orders', $data);
    }

    public function stock(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin", "employee"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();  
        $products = $db->read("SELECT * FROM tb_products LIMIT 24");
        $product = $this->load_model("Product");
        $categories = $db->read("SELECT * FROM tb_categories where status = 1 ORDER BY category ASC");
        $category = $this->load_model("Category");

        $stock_quantity = $db->read("SELECT SUM(quantity) as stock_quantity FROM tb_products LIMIT 1"); 
        $tableRows = $product->make_table($products, $category); 

        $data['tableRows'] = $tableRows; 
        $data['stock_quantity'] = $stock_quantity[0]->stock_quantity; 
        $data['rows'] = $products;
        $data['page_title'] = "Estoque";
        $this->view('admin/stock', $data);
    }

    public function users(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::getInstance();
        var_dump($db); 
        $users = $db->read("SELECT * FROM tb_users ORDER BY id ASC");  
        $tableRows = $User->make_table($users); 

        $data['tableRows'] = $tableRows; 
        $data['page_title'] = "Usuários";
        $this->view('admin/users', $data);
    }
    
    public function buy(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin", "employee", "customer"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();
        $products = $db->read("SELECT * FROM tb_products ORDER BY id ASC");
        $product = $this->load_model("Product"); 
        $categories = $db->read("SELECT * FROM tb_categories ORDER BY id ASC"); 
        $category = $this->load_model("Category");

        //$tableRows = $product->make_table($products, $category); 

        $data['rows'] = $products;   
        $data['page_title'] = "Comprar";
        $this->view('admin/buy', $data);
    }

    public function config(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin", "employee", "customer"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();
 
        $data['page_title'] = "Configurações";
        $this->view('admin/config', $data);
    }
}