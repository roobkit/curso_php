<?php

class don_pelayo{
	public function lanzar_piedras($numero_piedras){
		//antes de lanzar las piedras Pelayín dice que hay que afilarlas 
		$carga = $this->afilar($numero_piedras);
		return($carga);
	}
	private function afilar($trabajo){
		//El que afila las piedras siempre se queda también con 1 de recuerdo
		$entrega=$trabajo-1;
		return($entrega);
	}
}

class reconquista extends don_pelayo {
	public function ataque($numero_soldados){
		//cada soldado puede lanzar 5 piedras
		$piedras=$numero_soldados*5;
		$ataque = $this->lanzar_piedras($piedras);
		return($ataque);
	}
}

$batalla = new reconquista;

$go = $batalla->ataque(10);

echo "\n\nIniciamos la reconquista con {$go} piedras!!! \n\n";