<?php
//include('conf/config.php');
try {
    //$mbd = new PDO('mysql:host=localhost;dbname=id15217761_bd_tests', 'id15217761_tecno', '71j=^<b]d/ixJBR8');
    /*foreach($connection->query('SELECT * from users') as $fila) {
        print_r($fila);
    }
    $connection = null;*/



    $mysqli  = new mysqli("localhost", "id15217761_tecno", "71j=^<b]d/ixJBR8", "id15217761_bd_tests");
	$res_sin_buffer = $mysqli->query("SELECT * FROM users", MYSQLI_USE_RESULT);

	if ($res_sin_buffer) {
   		while ($fila = $res_sin_buffer->fetch_assoc()) {
       		echo $fila['username'] . PHP_EOL;
   		}
    }
	$res_sin_buffer->close();

/*} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
*/
}catch (mysqli_sql_exception $e) {
      throw $e;
   }
?>