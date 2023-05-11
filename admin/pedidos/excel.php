<?php
require '../template/vendor/autoload.php';
require '../class/Pedidos.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$op = new Pedidos();
$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator('Navy_Seal')
->setTitle('Reporte de Pedidos')
->setDescription('Archivo Excel con Pedidos registrados');
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
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
$sheet->setCellValue('C3', 'Lista de Pedidos');
$sheet->setCellValue('C4', '#');
$sheet->setCellValue('D4', 'Cliente');
$sheet->setCellValue('E4', 'Razón social');
$sheet->setCellValue('F4', 'Modelo');
$sheet->setCellValue('G4', 'Talla');
$sheet->setCellValue('H4', 'Cantidad');
$sheet->setCellValue('I4', 'Estado');
$registros = $op->getAll();
$e = 5;
foreach($registros as $i =>$v){
    $sheet->setCellValue('C'.$e, ($i+1));
    $sheet->setCellValue('D'.$e, $v['nombreC']);
    $sheet->setCellValue('E'.$e, $v['rSocial']);
    $sheet->setCellValue('F'.$e, $v['modelo']);
    $sheet->setCellValue('G'.$e, $v['talla']);
    $sheet->setCellValue('H'.$e, $v['cantidad']);
    if($v['estadoPedido'] == 1){ $v['estadoPedido']='Terminado';}else if($v['estadoPedido'] == 2){$v['estadoPedido']='En proceso';}else if($v['estadoPedido'] == 3){ $v['estadoPedido'] = "En espera";}
    $sheet->setCellValue('I'.$e, $v['estadoPedido']);
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
    header('Content-Disposition: attachment;filename="reporte pedidos.xls"');
    header('Cache-Control: max-age=0');
    $writer = IOFactory::createWriter($spreadsheet, 'Xls');
    $writer->save('php://output');
?>
