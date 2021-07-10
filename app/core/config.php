<?php

define('WEBSITE_TITLE', 'techITems');

//DATABASE INFO
define('DB_NAME', 'luisde64_techitems');
define('DB_USER', 'luisde64_techADM');
define('DB_PASS', '5GfB{E8{#-eQ');
define('DB_HOST', 'br994.hostgator.com.br');
define('DB_TYPE', 'mysql');

define('THEME', 'main/');
define('DEBUG', true);

if(DEBUG){
    ini_set('display_errors', 1);
}else{
    ini_set('display_errors', 0);
}