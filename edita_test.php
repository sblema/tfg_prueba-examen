<?php
session_start() or die('Error iniciando gestor de variables de sesión');
include('../conf/config.php');
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
<body>
  <?php
    if (isset($_SESSION['message']) && $_SESSION['message'])
    {
      printf('<b>%s</b>', $_SESSION['message']);
      unset($_SESSION['message']);
    }
  ?>
  <form method="POST" action="bin/subir.php" enctype="multipart/form-data">
    <label class="btn btn-info btn-lg" 
        style="border-radius:50%;margin-left:10px;margin-top:2px;margin-bottom:2px;height:70px;width:70px;">  
      <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
      <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
      <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->  
      <span class="icon_cloud-upload_alt" style="font-size: 44px;margin-left:-3px;margin-top: 0px;"></span>
      <input type="file"  name="fichero_usuario"/>
    </label>
  
    <input 
    data-original-title="Info" 
    data-content="En el icono azul, selecciona el archivo a subir, despues pincha en el botón para subir el archivo." 
    data-placement="right" data-trigger="hover" class="popovers"
           type="submit" name="uploadBtn"  value="Subir archivo" />
  </form>
 
<?php
function mostraPregunta($resultados) {
  if ($resultados!=NULL) {  //id,texto,tipo,propietario
    //id, id_pregunta, texto, tipo, propietario
    $id_cuestionario=$resultados['id'];
    echo "<tr>";
    echo "<td>Pregunta: ".$resultados['id']."</td>";
    echo "<td>".$resultados['id_cuestionario']."</td>";
    echo "<td>".$resultados['texto']."</td>";
    echo "<td>".$resultados['tipo']."</td>";
    echo "<td>".$resultados['propietario']."</td>";
    echo "<td>";
    echo "  <div class='btn-group'>";
    echo "    <a data-placement='top' data-original-title='Editar prueba de examen' 
                  data-toggle='tooltip'  class='btn btn-warning tooltips' href='#'>
                 <i class='icon_pencil-edit'></i></a>";

    echo "    <a  data-placement='top' data-original-title='Consultar prueba de examen' 
                  data-toggle='tooltip'
                  class='btn btn-success tooltips' href='#'><i class='icon_check_alt2'></i></a>";

    echo "    <a  data-placement='top' data-original-title='Borrar prueba de examen' 
                  data-toggle='tooltip' href='bin/borrar.php?id_prueba=".$id_cuestionario."'
                   class='btn btn-danger tooltips' href='#'><i class='icon_trash_alt'></i></a>";
    echo "  </div>";
    echo "</td>";
    echo "</tr>";
  }else {
    echo "";
  }
}
function mostrarRespuestas($resultados) {
  if ($resultados!=NULL) {  //id,texto,tipo,propietario
    //id, id_pregunta, texto, tipo, propietario
    $id_cuestionario=$resultados['id'];
    echo "<tr>";
    echo "<td>Respuesta: ".$resultados['id']."</td>";
    echo "<td>".$resultados['id_pregunta']."</td>";
    echo "<td>".$resultados['texto']."</td>";
    echo "<td>".$resultados['tipo']."</td>";
    echo "<td>".$resultados['propietario']."</td>";
    echo "<td>";
    echo "  <div class='btn-group'>";
    echo "    <a data-placement='top' data-original-title='Editar prueba de examen' 
                  data-toggle='tooltip'  class='btn btn-warning tooltips' href='#'>
                 <i class='icon_pencil-edit'></i></a>";

    echo "    <a  data-placement='top' data-original-title='Consultar prueba de examen' 
                  data-toggle='tooltip'
                  class='btn btn-success tooltips' href='#'><i class='icon_check_alt2'></i></a>";

    echo "    <a  data-placement='top' data-original-title='Borrar prueba de examen' 
                  data-toggle='tooltip' href='bin/borrar.php?id_prueba=".$id_cuestionario."'
                   class='btn btn-danger tooltips' href='#'><i class='icon_trash_alt'></i></a>";
    echo "  </div>";
    echo "</td>";
    echo "</tr>";
  }else {
    echo "";
  }
}
?>

 <br><br>
  <div class="row">
    <div class="col-lg-12">
      <section class="panel">
        <header class="panel-heading">
<?php
$mysqli->set_charset("utf8");
$sql = "SELECT id,texto,tipo,propietario FROM cuestionarios";
$resultado1=(mysqli_query($mysqli, $sql));
?>
                Listado de pruebas
        </header>

        <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th><i class="icon_profile"></i> Id</th>
                    <th><i class="icon_profile"></i> Id_pregunta</th>
                    <th><i class="icon_calendar"></i> Descripción</th>
                    <th><i class="icon_pin_alt"></i> Tipo</th>
                    <th><i class="icon_mail_alt"></i> Propietario</th>
                    <th><i class="icon_cogs"></i> Acción</th>
                  </tr>

<?php
$sql= "SELECT * FROM respuestas WHERE id_cuestionario=".$_GET['id_prueba'];
$resultado1=(mysqli_query($mysqli, $sql));
while ($fila = mysqli_fetch_array($resultado1)){
  $sql1= "SELECT * FROM preguntas WHERE id_pregunta=".$fila['id'];
  $resultado2=(mysqli_query($mysqli, $sql));
  while ($fila = mysqli_fetch_array($resultado2)){
       mostrarRespuestas($fila);
  }
}
mysqli_free_result($resultado);
mysqli_close($mysqli);
?>

                  
                </tbody>
              </table>
            </section>
          </div>
        </div>








</body>
</html>