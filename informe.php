<?php
require (__DIR__."/class/almacen.class.php");
require (__DIR__."/class/utilidades.class.php");

$sql = "SELECT * FROM pedidos";
$utils = new utilidades;
$utils -> sqlExcel($sql,['nombre'=>'informe','ruta'=>__DIR__."/informes/"]);

echo "\n\nDocumento creado con éxito ;)\n\n";
