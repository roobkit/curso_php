<?php
class caja_bici {
  static function pantalla($texto){
      echo "Te saco por pantalla: ".$texto."\n\n";
  }
}

caja_bici::pantalla("hola mundo");
