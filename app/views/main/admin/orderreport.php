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
$pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(190, 10, utf8_decode($page_title), 0, 0, "C");
$pdf->Ln(15);

  
$w = 45;
$h = 16;

$pdf->Cell(5, 10, 'ID', 1, 0, "C");
$pdf->Cell(30, 10, 'Nome do Cliente', 1, 0, "C"); 
$pdf->Cell(30, 10, 'Telefone', 1, 0, "C");
$pdf->Cell(60, 10, 'Produto', 1, 0, "C"); 
$pdf->Cell(15, 10, 'Quantidade', 1, 0, "C"); 
$pdf->Cell(25, 10, utf8_decode('Preço'), 1, 0, "C"); 
$pdf->Cell(25, 10, 'Valor Total', 1, 0, "C"); 

$pdf->Ln();

foreach($dados as $dado){      
    $x = $pdf->GetX(); 
    $pdf->myCell(5, $h, $x, 10, utf8_decode($dado->id));
    $x = $pdf->GetX(); 
    $pdf->myCell(30, $h, $x, 25, utf8_decode($dado->name));
    $x = $pdf->GetX(); 
    $pdf->myCell(30, $h, $x, 10, utf8_decode($dado->phone));
    $x = $pdf->GetX(); 
    $pdf->myCell(60, $h, $x, 50, utf8_decode($dado->title));
    $x = $pdf->GetX(); 
    $pdf->myCell(15, $h, $x, 10, utf8_decode($dado->product_quantity));
    $x = $pdf->GetX();  
    $pdf->myCell(25, $h, $x, 10, utf8_decode('R$' . number_format($dado->price_sell, 2, ',', '.')));
    $x = $pdf->GetX();  
    $pdf->myCell(25, $h, $x, 10, utf8_decode('R$' . number_format((float) $dado->price_sell * (int) $dado->product_quantity, 2, ',', '.')));
    $pdf->Ln();
} 

$pdf->Output();