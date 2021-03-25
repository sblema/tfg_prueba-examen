<?php
session_start() or die('Error iniciando gestor de variables de sesión');
include('../conf/config.php');

$id_pregunta=$_GET['id_pregunta'];

/* change character set to utf8 */
$mysqli->set_charset("utf8");

$sql2="DELETE FROM respuestas WHERE id_pregunta=".$id_pregunta;
$resultado2=(mysqli_query($mysqli, $sql2));
$sql3="DELETE FROM preguntas WHERE id=".$id_pregunta;
$resultado3=(mysqli_query($mysqli, $sql3));

mysqli_close($mysqli);

header('Location:' . getenv('HTTP_REFERER'));
?>