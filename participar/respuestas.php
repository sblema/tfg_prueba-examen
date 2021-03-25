<?php
session_start() or die('Error iniciando gestor de variables de sesión');
include('../conf/config.php');
header("HTTP/1.1 200 OK");
header('Access-Control-Allow-Origin: *');

function limpiar($s) {
	//$s= str_replace('.', '', $s);
	//$s= str_replace(':', '', $s);
	$s= str_replace('/\r|\n/', '', $s);
	$s=trim($s);
	return $s;
}
function limpiarEspacios($s) {
	$s= str_replace('/\r|\n/', '', $s);
	return $s;
}
$json_cuestionario = file_get_contents('php://input');
$obj=json_decode($json_cuestionario);
$id_cuestionario=$obj->{'id'};
//echo 'id_cuestionario: ' .$id_cuestionario;

$titulo_prueba='"Prueba de examen A"';
$sql_preguntas="SELECT * FROM preguntas WHERE id_cuestionario=".$id_cuestionario;
//echo $sql_preguntas;
$mysqli->set_charset("utf8");
$result_preguntas=mysqli_query($mysqli, $sql_preguntas);
//$datos_preguntas=mysqli_fetch_assoc($result_preguntas);
//echo json_encode($datos_preguntas);

$json_salida= '[';
while ($fila_pregunta = mysqli_fetch_array($result_preguntas)){
	$json_salida=$json_salida.  '{"titulo":'.$titulo_prueba.',"idquestion":"'.$fila_pregunta['id'].'","pregunta":"'.limpiar($fila_pregunta['texto']).'",';

	if ($result_preguntas) {
		$sql_respuestas="SELECT * FROM respuestas where id_pregunta=" . $fila_pregunta['id'];
		$result_respuestas=mysqli_query($mysqli, $sql_respuestas);
		if ($result_respuestas) {
			$i=1;
			//$numero_filas = mysql_num_rows($result_respuestas);
			$numero_filas=2;  // solo con dos respuestas
			
			while ($i<3 &$fila = mysqli_fetch_array($result_respuestas)){
				if ($i===1)  $json_salida=$json_salida.  '"respuestas":{';
				$json_salida=$json_salida.  '"respuesta'.$i.'":{"idchoice":'. $fila['id'].',"choice":"'. limpiar($fila['texto']).'"}';
				if ($i==$numero_filas)  $json_salida=$json_salida.  '}},'; //termina
						else $json_salida=$json_salida.  ',';
				$i++;
			}
		}
  	}
}
$json_salida = substr($json_salida, 0, -1); // elimina ultima coma
$json_salida=$json_salida.  ']';
echo limpiarEspacios($json_salida);
?>