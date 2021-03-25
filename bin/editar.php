<?php
session_start() or die('Error iniciando gestor de variables de sesión');
include('../conf/config.php');

$id_cuestionario=$_GET['id_prueba'];

	/* change character set to utf8 */
$mysqli->set_charset("utf8");
$sql1="SELECT * FROM preguntas where id_cuestionario=".$id_cuestionario;
echo $sql1;
$resultado=(mysqli_query($mysqli, $sql1));
while ($fila = mysqli_fetch_array($resultado)){
    $sql2="DELETE FROM respuestas WHERE id_pregunta=".$fila['id'];
    echo $sql2;
    $resultado2=(mysqli_query($mysqli, $sql2));
    //mysqli_free_result($resultado2);
    $sql3="DELETE FROM preguntas WHERE id=".$fila['id'];
    echo $sql3;
    $resultado3=(mysqli_query($mysqli, $sql3));
    //mysqli_free_result($resultado3);
}
$sql4="DELETE FROM cuestionarios WHERE id=".$id_cuestionario;
echo $sql4;
$resultado4=(mysqli_query($mysqli, $sql4));

//mysqli_free_result($resultado4);
//mysqli_free_result($resultado);
mysqli_close($mysqli);

header('Location:' . getenv('HTTP_REFERER'));
?>