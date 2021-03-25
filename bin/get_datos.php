<?php
session_start() or die('Error iniciando gestor de variables de sesión');
include('../conf/config.php');
if(!empty($_GET['user_id'])){
    $data = array();
    //get user data from the database
    $mysqli->set_charset("utf8");
    $sql = "SELECT id,texto,tipo,propietario FROM cuestionarios where propietario='".$_GET['user_id']. "' and id=".$_GET['id'];
    $resultado=(mysqli_query($mysqli, $sql));
    if ($resultado) {
        $userData = $resultado->fetch_assoc();
        $data['status'] = 'ok';
        $data['result'] = $userData;
    }else{
        $data['status'] = 'err';
        $data['result'] = '';
    }
    
    //returns data as JSON format
    echo json_encode($data);
    // {"status":"ok","result":{"id":"9","texto":"Nueva prueba","tipo":"1","propietario":"silvia"}}
}
?>