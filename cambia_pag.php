<?php
session_start() or die('Error iniciando gestor de variables de sesión');
$_SESSION['pagina']=$_GET['pagina'];
if (isset($_SESSION['pagina'])) {
	echo "<script> window.location='index.php'; </script>";
}
?>