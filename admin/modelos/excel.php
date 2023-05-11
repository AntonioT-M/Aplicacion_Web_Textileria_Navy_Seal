<?php
require '../template/vendor/autoload.php';
require '../class/Modelos.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$op = new Modelos();
$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator('Navy_Seal')
->setTitle('Reporte de Modelos')
->setDescription('Archivo Excel con Modelos registrados');
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(25);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(35);
$spreadsheet->setActiveSheetIndex(0);
$sheet = $spreadsheet->getActiveSheet();
$sheet->getStyle('C3:I4')->getAlignment()->setHorizontal('center');
$sheet->getStyle('C3:I4')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$sheet->getStyle('C4:I4')->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('C4:I4')->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$letras = ["C", "D", "E", "F", "G", "H", "I"];
for($l = 0; count($letras) > $l; $l++){
    $sheet->getStyle($letras[$l]."4")->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->getStyle($letras[$l]."4")->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
}
$sheet->mergeCells('C3:I3');
$sheet->getStyle('C3:I3')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->setCellValue('C3', 'Lista de Modelos');
$sheet->setCellValue('C4', '#');
$sheet->setCellValue('D4', 'Modelo');
$sheet->setCellValue('E4', 'Talla');
$sheet->setCellValue('F4', 'Código');
$sheet->setCellValue('G4', 'Materiales');
$sheet->setCellValue('H4', 'Guia Hilo');
$sheet->setCellValue('I4', 'Sistemas');
$registros = $op->getAll();
$e = 5;
$m = 5;
foreach($registros as $i =>$v){
    $delimiters = array(";",",");
    $replace = str_replace($delimiters, $delimiters[0], $v['materiales']);
    $array = explode($delimiters[0], $replace);
    $arrayM = explode(";", $v['sistemasN']);
    $arrayI = explode(",", $v['guiaHilo']);
    $visualizar = array_combine($array, $arrayI);
    $s = 0;
    for($k = 0; count($array) > $k; $k++){
        $sheet->setCellValue('G'.$m, $array[$k]);
        $sheet->setCellValue('H'.$m, $arrayI[$k]);
        if($arrayM[$k] == '1,2,3,4,5,6,7,8,9'){
            $arrayM[$k] = 'Todos';
        }else if($arrayM[$k] == '2,4,6,8'){
            $arrayM[$k] = 'Pares';
        }else if($arrayM[$k] == '1,3,5,7,9'){
            $arrayM[$k] = 'Nones';
        }else if($arrayM[$k] != ""){
            $temp = $arrayM[$k];
            $arrayM[$k] = 'Especificos:'.$temp;
        }
        $sheet->setCellValue('I'.$m, $arrayM[$k]);
        $m++;
        $s++;
    }
    $sheet->setCellValue('C'.$e, ($i+1));
    $sheet->setCellValue('D'.$e, $v['modelo']);
    $sheet->setCellValue('E'.$e, $v['talla']);
    $sheet->setCellValue('F'.$e, $v['codigo']);
    $sheet->mergeCells('C'.$e.':C'.($e+($s-1)));
    $sheet->mergeCells('D'.$e.':D'.($e+($s-1)));
    $sheet->mergeCells('E'.$e.':E'.($e+($s-1)));
    $sheet->mergeCells('F'.$e.':F'.($e+($s-1)));
    $e = $e+$s;
}
for($i = 5; ($e) > $i; $i++){
    for($l = 0; count($letras) > $l; $l++){
        $sheet->getStyle($letras[$l].$i)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle($letras[$l].$i)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle($letras[$l].$i)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        if($letras[$l] == "G" || $letras[$l] == "H" || $letras[$l] == "I"){
            $sheet->getStyle($letras[$l].$i)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        }
    }
}
$sheet->getStyle('C5:I'.($e-1))->getAlignment()->setHorizontal('center');
$sheet->getStyle('C5:I'.($e-1))->getAlignment()->setVertical('center');
$sheet->getStyle('C5:I'.($e-1))->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    //$writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.ms-excel');
    //header('Content-Disposition: attachment;filename="Reporte.xlsx"');
    //header('Cache-Control: max-age=0');
    //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="reporte modelos.xls"');
    header('Cache-Control: max-age=0');
    $writer = IOFactory::createWriter($spreadsheet, 'Xls');
    $writer->save('php://output');
?>
