<?php

function show($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function check_error(){
    if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
}

function esc($data){
    return addslashes($data);
}

function replace_spaces_with_dashes($string) { 
    $string = str_replace(" ", "-", $string);
    return $string; 
}