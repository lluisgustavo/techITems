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
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190, 10, utf8_decode($page_title), 0, 0, "C");
$pdf->Ln(15);

  
$w = 45;
$h = 16;

$pdf->Cell(10, 10, 'ID', 1, 0, "C");
$pdf->Cell(60, 10, 'Nome', 1, 0, "C");
$pdf->Cell(40, 10, 'CPF', 1, 0, "C");
$pdf->Cell(30, 10, 'Telefone', 1, 0, "C");
$pdf->Cell(50, 10, 'Data de Nascimento', 1, 0, "C"); 

$pdf->Ln();

foreach($dados as $dado){     
    $x = $pdf->GetX(); 
    $pdf->myCell(10, $h, $x, 10, utf8_decode($dado->ID));
    $x = $pdf->GetX(); 
    $pdf->myCell(60, $h, $x, 25, utf8_decode($dado->Nome));
    $x = $pdf->GetX(); 
    $pdf->myCell(40, $h, $x, 10, utf8_decode($dado->CPF));
    $x = $pdf->GetX(); 
    $pdf->myCell(30, $h, $x, 10, utf8_decode($dado->Telefone));
    $x = $pdf->GetX(); 
    $pdf->myCell(50, $h, $x, 10, date('d-m-Y',  strtotime($dado->birth)));
    $pdf->Ln();
} 

$pdf->Output();