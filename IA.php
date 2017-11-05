<?php
function mi_ayudante(){
    static $msg;
    if(empty($msg))
        $msg = "Hola! ¿en qué te puedo ayudar?";
        echo $msg.":";

    switch(ask()){
        case "no":
        case "adios":
        case "exit":
        case "cerrar":
        echo "\nBye!\n\n";
        exit;
        break;
        case "si":
            $msg= "¿qué quieres que haga?";
        break;
        case "comandos":
        case "puedes hacer":
            $msg = "LISTA DE COMANDOS:\n[/empresas] - Hacerte un informe de las mejores empresas del almacen\n";
            $msg .= "Pronto podré hacer algo más, ¿ejecuto /empresas?:";
            echo $msg;
            $res = ask();
            if($res=="si")
            goto empresas;
        break;
        case "/empresas":
            empresas:
            echo "Dime la ruta donde quieres que te lo guarde:";
            $ruta = ask();
            echo "¿qué nombre le pongo? si no me dices nada lo llamaré 'informe' :";
            $nombre = ask();
            $nombre = (empty($nombre)) ? "informe" : $nombre;
            $msg = "Vale ya tienes {$nombre}.xlsx en {$ruta}. ¿necesitas algo más?";

        break;
    }
    mi_ayudante();
}
function ask(){
    return strtolower(trim(fgets(STDIN)));
}
mi_ayudante();
