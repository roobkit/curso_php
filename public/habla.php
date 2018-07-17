<?php
require ("../includes/class/core.class.php");


core::CSI("Como soy un metodo estático puedo usarme directamente sin instanciar");
sleep(2);
core::CSI("Ahora voy a instanciar el objeto almacen que se ecuentra en el espacio de nombres sistema dentro de \$obj");
sleep(2);
$obj = new core;
$obj->di_esto("\n Ahora hablo yo dijo el método público di_esto() \n");
sleep(2);
$obj->di_esto("\n Mira estos pedidos que nos mandan del almacén: \n");
//datos
$sql = "SELECT * FROM pedidos";
sleep(1);
$datos = $obj->datos($sql);
print_r($datos);
