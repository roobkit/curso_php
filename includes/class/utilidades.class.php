<?php
class utilidades extends core{
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
	*				'ruta' => ruta completa al nombre del fichero, por defecto es la ruta estandard que buscara el js generaExcel de base.js
	*/
	   function sqlExcel($p, $o=null){
		   require (__DIR__."/PHPExcel.php");
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
										->setTitle("Informe de almacen")
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
	 		 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			 $file=$o['ruta'].$o['nombre'].'.xlsx';
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
				}
		   return;
	   }
}
