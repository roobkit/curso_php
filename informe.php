<?php
require (__DIR__."/class/almacen.class.php");
require (__DIR__."/class/utilidades.class.php");

$sql = "SELECT nombre FROM clientes";
$utils = new utilidades;
$utils -> sqlExcel($sql, ['nombre'=>'otro_nombre','ruta'=>__DIR__."/informes/", "hoja"=>"Mi hoja guay", "titulo"=>"Informe dispersión ".date("d-m-Y")]);

if(file_exists(__DIR__."/informes/informe2.xlsx")){
echo "\n\nDocumento creado con éxito ;)\n\n";
}else{
echo "\n\nAlgo ha fallado :( \n\n";
}
