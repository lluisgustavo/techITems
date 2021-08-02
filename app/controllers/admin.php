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
        $brands = $db->read("SELECT * FROM tb_brands ORDER BY brand_name ASC");

        $brand = $this->load_model("Brand");
        $tableRows = $brand->make_table($brands); 
        $data['tableRows'] = $tableRows;

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
        $products = $db->read("SELECT p.*, b.brand_name, b.status, s.supplier_name FROM `tb_products` as p
                                INNER JOIN tb_brands b ON p.brand_id = b.id
                                INNER JOIN tb_suppliers s ON p.supplier_id = s.id
                                ORDER BY p.title");
        $product = $this->load_model("Product"); 
        $category = $this->load_model("Category");

        $tableRows = $product->make_table($products, $category);

        $allBrands = $db->read("SELECT b.id, b.brand_name FROM tb_brands AS b ORDER BY brand_name ASC");
        $allCategories = $db->read("SELECT c.id, c.category FROM tb_categories AS c ORDER BY category ASC");
        $allSuppliers = $db->read("SELECT s.id, s.supplier_name FROM tb_suppliers AS s ORDER BY supplier_name ASC");
        $selectCategories = $product->make_select_category($allCategories);
        $selectSuppliers = $product->make_select_supplier($allSuppliers);
        $selectBrands = $product->make_select_brand($allBrands);
        $selectEditCategories = $product->make_select_edit_category($allCategories);
        $selectEditSuppliers = $product->make_select_edit_supplier($allSuppliers);
        $selectEditBrands = $product->make_select_edit_brand($allBrands);

        $data['tableRows'] = $tableRows;
        $data['dropdownCategories'] = $selectCategories;
        $data['dropdownSuppliers'] = $selectSuppliers;
        $data['dropdownBrands'] = $selectBrands;
        $data['dropdownEditCategories'] = $selectEditCategories;
        $data['dropdownEditSuppliers'] = $selectEditSuppliers;
        $data['dropdownEditBrands'] = $selectEditBrands;

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
            $sqlOrders = "SELECT o.*, pe.name, op.product_id ,GROUP_CONCAT(CONCAT(p.title, ' x ', op.product_quantity) SEPARATOR '<br>') as products, SUM(p.price_sell * op.product_quantity)as total_value FROM tb_orders o
                            INNER JOIN tb_orders_products op ON op.order_id = o.id
                            INNER JOIN tb_products p ON p.id = op.product_id
                            INNER JOIN tb_customers c ON c.id = o.customer_id
                            INNER JOIN tb_people pe ON pe.id = c.person_id 
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

        $activeProducts = $db->read("SELECT * FROM tb_products WHERE status = 1");

        $stockMovement = $db->read("SELECT p.title, s.id, s.product_id, s.obs, s.movement
                                    FROM tb_products as p
                                    INNER JOIN tb_stock s ON s.product_id = p.id
                                    ORDER BY s.created_at DESC");

        $stockProducts = $db->read("SELECT p.title, SUM(s.movement) as quantity
                                    FROM tb_products as p
                                    INNER JOIN tb_stock s ON s.product_id = p.id 
                                    GROUP BY s.product_id");
        
        $stock = $this->load_model("Stock");   
 
        $tableRowsMovement = $stock->make_table_movement($stockMovement); 
        $tableRowsStock = $stock->make_table_stock($stockProducts); 
        $selectProducts = $stock->make_select_products($activeProducts);
 
        $data['tableRowsMovement'] = $tableRowsMovement;   
        $data['tableRowsStock'] = $tableRowsStock;   
        $data['dropdownProducts'] = $selectProducts;   
        $data['page_title'] = "Estoque";
        $this->view('admin/stock', $data);
    }

    public function users(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance(); 
        $users = $db->read("SELECT * FROM tb_users ORDER BY email ASC");  
        $tableRows = $User->make_table($users); 

        $data['tableRows'] = $tableRows;  
        $data['page_title'] = "Usuários";
        $this->view('admin/users', $data);
    }
    
    public function clients(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance(); 
        $Customer = $this->load_model('Customer');
        $customers = $db->read("SELECT p.*, c.id as customer_id FROM tb_people as p
                             LEFT JOIN tb_customers c ON c.person_id = p.id
                             GROUP BY p.id");  
        $tableRows = $Customer->make_table($customers); 

        $data['tableRows'] = $tableRows;  
        $data['page_title'] = "Clientes";
        $this->view('admin/clients', $data);
    }
    
    public function buy(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin", "employee", "customer"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();
        
        //Only products that have stock and are active and have active categories
        $products = $db->read("SELECT p.id, p.title, p.description, p.price_sell, p.image, p.image2, p.image3, p.image4, p.status, b.brand_name, c.category, c.parent, SUM(s.movement) as quantity FROM tb_products AS p
                                    INNER JOIN tb_stock s ON s.product_id = p.id
                                    INNER JOIN tb_categories c ON p.category = c.id
                                    INNER JOIN tb_brands b ON p.brand_id = b.id
                                    WHERE p.status = 1
                                    AND c.status = 1
                                    GROUP BY p.id
                                    ORDER BY p.title ASC");
        $product = $this->load_model("Product"); 
        
        //Only active categories that have products that have stock
        $categories = $db->read("SELECT c.id, c.category, c.status, c.parent FROM tb_categories c
                                        INNER JOIN tb_products p ON p.category = c.id
                                        INNER JOIN tb_stock s ON s.product_id = p.id
                                        WHERE c.status = 1 
                                        GROUP BY c.category
                                        ORDER BY c.id ASC"); 
        $category = $this->load_model("Category");

        //$tableRows = $product->make_table($products, $category); 

        $data['pRows'] = $products;   
        $data['cRows'] = $categories;   
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

    public function reports(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin", "employee", "customer"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();
 
        $data['page_title'] = "Relatórios";
        $this->view('admin/reports', $data);
    }

    public function analytics(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin", "employee", "customer"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();
 
        $data['page_title'] = "Google Analytics";
        $this->view('admin/analytics', $data);
    }

    public function customerreport(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin", "employee", "customer"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();
   
        $sql = "SELECT p.id as ID, p.name as Nome, p.CPF, p.phone as Telefone, p.birth FROM tb_people as p
                LEFT JOIN tb_customers c ON c.person_id = p.id
                GROUP BY p.id";
        $data['dados'] = $db->read($sql);
        $data['page_title'] = "Relatório de Clientes";
        $this->view('admin/customerreport', $data);
    }

    public function userreport(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin", "employee", "customer"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();
   
        $sql = "SELECT * FROM tb_users";
        $data['dados'] = $db->read($sql);
        $data['page_title'] = "Relatório de Usuários";
        $this->view('admin/userreport', $data);
    }

    public function stockreport(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin", "employee", "customer"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();
   
        $sql = "SELECT s.id, s.movement, p.title, s.created_at FROM tb_stock as s
                INNER JOIN tb_products as p ON p.id = s.product_id";
        $data['dados'] = $db->read($sql);
        $data['page_title'] = "Relatório do Histórico do Estoque";
        $this->view('admin/stockreport', $data);
    }

    public function supplierreport(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin", "employee", "customer"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();
   
        $sql = "SELECT * FROM tb_suppliers";
        $data['dados'] = $db->read($sql);
        $data['page_title'] = "Relatório de Fornecedores";
        $this->view('admin/supplierreport', $data);
    }

    public function orderreport(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin", "employee", "customer"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();
   
        $sql = "SELECT o.id, p.name, p.phone, op.product_quantity, prod.title, prod.price_sell FROM tb_orders as o
                INNER JOIN tb_customers as c ON o.customer_id = c.id
                INNER JOIN tb_people as p ON p.id = c.person_id
                INNER JOIN tb_orders_products as op ON o.id = op.order_id
                INNER JOIN tb_products as prod ON prod.id = op.product_id";
        $data['dados'] = $db->read($sql);
        $data['page_title'] = "Relatório de Pedidos";
        $this->view('admin/orderreport', $data);
    }

    public function productreport(){
        $User = $this->load_model('User');
        $user_data = $User->check_login(true, ["admin", "employee", "customer"]);

        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $db = Database::newInstance();
   
        $sql = "SELECT p.id, p.title, c.category, p.price_buy, p.price_sell, SUM(s.movement) as quantity, sup.supplier_name as Fornecedor FROM tb_products as p
                INNER JOIN tb_stock as s ON s.product_id = p.id
                INNER JOIN tb_categories as c ON p.category = c.id
                INNER JOIN tb_brands as b ON b.id = p.brand_id
                INNER JOIN tb_suppliers as sup ON sup.id = p.supplier_id
                GROUP BY p.id";
        $data['dados'] = $db->read($sql);
        $data['page_title'] = "Relatório de Produtos";
        $this->view('admin/productreport', $data);
    }
}