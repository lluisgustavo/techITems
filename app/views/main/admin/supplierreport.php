<?php   

$pathToFPDF = $_SERVER['DOCUMENT_ROOT'] . '\techitems\public\fpdf\fpdf.php'; 
require_once($pathToFPDF);
 

class MyPDF extends FPDF{
    function myCell($w, $h, $x, $thLen, $t){ 
        $height = $h/3;
        $first = $height + 2; 
        $second = $height + $height + $height + 3;
        $len = strlen($t);
    
        if($len > $thLen){
            $txt = str_split($t, $thLen);
            $this->SetX($x);
            $this->Cell($w, $first, $txt[0], '', '', '');
            $this->SetX($x);
            $this->Cell($w, $first, $txt[0], '', '', '');
            $this->SetX($x);
            $this->Cell($w, $h, '', 'LTRB', 0, 'L', 0);
        } else {
            $this->SetX($x);
            $this->Cell($w, $h, $t, 'LTRB', 0, 'L', 0);
        }
    } 

}

$pdf = new MyPDF; 
$pdf->AddPage('o');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(190, 10, utf8_decode($page_title), 0, 0, "C");
$pdf->Ln(15);

  
$w = 45;
$h = 16;

$pdf->Cell(5, 10, 'ID', 1, 0, "C");
$pdf->Cell(90, 10, 'Fornecedor', 1, 0, "C");
$pdf->Cell(40, 10, 'CNPJ', 1, 0, "C");
$pdf->Cell(30, 10, 'Contato', 1, 0, "C");
$pdf->Cell(60, 10, 'Email', 1, 0, "C"); 
$pdf->Cell(50, 10, 'Telefone', 1, 0, "C"); 

$pdf->Ln();

foreach($dados as $dado){     
    $x = $pdf->GetX(); 
    $pdf->myCell(5, $h, $x, 10, utf8_decode($dado->id));
    $x = $pdf->GetX(); 
    $pdf->myCell(90, $h, $x, 50, utf8_decode($dado->supplier_name));
    $x = $pdf->GetX(); 
    $pdf->myCell(40, $h, $x, 20, utf8_decode($dado->CNPJ));
    $x = $pdf->GetX(); 
    $pdf->myCell(30, $h, $x, 10, utf8_decode($dado->contact_name));
    $x = $pdf->GetX(); 
    $pdf->myCell(60, $h, $x, 30, utf8_decode($dado->contact_mail));
    $x = $pdf->GetX(); 
    $pdf->myCell(50, $h, $x, 16, utf8_decode($dado->contact_phone));
    $pdf->Ln();
} 

$pdf->Output();