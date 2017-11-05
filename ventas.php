<?php
require ($_SERVER["DOCUMENT_ROOT"]."/curso_php/class/almacen.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/curso_php/class/graficos/graficos.class.php");

$sys = $obj = new sistema\almacen;

/*  Se genera la consulta SQL y se obtienen los datos

    Como siempre es exactamente la misma podemos usar una constante
    Si en el mismo script queremos hacer otra consulta deberíamos crear una constante distinta
    Por eso normalemente se usa siempre una variable string facilmente reemplazable*/

 /* Opción varaible */
$sql = "SELECT sum(PVP) as value, nombre as label FROM pedidos INNER JOIN clientes on pedidos.id_cliente = clientes.id_cliente
        GROUP BY nombre ORDER BY value DESC LIMIT 5";

/* Opción constante */
define("SQL_INGRESOS","SELECT sum(PVP) as value, nombre as label FROM pedidos INNER JOIN clientes on pedidos.id_cliente = clientes.id_cliente
        GROUP BY nombre ORDER BY value DESC LIMIT 5;");

$datos = json_encode($sys->datos($sql));
$datos = json_encode($sys->datos(SQL_INGRESOS));

//Se genera un nuevo objeto gráfico
$columnas = new grafico("column2d", "hash", "100%", 400, "contendor2", "json", '{
                "chart":{
                  "caption":"Facturación PVP cliente",
                  "subCaption":"Detalle de los 5 mejores",
                  "numberPrefix":"€",
                  "exportEnabled": "1",
                  "theme":"zune"
                },
                "data":'.$datos.'
            }');
//damos paso al HTML necesario            
?>

<html>
    <head>
        <title>Mi primer gráfico de Play School</title>
        <script type="text/javascript" src="./class/graficos/js/fusioncharts.js"></script>
        <script type="text/javascript" src="./class/graficos/js/themes/fusioncharts.theme.zune.js"></script>
    </head>
    <body>
        <?php
        //Lanzamos el gráfico preparado con el método render
        $columnas->render(); ?>
        <div id="contendor2">Aquí va el grafico</div>
    </body>
</html>
