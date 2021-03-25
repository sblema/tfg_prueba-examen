<?php
$data = json_decode( file_get_contents('https://api.mercadolibre.com/users/226384143/'), true );
echo $data['nickname'];
echo '</br>';
echo $data['etiquetas'];
echo '</br>';
?>