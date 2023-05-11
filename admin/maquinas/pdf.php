<?php
//require '../template/vendor/autoload.php';
require '../class/Maquinas.php';
require '../template/lib/phpqrcode/qrlib.php';
require('../template/lib/fpdf182/fpdf.php');

QRcode::png('http://192.168.0.101/sitios/navy_seal/admin/maquinas/pdf.php','qr/RMAQ.png');


/*A4 width : 219mm*/
$op = new Maquinas();
$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();
/*output the result*/

/*set font to arial, bold, 14pt*/
$pdf->SetFont('Arial','B',15);

/*Cell(width , height , text , border , end line , [align] )*/

$pdf->Cell(71 ,10,'',0,0);
$pdf->Cell(59 ,5,'Lista de Maquinas',0,0);
$pdf->Cell(59 ,10,'',0,1);


$pdf->SetFont('Arial','',8);

$pdf->Image('../template/images/NavySeal.jpg',10,15,25);
$pdf->Image('qr/RMAQ.png',170,14,30);

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
$pdf->Cell(30 ,6,'Maquina',1,0,'C');
$pdf->Cell(30 ,6,'Modelo',1,0,'C');
$pdf->Cell(72 ,6,'Sistemas',1,0,'C');
$pdf->Cell(40 ,6,'Estado',1,1,'C');;/*end of line*/
/*Heading Of the table end*/
/*Content*/
$registros = $op->getAll();
$e = 5;
$pdf->SetFont('Arial','',10);
    foreach($registros as $i =>$v){
        $pdf->Cell(5 ,6,'',0,0,'C');
        $pdf->Cell(10 ,6,($i+1),1,0,'C');
		$pdf->Cell(30 ,6,$v['maquina'],1,0,'C');
		$pdf->Cell(30 ,6,$v['modelo'],1,0,'C');
        if($v['sistemasT'] == '1,2,3,4,5,6,7,8,9,10'){
            $v['sistemasT'] = 'Todos';
        }else if($v['sistemasT'] == '2,4,6,8,10'){
            $v['sistemasT'] = 'Pares';
        }else if($v['sistemasT'] == '1,3,5,7,9'){
            $v['sistemasT'] = 'Nones';
        }else if($v['sistemasT'] != ""){
            $temp = $v['sistemasT'];
            $v['sistemasT'] = 'Especificos:'.$temp;
        }
        $pdf->Cell(72 ,6,$v['sistemasT'],1,0,'C');
        if($v['estadoM'] == 1){ $v['estadoM']='Perfecto';}else{$v['estadoM']='Detenida';}
        $pdf->Cell(40 ,6,$v['estadoM'],1,1,'C');
    }
    
$pdf->Output('','Reporte Maquinas.pdf', false);
?>