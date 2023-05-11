<?php
//require '../template/vendor/autoload.php';
require '../class/Clientes.php';
require '../template/lib/phpqrcode/qrlib.php';
require('../template/lib/fpdf182/fpdf.php');

QRcode::png('http://192.168.0.101/sitios/navy_seal/admin/clientes/pdf.php','qr/RC.png');


/*A4 width : 219mm*/
$op = new Clientes();
$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();
/*output the result*/

/*set font to arial, bold, 14pt*/
$pdf->SetFont('Arial','B',15);

/*Cell(width , height , text , border , end line , [align] )*/

$pdf->Cell(71 ,10,'',0,0);
$pdf->Cell(59 ,5,'Lista de Clientes',0,0);
$pdf->Cell(59 ,10,'',0,1);


$pdf->SetFont('Arial','',8);

$pdf->Image('../template/images/NavySeal.jpg',10,15,25);
$pdf->Image('qr/RC.png',170,14,30);

$pdf->Cell(25 ,0,'',0,0);
$pdf->Cell(40,5,'Navy Seal S. de R.L. de C.V',0,0);
$pdf->Cell(10 ,5,'',0,1);

$pdf->Cell(25 ,0,'',0,0);
$pdf->Cell(40,5,'Area: Tejido Seamless',0,0);
$pdf->Cell(10 ,5,'',0,1);

$pdf->Cell(25 ,0,'',0,0);
$pdf->Cell(40,5,date("d/m/Y"),0,0);
$pdf->Cell(10 ,5,'',0,1);

$pdf->Cell(10 ,5,'',0,1);


$pdf->Cell(50 ,10,'',0,1);

$pdf->SetFont('Arial','B',10);
/*Heading Of the table*/
$pdf->Cell(5 ,6,'',0,0,'C');
$pdf->Cell(10 ,6,'#',1,0,'C');
$pdf->Cell(60 ,6,'Nombre',1,0,'C');
$pdf->Cell(80 ,6,'Razon social',1,0,'C');
$pdf->Cell(32 ,6,'Tipo',1,1,'C');;/*end of line*/
/*Heading Of the table end*/
/*Content*/
$registros = $op->getAll();
$e = 5;
$pdf->SetFont('Arial','',10);
    foreach($registros as $i =>$v){
        $pdf->Cell(5 ,6,'',0,0,'C');
        $pdf->Cell(10 ,6,($i+1),1,0,'C');
		$pdf->Cell(60 ,6,$v['nombreC'],1,0,'C');
		$pdf->Cell(80 ,6,$v['rSocial'],1,0,'C');
		$pdf->Cell(32 ,6,$v['tipo'],1,1,'C');
    }
    
$pdf->Output('','Reporte Clientes.pdf', false);
?>