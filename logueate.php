
<?php
session_start() or die('Error iniciando gestor de variables de sesión');
include('./conf/config.php');



if (isset($_POST['username'])&&isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    /* SELECT MD5('testing') */

    $res_sin_buffer = $mysqli->query("SELECT * FROM users WHERE USERNAME='".$username."'", MYSQLI_USE_RESULT);
    if (!$res_sin_buffer) { 
        $res_sin_buffer->close();
        echo "<script> window.location='login.php'; </script>";
        //header("Location: .login.php"); 
    } else {
        $fila = $res_sin_buffer->fetch_assoc();
        if (md5($password)==$fila['password']){
            $_SESSION['user_id'] = $fila['id'];
            $_SESSION['name']= $fila['name'];
            $_SESSION['pagina']= 'Dashboard';
            //echo ''. $_SESSION['user_id'];
            echo "<script> window.location='index.php'; </script>";
            //header("Location: .index.php"); 
        } else {// Contraseña no valida
            echo "<script> window.location='login.php'; </script>";
            //header("Location: .login.php"); 

        }
    }
}

?>