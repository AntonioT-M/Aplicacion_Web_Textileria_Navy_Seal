<?php
require '../template/vendor/autoload.php';
require '../class/Clientes.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$op = new Clientes();
$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator('Navy_Seal')
->setTitle('Reporte de Clientes')
->setDescription('Archivo Excel con Clientes registrados');
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);
$spreadsheet->setActiveSheetIndex(0);
$sheet = $spreadsheet->getActiveSheet();
$sheet->getStyle('C3:F4')->getAlignment()->setHorizontal('center');
$sheet->getStyle('C3:F4')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$sheet->getStyle('C4:F4')->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('C4:F4')->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$letras = ["C", "D", "E", "F"];
for($l = 0; count($letras) > $l; $l++){
    $sheet->getStyle($letras[$l]."4")->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->getStyle($letras[$l]."4")->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
}
$sheet->mergeCells('C3:F3');
$sheet->getStyle('C3:F3')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->setCellValue('C3', 'Lista de Clientes');
$sheet->setCellValue('C4', '#');
$sheet->setCellValue('D4', 'Nombre');
$sheet->setCellValue('E4', 'Razon social');
$sheet->setCellValue('F4', 'Tipo');
$registros = $op->getAll();
$e = 5;
foreach($registros as $i =>$v){
    $sheet->setCellValue('C'.$e, ($i+1));
    $sheet->setCellValue('D'.$e, $v['nombreC']);
    $sheet->setCellValue('E'.$e, $v['rSocial']);
    $sheet->setCellValue('F'.$e, $v['tipo']);
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
    header('Content-Disposition: attachment;filename="reporte clientes.xls"');
    header('Cache-Control: max-age=0');
    $writer = IOFactory::createWriter($spreadsheet, 'Xls');
    $writer->save('php://output');
?>
