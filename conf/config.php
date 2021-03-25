<?php
/*
define('USER', 'id15217761_tecno');
define('PASSWORD', '71j=^<b]d/ixJBR8');
define('HOST', 'localhost');
define('DATABASE', 'id15217761_bd_tests');
*/
//priltkfi_db_tests
define('USER', 'priltkfi_silvia');
define('PASSWORD', '71j=^<b]d/ixJBR8');
define('HOST', 'localhost');
define('DATABASE', 'priltkfi_db_tests');
// https://code.tutsplus.com/es/tutorials/create-a-php-login-form--cms-33261 
try {
	$mysqli  = new mysqli("localhost", "priltkfi_silvia", "71j=^<b]d/ixJBR8", "priltkfi_db_tests");
}catch (mysqli_sql_exception $e) {
      throw $e;
}
?>