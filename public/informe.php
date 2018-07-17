<?php
require ("autoload.php");

$sql = "SELECT * FROM clientes";
$utils = new utilidades;
$utils -> sqlExcel($sql, ['nombre'=>'otro_nombre','ruta'=>__DIR__."/informes/", "hoja"=>"Mi hoja guay", "titulo"=>"Informe dispersión ".date("d-m-Y")]);
