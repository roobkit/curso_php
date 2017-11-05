<?php
require ("/opt/lampp/htdocs/curso_php/class/almacen.class.php");
require ("/opt/lampp/htdocs/curso_php/class/utilidades.class.php");

$sql = "SELECT * FROM pedidos";
$utils = new utilidades;
$utils -> sqlExcel($sql,['nombre'=>'informe','ruta'=>'/opt/lampp/htdocs/curso_php/']);

echo "\n\nDocumento creado con éxito ;)\n\n";
