<?php

class caja_bici {
  static function pantalla($texto){
      echo "Bienvenido al curso  ".$texto."\n\n";
  }
}

caja_bici::pantalla("de PHP");
