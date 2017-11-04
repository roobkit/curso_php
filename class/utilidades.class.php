<?php
class utilidades extends sistema\almacen {
	/**
	* Esta funcion genera un Excel desde un SQL dado.
	*
	* Los parametros son
	* @param $p string/array Si es in string se interpretará como SQL.
	* 											 	Si es un array el formato deberá ser el mismo que la salida de bbddGo();
	*												$array[indice]['columna'] = "valor";
	* @param $o array de opciones
	*				'hoja' => Nombre de la hoja
	*				'nombre => Nombre del excel'
	*				'titulo' => Título que tendrá el informe
	*				'cabecera' => Array de nobres de la cabecera. Esta opción sustituye a los nombres de cabecera del SQL
	*				'types' => Array de columna donde el indice es el número de columna empezando por 0
	*									columna => tipo de dato donde:
	*															'date' => fecha sin horas
	*															'datetime' => fecha con horas
	*				'file' => ruta completa al nombre del fichero, por defecto es la ruta estandard que buscara el js generaExcel de base.js
	*/
	   function sqlExcel($p, $o=null){
		   require_once '/opt/lampp/htdocs/gm/includes/Classes/PHPExcel.php';
		   set_time_limit(200);
		   $row=1;
		   if(!is_array($p))
		   $res=parent::datos($p);
		   else
		   $res=$p;

		   if(!isset($res[0])){
			   echo "ERROR"; // Esta devolución mediante echo, hace que la función js generaExcel(); muestre por pantalla un error.
			   return;
		   }

		   $objPHPExcel = new PHPExcel();
		   $objPHPExcel->getProperties()->setCreator("El departamento de marrones")
										->setLastModifiedBy("El director")
										->setTitle("Informe de almacen")
										->setSubject("Informe de almacen")
										->setDescription("Informe de almacen")
										->setKeywords("office 2007 openxml php")
										->setCategory("Informes");
		   $objPHPExcel->setActiveSheetIndex(0);
		   $excelStyle_titulo = [
			   "font"=>["bold"=>true],
			 "fill"=>['type' => PHPExcel_Style_Fill::FILL_SOLID,"color"=>["rgb"=>"FFFFFF"]]
		   ];
		   $excelStyle_cabecera = [
			   "font"=>["bold"=>true],
			 "borders"=>["bottom" =>["style"=>PHPExcel_Style_Border::BORDER_THIN,"color"=>["rgb"=>"3399ff"]]],
			 "fill"=>['type' => PHPExcel_Style_Fill::FILL_SOLID,"color"=>["rgb"=>"FFFFFF"]]
		   ];
		   $excelStyle_contenido = [
			 "fill"=>['type' => PHPExcel_Style_Fill::FILL_SOLID,"color"=>["rgb"=>"FFFFFF"]]
		   ];
		   $cab=(isset($o['cabecera'])) ? $o['cabecera'] : array_keys($res[0]);

		   $name = (isset($o['hoja'])) ? $o['hoja'] : "Hoja 1";
		   $objPHPExcel->getActiveSheet()->setTitle($name);

		   if(isset($o['titulo'])){
				   $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(0,$row,count($cab)-1,$row);
				   $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$row, $o['titulo']);
				   $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0,$row,count($cab)-1,$row)->applyFromArray($excelStyle_titulo);
				   $row++;
				   $objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(0,$row,count($cab)-1,$row);
				   $row++;

		   }

		   foreach($cab as $col => $v){
			   $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $v);
			   $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
		   }
		   $objPHPExcel->getActiveSheet()->setAutoFilterByColumnAndRow(0,$row,count($cab)-1,$row);
		   $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(0,$row,count($cab)-1,$row)->applyFromArray($excelStyle_cabecera);

		   $row++;
		   foreach($res as $key => $value){
			   $col=0;
			   foreach($value as $v){
				   if(strlen($v)>40){
					   $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(false);
					   $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(30);
				   }
				   if(strlen($v)<5){
					   $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(false);
					   $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setWidth(10);
				   }
				   if(isset($o['types'][$col]))
					   switch($o['types'][$col]){
						   case 'datetime' :
						   $v = PHPExcel_Shared_Date::PHPToExcel($v);
						   $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->getNumberFormat()->setFormatCode('dd-mm-yyyy H:i:s');
						   break;
						   case 'date' :
						   $v = PHPExcel_Shared_Date::PHPToExcel($v);
						   $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->getNumberFormat()->setFormatCode('dd-mm-yyyy');
						   break;
					   }
				   $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, trim($v));
				   $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,$row,count($cab)-1,$row)->applyFromArray($excelStyle_contenido);

				   $col++;
			   }
		   $row++;
		   }

		   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		   header('Content-Disposition: attachment;filename="01simple.xlsx"');
		   header('Cache-Control: max-age=0');
		   header('Cache-Control: max-age=1');
		   header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		   header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		   header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		   header ('Pragma: public'); // HTTP/1.0
		   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		   $objWriter->save($o['file'].$o['nombre'].'.xlsx');
		   return;
	   }
}
