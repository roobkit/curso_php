<?php

class partida{
	
	function __construct($mat="T150067"){
		$this->matricula=$mat;
	}
	
	
/**
* Esta función devuelve el resultado del lanzamiento de un dado de
* 6 caras 
*/
	
	public function sorteo(){
		
		echo $this->matricula;
		/*$txt = $this->saluda();
		echo $txt;
		
		$salida = rand(1 ,6);
		return $salida;*/
		
	}
	
	public function saluda($txt="Hola Mundo!222"){
		echo "hola";
		
		
	}

}