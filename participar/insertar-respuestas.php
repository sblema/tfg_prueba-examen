<?php
session_start() or die('Error iniciando gestor de variables de sesión');
include('../conf/config.php');
header('Access-Control-Allow-Origin: *');
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
var_dump($obj);
$mysqli->set_charset("utf8");
foreach($obj as $respuestas) {
	for ($i=0;$i < count($respuestas);++$i) {
		$respuesta=(string) $respuestas[$i];
		if ($i==0){
            //$usuario=$respuesta;
            $cadena = explode(",", $respuesta);
		}else{
//$sql="INSERT INTO examenes (id,idcuestionario,idrespuesta,encuestado) VALUES (NULL, '.$cadena[1].', '".$respuesta."','".$usuario."');";	
$sql="INSERT INTO examenes (id,idcuestionario,idrespuesta,encuestado) VALUES (NULL, '".$cadena[1]."', '".$respuesta."','".$cadena[0]."');";
			if (mysqli_query($mysqli, $sql)) {
 				$last_id = mysqli_insert_id($mysqli);
    		}

		}
	}
		
}
$sqlcuestionario="UPDATE cuestionarios SET num=num+1 WHERE id=".$cadena[1] .";";
echo $sqlcuestionario;
if (mysqli_query($mysqli, $sqlcuestionario)){
        echo "Registro actualizado.";
		$sql="Select * cuestionarios WHERE id=".$cadena[1] .";";
		
		$resultado = mysqli_query($mysqli, $sql);

		echo "Orden del conjunto de resultados...\n";
		while($row = mysqli_fetch_assoc($resultado)) {
        echo 'Numero maximo:' . $row['num_max'] . ' Numero contestadas:'.$row['num'];
    	if ($row['num_max']==$row['num']){
    		// Cerrar el cuestionario
    		$sqlcuestionario="UPDATE cuestionarios SET tipo='0' WHERE id=".$cadena[1] .";";
    		if (mysqli_query($mysqli, $sqlcuestionario)) {
 				$last_id = mysqli_insert_id($mysqli);
    		}


    	}
}



        header("HTTP/1.1 200 OK");
    } else {
        echo "ERROR: No se ejecuto $sql. " . mysqli_error($link);
    }
mysqli_close($mysqli);
//header("HTTP/1.1 200 OK");
?>