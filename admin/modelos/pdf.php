<?php
//require '../template/vendor/autoload.php';
require '../class/Modelos.php';
require '../template/lib/phpqrcode/qrlib.php';
require('../template/lib/fpdf182/fpdf.php');

QRcode::png('http://192.168.0.101/sitios/navy_seal/admin/modelos/pdf.php','qr/RMOD.png');


/*A4 width : 219mm*/
$op = new Modelos();
$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();
/*output the result*/

/*set font to arial, bold, 14pt*/
$pdf->SetFont('Arial','B',15);

/*Cell(width , height , text , border , end line , [align] )*/

$pdf->Cell(71 ,10,'',0,0);
$pdf->Cell(59 ,5,'Lista de Modelos',0,0);
$pdf->Cell(59 ,10,'',0,1);


$pdf->SetFont('Arial','',8);

$pdf->Image('../template/images/NavySeal.jpg',10,15,25);
$pdf->Image('qr/RMOD.png',170,14,30);

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
$pdf->Cell(25,6,'',0,0,'C');
$pdf->Cell(10 ,6,'#',1,0,'C');
$pdf->Cell(20 ,6,'Imagen',1,0,'C');
$pdf->Cell(40 ,6,'Modelo',1,0,'C');
$pdf->Cell(30 ,6,'Talla',1,0,'C');
$pdf->Cell(30 ,6,'Codigo',1,1,'C');/*end of line*/
/*Heading Of the table end*/
/*Content*/
$registros = $op->getAll();
$img = 56;
$num = 25;
$r = 0;
$s = 0;
$pdf->SetFont('Arial','',10);
    foreach($registros as $i =>$v){
		$delimiters = array(";",",");
		//$delimiters2 = array(";");
		$replace = str_replace($delimiters, $delimiters[0], $v['materiales']);
		$array = explode($delimiters[0], $replace);
		/*$replace2 = str_replace($delimiters2, $delimiters2[0], $v['sistemasN']);
		$array2 = explode($delimiters2[0], $replace2);*/
		$arrayM = explode(";", $v['sistemasN']);
		$arrayI = explode(",", $v['guiaHilo']);			
		$visualizar = array_combine($array, $arrayI);
		for($y = 0; count($array) > $y; $y++){
			$num=$num+10;
		}
		$pdf->Cell(25,6,'',0,0,'C');
        $pdf->Cell(10 ,$num,($i+1),1,0,'C');
		$pdf->Cell(20 ,20,$pdf->Image($v['imgModelo'], 45, $img, 20, 20),1,0,'C');
		$pdf->Cell(40 ,20,$v['modelo'],1,0,'C');
		$pdf->Cell(30 ,20,$v['talla'],1,0,'C');
		$pdf->Cell(30,20,$v['codigo'],1,1,'C');
		$pdf->Cell(35,5,'',0,0,'C');
		$pdf->Cell(40,5,'Materiales',1,0,'C');
		$pdf->Cell(20,5,'Guia Hilo',1,0,'C');
		$pdf->Cell(60,5,'Sistemas',1,1,'C');
		$img = $img+$num+(6+10);
		$num = 25;
		$r++;
		$s++;
		for($i = 0; count($array) > $i; $i++){
			$pdf->Cell(35,10,'',0,0,'C');
			$pdf->Cell(40,10,$array[$i],1,0,'C');
			$pdf->Cell(20,10,$arrayI[$i],1,0,'C');
			if($arrayM[$i] == '1,2,3,4,5,6,7,8,9'){
				$arrayM[$i] = 'Todos';
			}else if($arrayM[$i] == '2,4,6,8'){
				$arrayM[$i] = 'Pares';
			}else if($arrayM[$i] == '1,3,5,7,9'){
				$arrayM[$i] = 'Nones';
			}else if($arrayM[$i] != ""){
				$temp = $arrayM[$i];
				$arrayM[$i] = 'Especificos:'.$temp;
			}
			$pdf->Cell(60,10,$arrayM[$i],1,1,'C');
		}
		if($r != count($registros)){
			if($s > 2){
				//$pdf->SetY(-5);
    			//$pdf->Cell(0,10,'Pagina '.$pdf->PageNo(),0,0,'C');
				$pdf->AddPage();
				$s = 0;
				$img = 26;
			}
			$pdf->Ln();
			$pdf->Cell(25,6,'',0,0,'C');
			$pdf->Cell(10 ,6,'#',1,0,'C');
			$pdf->Cell(20 ,6,'Imagen',1,0,'C');
			$pdf->Cell(40 ,6,'Modelo',1,0,'C');
			$pdf->Cell(30 ,6,'Talla',1,0,'C');
			$pdf->Cell(30 ,6,'Codigo',1,1,'C');
		}
    }
    
$pdf->Output('','Reporte Modelos.pdf', false);
?>