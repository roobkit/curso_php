<?php
require ("/opt/lampp/htdocs/curso_php/class/almacen.class.php");
require ("/opt/lampp/htdocs/curso_php/class/PHPExcel.php");

sistema\almacen::CSI("Como soy un metodo estático puedo usarme directamente sin instanciar");
sleep(2);
sistema\almacen::CSI("Ahora voy a instanciar el objeto almacen que se ecuentra en el espacio de nombres sistema dentro de \$obj");
sleep(2);
$obj = new sistema\almacen;
$obj->di_esto("\n Ahora hablo yo dijo el método público di_esto() \n");
sleep(2);
$obj->di_esto("\n Mira estos pedidos \n");
//datos
$sql = "SELECT * FROM pedidos...";
sleep(1);
$datos = $obj->datos($sql);
print_r($datos);
