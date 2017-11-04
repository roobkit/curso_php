<?php
namespace sistema;

class almacen {

	public function di_esto($msg){
		echo "\n\n{$msg}\n\n";
	}

	private function chivato($msg){
		echo "\n\n{$msg}\n\n";
	}

	public static function CSI($msg){
	  self::chivato($msg);
	}

	function datos($sql, $array=[], $mode=null){

		//combinamos parametros para poder utiliarlos de forma más flexible
		if(isset($array) && !is_array($array) && !isset($mode)){
			$mode=$array;
			$array=[];
		}
		$fetch = (strpos($sql, 'SELECT')!==false || strpos($sql, 'CALL')!==false || strpos($sql, 'SHOW')!==false) ? true : false;
		$mode=(isset($mode)) ? $mode : "";
		if($mode==1)
		foreach ($array as $key=>$value)
				$salida[':'.$key]=$value;
		else
			$salida = $array;
		try {
		$res = $this->db->prepare($sql);
		$res->execute($salida);
		$row = ($fetch!==false) ? $res->fetchAll(\PDO::FETCH_ASSOC) : '';
		if($mode==2)
			$row = $this->db->lastInsertId();
		if($mode==3 || $mode=='NO_INDEX')
			$row=$row[0];
		} catch (Exception $e)	{
			 echo "algo ha fallado macho";
			return false;
		}
		return($row);
	}
	function __construct(){
		if(!isset($this->db)){
		$this->db = new \PDO('mysql:host=10.34.12.18;dbname=almacen', 'curso', 'hola', array(
		  \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			\PDO::ATTR_PERSISTENT => true
		));
		$this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
	}
}
