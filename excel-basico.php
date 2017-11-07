<?php
require (__DIR__."/class/PHPExcel.php");

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('Mi hoja 1');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Hola');
$objPHPExcel->getActiveSheet()->SetCellValue('B2', 'Mundo!');

//creamos otra hoja
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setTitle('Mi hoja 2');
$objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Hola Chavales');

//generamos fichefo
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$nombre = "basico.xlsx";
$objWriter->save(__DIR__."/informes/".$nombre);

if(file_exists(__DIR__."/informes/".$nombre))
    echo "\n\nDocumento creado con éxito ;)\n\n";
