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

$pdf->Cell(10, 10, 'ID', 1, 0, "C");
$pdf->Cell(120, 10, 'Nome', 1, 0, "C");
$pdf->Cell(20, 10, 'Movimento', 1, 0, "C"); 
$pdf->Cell(30, 10, 'Data', 1, 0, "C"); 

$pdf->Ln();

foreach($dados as $dado){     
    $x = $pdf->GetX(); 
    $pdf->myCell(10, $h, $x, 10, utf8_decode($dado->id));
    $x = $pdf->GetX(); 
    $pdf->myCell(120, $h, $x, 100, utf8_decode($dado->title));
    $x = $pdf->GetX(); 
    $pdf->myCell(20, $h, $x, 10, utf8_decode($dado->movement)); 
    $x = $pdf->GetX(); 
    $pdf->myCell(30, $h, $x, 10, date('d-m-Y H:i:s',  strtotime($dado->created_at)));
    $pdf->Ln();
} 

$pdf->Output();