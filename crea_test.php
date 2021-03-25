<?php
session_start() or die('Error iniciando gestor de variables de sesión');
include('conf/config.php');
?>
<!--
<!DOCTYPE html>
<html>
<head>
  <title>Crear prueba examen subiendo un archivo</title>
  <meta charset="UTF-8"/>
-->
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
<!--</head>-->
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
  <div id="popup" style="display:none;">
    <div class="content-popup">
        <div class="close"><a href="#" id="close">X</a></div>
        <div>
          <h2>Ayuda:</h2>
            <p>
              Para crear una prueba de examen solo es necesario subir un archivo de texto con las preguntas y respuestas
    con el siguiente formato:<br>
      1. La retribución se realiza en función:<br>
      A. Del valor del puesto de trabajo y de las contribuciones del trabajador o rendimiento.<br>
      B. Del valor del puesto de trabajo y de la actitud del trabajador.<br>


      2. Los tres objetivos implícitos relacionados con la gestión de los recursos humanos son:<br>
      A. La mejora de la productividad, la mejora de la calidad de vida en el trabajo y mejora de la rentabilidad.<br>
      B. La mejora de la productividad, la mejora de calidad de vida en el trabajo y el cumplimiento de la normativa.<br>
            </p>
            <div style="float:left;width:100%;">
      </div>
        </div>
    </div>
</div>
<div class="popup-overlay"></div>
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
function mostrarDatos ($resultados) {
  if ($resultados!=NULL) {  //id,texto,tipo,propietario
    $id_cuestionario=$resultados['id'];
    $tipoPrueba='<span class="label label-success">Abierta</span>';
    if ($resultados['tipo']==0) $tipoPrueba='<span class="label label-danger">Cerrada</span>';
    echo "<tr>";
    echo "<td>".$id_cuestionario."</td>";
    echo "<td>".$resultados['texto']."</td>";
    echo "<td>".$resultados['num_max']."</td>";
    echo "<td>".$tipoPrueba."</td>";
    echo "<td>".$resultados['num']."</td>";
    echo "<td>".$resultados['propietario']."</td>";
    echo "<td>";
    echo "  <div class='btn-group'>";
    echo "    <a data-placement='top' data-original-title='Editar prueba de examen' 
                  href='index.php?pagina=editatest&id_prueba=".$id_cuestionario."'
                  data-toggle='tooltip'  class='btn btn-warning tooltips' href='#'>
                 <i class='icon_pencil-edit'></i></a>";

    echo "    <a  data-placement='top' data-original-title='Copiar enlace a la prueba de examen' 
                  data-toggle='tooltip' onclick='copiarAlPortapapeles(\"p".$id_cuestionario."\")'
                  class='btn btn-success tooltips' href='#'><i class='icon_check_alt2'></i></a>";

    echo "    <a  data-placement='top' data-original-title='Borrar prueba de examen' 
                  data-toggle='tooltip' href='bin/borrar.php?id_prueba=".$id_cuestionario."'
                   class='btn btn-danger tooltips' href='#'><i class='icon_trash_alt'></i></a>";
    echo '<p id="p'.$id_cuestionario.'" style="display:none">https://www.silviabaptista.es/participar/index.php?id='.$id_cuestionario.'</p>';
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


<?php
 echo "  <p>Leyenda:</p><div class='btn-group'>";
    echo "    <span class='label label-warning'>Editar prueba de examen
                 <i class='icon_pencil-edit'></i></span>";
    echo "    <span class='label label-success'>Copiar enlace para prueba de examen<i class='icon_check_alt2'></i></span>";
    echo "    <span class='label label-danger'>Borrar prueba de examen<i class='icon_trash_alt'></i></span>";
echo "</div>";

$mysqli->set_charset("utf8");
$sql = "SELECT id,texto,num_max,tipo,num,propietario FROM cuestionarios";
$resultado=(mysqli_query($mysqli, $sql));
if ($resultado) {
?>

        <header class="panel-heading">
                Listado de pruebas
        </header>

        <table class="table-striped table-advance table-hover" style="width: 100%;">
                <tbody>
                  <tr>
                    <th><i class="icon_profile"></i> Id</th>
                    <th><i class="icon_calendar"></i> Descripción</th>
                    <th><i class="icon_pin_alt"></i> nºMax</th>
                    <th><i class="icon_pin_alt"></i> Tipo</th>
                    <th><i class="icon_pin_alt"></i> nº</th>
                    <th><i class="icon_mail_alt"></i> Propietario</th>
                    <th><i class="icon_cogs"></i> Acción</th>
                  </tr>

<?php
while ($fila = mysqli_fetch_array($resultado)){
    mostrarDatos($fila);
}
mysqli_free_result($resultado);
mysqli_close($mysqli);
?>

                  
                </tbody>
              </table>
<?php
} // fin mostrar datos
else{
  echo 'no existen pruebas de test';
}
?>
            </section>
          </div>
        </div>







<!--
</body>
</html>
-->