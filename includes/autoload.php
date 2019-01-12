<?php
include ("constantes.php");
spl_autoload_register(function($clase) {
	include __DIR__."/class/{$clase}.class.php";
	
});
