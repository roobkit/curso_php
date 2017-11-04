<?php
require ("/opt/lampp/htdocs/curso_php/class/almacen.class.php");
require ("/opt/lampp/htdocs/curso_php/class/PHPExcel.php");

sistema\almacen::CSI("leches");

$obj = new sistema\almacen;

$obj->di_esto("\n hola fondo norte \n");

//datos
$sql = "SELECT * FROM pedidos";
$datos = $obj->datos($sql);
print_r($datos);
