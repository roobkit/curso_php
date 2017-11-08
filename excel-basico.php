<?php
require (__DIR__."/class/PHPExcel.php");

//algunos estilos

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('Mi hoja 1');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 5);
$objPHPExcel->getActiveSheet()->SetCellValue('A2', 10);
$objPHPExcel->getActiveSheet()->SetCellValue('A3', '=SUM(A1+A2)');
$objPHPExcel->getActiveSheet()->getStyle("A3")->getFont()->setBold(true);

//creamos otra hoja
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setTitle('Mi hoja 2');
$objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Hola Chavales');

$objPHPExcel->setActiveSheetIndex(0);

//generamos fichefo
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$nombre = "real_gana.xlsx";
$objWriter->save(__DIR__."/informes/".$nombre);

if(file_exists(__DIR__."/informes/".$nombre))
    echo "\n\nDocumento creado con éxito ;)\n\n";
