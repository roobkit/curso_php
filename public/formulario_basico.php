<?php 
require("autoload.php");

echo "<form action='hola.php' method='POST'>
					Averías <input type='radio' name='opcion' value='averias'> 
					<input type='submit' value='Ver clientes'>
			 </form>";

if(isset($_POST['opcion']) && validauser('director')){
	$res = new core();
	
	switch($_POST['opcion']){
		case 'nodos':
			$sql="SELECT * FROM clientes ";
			$target="correo";
		break;
			
		case 'averias':
			$sql="SELECT * FROM competidores ";
			$target="nombre";
		break;
			
	}
		
	$result = $res->datos($sql);
	foreach($result as $key => $value) {
		echo $value[$target]."<br>";
	}

}
