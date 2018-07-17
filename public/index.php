<?php
include("autoload.php");
$sys = new core;

$pedidos=$sys->datos("SELECT * FROM pedidos");

foreach ($pedidos as $key => $value){
	print_r($value);
	echo "<br />";
}