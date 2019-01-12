<?php
require ("autoload.php");
$sql = "SELECT id_cliente AS matricula, nombre FROM clientes WHERE id_cliente IN('4','5')";
$utils = new utilidades;
$utils -> sqlExcel($sql, [
                        'nombre'=>'otro_nombre',
                        'ruta'=>__DIR__."/informes/", 
                        "hoja"=>"Mi hoja guay",
                        "titulo"=>"Informe de Actividad ".date("d-m-Y")]);