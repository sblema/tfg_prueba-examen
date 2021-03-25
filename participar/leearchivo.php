<?php
header("Access-Control-Allow-Origin: *");
// este cabecero es necesario para habilitar llamadas de dominio de fuera 
//https://ourcodeworld.com/articles/read/291/how-to-solve-the-client-side-access-control-allow-origin-request-error-with-your-own-symfony-3-api
// https://stackoverflow.com/questions/1653308/access-control-allow-origin-multiple-origin-domains
$fp = fopen("plantilla-prueba.html", "r");
while (!feof($fp)){
    $linea = fgets($fp);
    echo $linea;
}
fclose($fp);
?>
