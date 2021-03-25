<?php
session_start() or die('Error iniciando gestor de variables de sesión');
include('../conf/config.php');

$id_respuesta=$_GET['id_respuesta'];

	/* change character set to utf8 */
$mysqli->set_charset("utf8");

$sql2="DELETE FROM respuestas WHERE id=".$id_respuesta;
echo $sql2;
$resultado2=(mysqli_query($mysqli, $sql2));
    

//mysqli_free_result($resultado4);
//mysqli_free_result($resultado);
mysqli_close($mysqli);

header('Location:' . getenv('HTTP_REFERER'));
?>