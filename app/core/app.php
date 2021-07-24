<?php

Class App{
    protected $controller = "home";
    protected $method = "index";
    protected $params;

    public function __construct(){ 
        //$this->hsts(); 
        $url = $this->parseURL();  
        if(file_exists("../app/controllers/" . strtolower($url[0]) . ".php")){
            $this->controller = strtolower($url[0]); 
            unset($url[0]);
        } 
    
        require "../app/controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller;

        if(isset($url[1])){
            $url[1] = strtolower($url[1]);
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = (count($url) > 0) ? $url : ["home"];
        
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseURL(){
        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        return explode('/', filter_var(trim($url, "/"), FILTER_SANITIZE_URL));
    }

    public function hsts() {
        //If the HTTPS is not found to be "on"
        if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
        {
            //Tell the browser to redirect to the HTTPS URL.
            header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
            //Prevent the rest of the script from executing.
            exit;
        }
    }
}