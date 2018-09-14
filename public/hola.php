<?php 
require("autoload.php");

$res = new core();

echo VERSION;

$sql="SELECT * FROM clientes ";
$result = $res->datos($sql);


foreach ( $result as $key => $value){
	
		echo $value['correo']."<br>";
	
}