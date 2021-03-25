<?php
session_start() or die('Error iniciando gestor de variables de sesión');
include('conf/config.php');
?>

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
      //printf('<b>%s</b>', $_SESSION['message']);
      unset($_SESSION['message']);
    }
  ?>

  <div class="row">
    <div class="col-lg-12">
      <section class="panel">
<form  class='form-horizontal' action='index.php' method='post'> 
  <input type='hidden' name='pagina' value='resultado_prueba'>
  <?php
  if (isset($id_cuestionario)) {
    echo "<input type='hidden' name='id_cuestionario' value='".$id_cuestionario."'>";
  }
  ?>
  <p>Selecciona una de las prueba creadas:</p>
    <p>Pruebas de examen:
      <select name='id_cuestionario'>
        <option value="0">Seleccione:</option>
        <?php
        // solo pruebas de examen contestadas
          $query = $mysqli -> query ("SELECT distinct cuestionarios.id as id, texto FROM examenes inner join cuestionarios on cuestionarios.id=examenes.idcuestionario");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores['id'].'">'.$valores['texto'].'</option>';
          }
        ?>
      </select>
      <button class="btn btn-primary">OK</button>
    </p>
<?php
if (isset($sql_hay)) {
?>
    <p>Usuarios evaluados:
      <select name='id_examinado'>
        <?php      
          while ($valores = mysqli_fetch_array($sql)) {
            echo '<option value="'.$valores['encuestado'].'">'.$valores['encuestado'].'</option>';
          }
        ?>
      </select>
      <button class="btn btn-primary">busca resultados</button>
    </p>
<?php
}
if (isset($user_examinado)){
  $query_acertadas = $mysqli -> query($sql_acertadas);
  echo $sql_acertadas;
  $valores = mysqli_fetch_array($query_acertadas);
  echo 'total_acertadas: ' . $valores['total_acertadas'];
}
?>
</form>

      </section>
    </div>
  </div>








</body>
</html>