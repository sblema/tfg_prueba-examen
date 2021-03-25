<?php
session_start() or die('Error iniciando gestor de variables de sesión');
include('../conf/config.php');
// En versiones de PHP anteriores a la 4.1.0, debería utilizarse $HTTP_POST_FILES en lugar
// de $_FILES.

$dir_subida = './';
$fichero_subido = $dir_subida . basename($_FILES['fichero_usuario']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
    //echo "El fichero es válido y se subió con éxito.\n";
    //echo "El archivo subido es: ".$fichero_subido;
   
    //$filename = '/uploads/file.txt';


    $fp = fopen("ejemplo_tipo_tests.txt", "r");

	/* change character set to utf8 */
	$mysqli->set_charset("utf8");
    //if (!$mysqli->set_charset("utf8")) {
    //    printf("Error loading character set utf8: %s\n", $mysqli->error);
    //} else {
      //  printf("Current character set: %s\n", $mysqli->character_set_name());
    //}

	$sql ="INSERT INTO cuestionarios (id,texto,tipo,propietario) VALUES (NULL, 'Nueva prueba', '1', 'silvia')";
	if (mysqli_query($mysqli, $sql)) {
		// devuelve el ultimo registro insertado
 		$last_id = mysqli_insert_id($mysqli);
    }

	while (!feof($fp)){
    	$linea = fgets($fp);
		if (strlen(trim($linea))!=0)  {   // sino es una linea en blanco	
    		// Si es un numero el primer caracter de la linea se trata de una pregunta, si es una letra es una respuesta
    		$tipo_linea=substr($linea, 0, 1); 
    		if (is_numeric($tipo_linea)) { // Escribimos una pregunta
				$sql = "INSERT INTO preguntas (id, id_cuestionario,texto,tipo,propietario) 
					VALUES (NULL, '".$last_id."', '".$linea."', '1', 'silvia')";
            	$lastP_id = $mysqli->insert_id;
            	if (mysqli_query($mysqli, $sql)) {
 					$lastP_id = mysqli_insert_id($mysqli);
   		    	}
    		}else {  // Escribimos una respuesta
    			$sql="INSERT INTO respuestas (id, id_pregunta,texto,tipo,propietario) VALUES (NULL, '".$lastP_id ."', '".$linea."', '1', 'silvia')";
    			if (!mysqli_query($mysqli, $sql)) {
 					echo "<h3>NO se ha insertado respuesta: </h3>";
   				}
    		}
		} // fin si la linea es vacia en el archivo de texto
	}
	fclose($fp);



	//if (file_exists($fichero_subido)) {
	//    $success = unlink($fichero_subido);
	    
	//    if (!$success) {
	//         throw new Exception("Cannot delete $filename");
	//    }
	//}
} //else {
  //  echo "¡Posible ataque de subida de ficheros!\n";
//}

//echo 'Más información de depuración:';
//print_r($_FILES);

//print "</pre>";
header('Location:' . getenv('HTTP_REFERER'));
?>