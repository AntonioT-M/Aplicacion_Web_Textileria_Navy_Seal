<?php
require '../template/vendor/autoload.php';
require '../class/Maquinas.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$op = new Maquinas();
$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator('Navy_Seal')
->setTitle('Reporte de Maquinas')
->setDescription('Archivo Excel con Maquinas registradas');
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$spreadsheet->setActiveSheetIndex(0);
$sheet = $spreadsheet->getActiveSheet();
$sheet->getStyle('C3:G4')->getAlignment()->setHorizontal('center');
$sheet->getStyle('C3:G4')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$sheet->getStyle('C4:G4')->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('C4:G4')->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$letras = ["C", "D", "E", "F", "G"];
for($l = 0; count($letras) > $l; $l++){
    $sheet->getStyle($letras[$l]."4")->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->getStyle($letras[$l]."4")->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
}
$sheet->mergeCells('C3:G3');
$sheet->getStyle('C3:G3')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->setCellValue('C3', 'Lista de Maquinas');
$sheet->setCellValue('C4', '#');
$sheet->setCellValue('D4', 'Maquina');
$sheet->setCellValue('E4', 'Modelo');
$sheet->setCellValue('F4', 'Sistemas');
$sheet->setCellValue('G4', 'Estado');
$registros = $op->getAll();
$e = 5;
foreach($registros as $i =>$v){
    $sheet->setCellValue('C'.$e, ($i+1));
    $sheet->setCellValue('D'.$e, $v['maquina']);
    $sheet->setCellValue('E'.$e, $v['modelo']);
    $sheet->setCellValue('F'.$e, $v['sistemasT']);
    if($v['estadoM'] == 1){ $v['estadoM'] = 'Perfecto';}else{ $v['estadoM'] = 'Detenida';}
    $sheet->setCellValue('g'.$e, $v['estadoM']);
    $e++;
}
for($i = 5; ($e) > $i; $i++){
    for($l = 0; count($letras) > $l; $l++){
        $sheet->getStyle($letras[$l].$i)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle($letras[$l].$i)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle($letras[$l].$i)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }
}
    //$writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.ms-excel');
    //header('Content-Disposition: attachment;filename="Reporte.xlsx"');
    //header('Cache-Control: max-age=0');
    //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="reporte maquinas.xls"');
    header('Cache-Control: max-age=0');
    $writer = IOFactory::createWriter($spreadsheet, 'Xls');
    $writer->save('php://output');
?>
