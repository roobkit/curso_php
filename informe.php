<?php
require ("/opt/lampp/htdocs/curso_php/class/almacen.class.php");
require ("/opt/lampp/htdocs/curso_php/class/utilidades.class.php");
require ("/opt/lampp/htdocs/curso_php/class/PHPExcel.php");

$sql = "SELECT * FROM pedidos";
$utils = new utilidades;
$utils -> sqlExcel($sql,['nombre'=>'informe','file'=>'/opt/lampp/htdocs/curso_php/']);
