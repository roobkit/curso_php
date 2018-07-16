<?php
include ("constantes.inc");
spl_autoload_register(function($clase) {
	include "Classes/{$clase}.class.php";
});
