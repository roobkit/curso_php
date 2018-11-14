<?php
require ("class/PHPExcel.php");

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
$file = __DIR__."/informes/".$nombre;
$objWriter->save($file);

if(PHP_SAPI!='cli'){
	header('Content-Description: File Transfer');
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header("Content-Disposition: attachment; filename=\"".basename($file)."\"");
	header("Content-Transfer-Encoding: binary");
	header("Expires: 0");
	header("Pragma: public");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header('Content-Length: ' . filesize($file)); //Remove

	ob_clean();
	flush();

	readfile($file);
	unlink($file);
}else{
	if(file_exists($file))
    echo "\n\nDocumento creado con éxito ;)\n\n";
}