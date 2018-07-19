<?php
class core {
	
	/**
	 * Función generíca de consultas SQL por PDO
	 * @param $sql obligatorio string Es el SQL a ejecutar
	 * @param $array Array de valores PDO
	 *        Tambipen puede ser utilizado como el parametro $mode si se utiliza como string
	 * @param $mode string Sin argumento = array contínuo
	 * 		 NO_INDEX = Devuelve un array sin la dimension 0
	 * 		¡OJO! Si devuelve un valor numérico no será booleano
	 * @return false en caso de error, empty para procedimientos y array de datos en SELECTS
	 * Los procedimientos almacenados deben ser llamados con CALL y siempre devolverán fetchAll()
	 * */
	function datos($sql, $array=[], $mode=null){
		//combinamos parametros para poder utiliarlos de forma más flexible
		if(isset($array) && !is_array($array) && !isset($mode)){
			$mode=$array;
			$array=[];
		}
		$fetch = (strpos($sql, 'SELECT')!==false || strpos($sql, 'CALL')!==false || strpos($sql, 'SHOW')!==false) ? true : false;
		$mode=(isset($mode)) ? $mode : "";
		try{
		$res = $this->db->prepare($sql);
		$res->execute($array);
		$row = ($fetch!==false) ? $res->fetchAll(\PDO::FETCH_ASSOC) : '';
		if($mode=='NO_INDEX')
			$row=$row[0];
		} catch (Exception $e){
			 echo "algo ha fallado macho";
			return false;
		}
		return($row);
	}

	function __construct(){
		if(!isset($this->db)){
			$this->db = new \PDO('mysql:host=localhost;dbname=almacen', 'root', 'hello', []);
		}
	}
}
