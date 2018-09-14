<?php
require ("autoload.php");
$sys = $obj = new core;

/*  Se genera la consulta SQL y se obtienen los datos */

$sql = "SELECT sum(valor) as value, provincia as label FROM pedidos GROUP BY provincia ORDER BY value DESC limit 5";
$sql = "SELECT count(id_pedido) as value, estado as label FROM pedidos GROUP BY estado";
$datos = json_encode($sys->datos($sql));

/* Opción varaible */
//$datos = json_encode([0=>['label'=>"alcon viajes", 'value'=>'10000']]);

//Se genera un nuevo objeto gráfico
$columnas = new grafico("column2d", "hash", "50%", 400, "contendor2", "json", '{
                "chart":{
                  "caption":"Top 5 Provincias por Facturación",
                  "numberPrefix":"",
                  "theme":"ocean"
                },
                "data":'.$datos.'
            }');
//damos paso al HTML necesario
?>

<html>
    <head>
        <title>Mi primer gráfico de Play School</title>
        <script type="text/javascript" src="/js/fusioncharts.js"></script>
        <script type="text/javascript" src="/js/themes/fusioncharts.theme.ocean.js"></script>
    </head>
    <body>
        <?php
        //Lanzamos el gráfico preparado con el método render
	        echo $columnas->render(); 
				?>
        <div id="contendor2">Aquí va el grafico</div>
    </body>
</html>
