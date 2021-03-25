<?php
session_start() or die('Error iniciando gestor de variables de sesión');
include('conf/config.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Crear prueba examen subiendo un archivo</title>
  <meta charset="UTF-8"/>
  <style>
    .boton{
  width:50px;
  height:50px;
  background-color:#34aadc;
  margin: 5px;
  padding:10px;
  -webkit-border-radius: 50px;
  -moz-border-radius: 50px;
  border-radius: 50px;
  font-size:11px;
  line-height:32px;
  text-transform: uppercase;
  float:left;
}
.boton:hover{
  opacity: 0.50;
  -moz-opacity: .50;
  filter:alpha (opacity=50);
}
.boton a{
  color:#fff;
  text-decoration:none;
  padding:5px 5px 5px 0;
}
input[type="file"] {
    display: none;
}
input[type="submit"] {
    -webkit-appearance: button;
    cursor: pointer;
    text-decoration: none;
    padding: 3px;
    padding-left: 10px;
    padding-right: 10px;
    font-family: helvetica;
    font-weight: 200;
    font-size: 20px;
    font-style: normal;
    color: #9b9b9b;
    background-color: #e0e0e0;
    border-radius: 15px;
    border: 0px double #006505;
    width: 180px;
    height: 50px;
  }
  input[type="submit"]:hover{
    opacity: 0.6;
    text-decoration: none;
  }
  </style>
</head>
<script>
  function copiarAlPortapapeles(id_elemento) {
      var aux = document.createElement("input");
      aux.setAttribute("value", document.getElementById(id_elemento).innerHTML);
      document.body.appendChild(aux);
      aux.select();
      document.execCommand("copy");
      document.body.removeChild(aux);
  }
</script>
<body>
  <?php
    if (isset($_SESSION['message']) && $_SESSION['message'])
    {
      printf('<b>%s</b>', $_SESSION['message']);
      unset($_SESSION['message']);
    }
  ?>

  <div class="row">
    <div class="col-lg-12">
      <section class="panel">




</section>
          </div>
        </div>








</body>
</html>