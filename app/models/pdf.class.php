<?php
require "vendor\setasign\fpdf\fpdf.php";

Class PDF extends FPDF{
    function header(){
        $this->Image('../../public/assets/main/images/logo.png', 10, 6);
    }
}