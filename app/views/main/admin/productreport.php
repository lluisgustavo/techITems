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
$pdf->Cell(70, 10, 'Nome', 1, 0, "C");
$pdf->Cell(20, 10, 'Categoria', 1, 0, "C");
$pdf->Cell(20, 10,  utf8_decode('Preço Compra'), 1, 0, "C");
$pdf->Cell(20, 10,  utf8_decode('Preço Venda'), 1, 0, "C");
$pdf->Cell(15, 10, 'Estoque', 1, 0, "C"); 
$pdf->Cell(40, 10, 'Fornecedor', 1, 0, "C"); 

$pdf->Ln();

foreach($dados as $dado){     
    $x = $pdf->GetX(); 
    $pdf->myCell(5, $h, $x, 10, utf8_decode($dado->id));
    $x = $pdf->GetX(); 
    $pdf->myCell(70, $h, $x, 55, utf8_decode($dado->title));
    $x = $pdf->GetX(); 
    $pdf->myCell(20, $h, $x, 10, utf8_decode($dado->category));
    $x = $pdf->GetX(); 
    $pdf->myCell(20, $h, $x, 10, utf8_decode('R$' . number_format($dado->price_buy, 2, ',', '.')));
    $x = $pdf->GetX(); 
    $pdf->myCell(20, $h, $x, 10, utf8_decode('R$' . number_format($dado->price_sell, 2, ',', '.')));
    $x = $pdf->GetX(); 
    $pdf->myCell(15, $h, $x, 30, utf8_decode($dado->quantity));
    $x = $pdf->GetX(); 
    $pdf->myCell(40, $h, $x, 30, utf8_decode($dado->Fornecedor));
    $pdf->Ln();
} 

$pdf->Output();