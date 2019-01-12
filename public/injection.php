<?php
 
 include("../includes/class/core.class.php");

 $obj = new core;
 
 
 $user="1";
 $pass="' OR 1=1 # ";
 
 $sql="SELECT * FROM clientes  ";

 
 $data = $obj->datos($sql);
 
 
 $columnas = array_keys($data[0]);
 
  foreach($columnas as $k => $v){
        echo $v."    |     ";
    } 
 
 echo "<br>";
 
foreach($data as $key => $value){
    
    foreach($columnas as $k => $v){
        echo $value[$v]." ";
    }
    
    echo "<br>";
}
    

 



