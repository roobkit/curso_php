<?php
class caja_bici {
  static function pantalla($texto){
      echo "Método de clase: ".$texto."\n\n";
  }
}


caja_bici::pantalla("hola mundo");
