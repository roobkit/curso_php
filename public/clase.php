<?php
require("autoload.php");


class suma{
	function mi_suma($param='CERRADO'){
		$obj = new core;
		$sql="SELECT SUM(valor) as ventas FROM pedidos WHERE estado= ? ";
		$res = $obj->datos($sql,[$param], "NO_INDEX");
		echo $res['ventas'];
	}
}

$obj= new suma;

$obj->mi_suma('ABIERTO');



	