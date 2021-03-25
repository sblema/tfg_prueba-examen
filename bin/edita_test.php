<?php
session_start() or die('Error iniciando gestor de variables de sesión');
include('./conf/config.php');

?>

<script>
function cambiar(){
    if (document.getElementById('op_tipo').checked==true){
      document.getElementById('tipo').value=1;
    }else{
      document.getElementById('tipo').value=0;
    }
}
</script>

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

  <div id="popup" style="display:none;">
    <div class="content-popup">
        <div class="close"><a href="#" id="close">X</a></div>
        <div>
          <h2>Ayuda:</h2>
            <p>
          Ayuda: Para cambiar el texto, solo hay que escribir en las casillas de texto. Al salir de la casilla se cambiará
automanticamente el texto, no es necesario clicar en ningún botón.<br>
    Se pueden eliminar las preguntas en el icono rojo, al hacer esto, se eliminan tambien sus respuestas. Las respuestas se  eliminan de la misma forma, pero de una en una.<br>
    El campo tipo indica si la pregunta es cierta o falsa. Este valor se indica en un checkbox, si el checkbox esta clicado el valor es cierto, sino el valor es falso.
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

<?php
function mostrarPregunta($resultados) {
  if ($resultados!=NULL) {  //id,texto,tipo,propietario
    
    $id_pregunta=$resultados['id'];
    echo "<tr>";
    echo "<td>".$resultados['id']."</th>";
    echo "<td>".$resultados['texto']."</td>";
    //echo "<th>".$resultados['tipo']."</td>";
    echo "<td></td>";
    echo "<td>".$resultados['propietario']."</td>";
    echo "<td>";
    echo "  <div class='btn-group'>";
    echo "    <a  data-placement='top' data-original-title='Borrar prueba de examen' 
                  data-toggle='tooltip' href='bin/borrar_pregunta.php?id_pregunta=".$id_pregunta."'
                   class='btn btn-danger tooltips' href='#'><i class='icon_trash_alt'></i></a>";
    echo "  </div>";
    //echo "</th>";
    echo "</tr>"; 
  }else {
    echo "";
  }
}
function mostrarRespuestas($resultados,$idcuestionario) {
  if ($resultados!=NULL) {  
    //id, id_pregunta, texto, tipo, propietario
    $id_respuesta=$resultados['id'];
    echo "<form  class='form-horizontal' action='index.php' method='post'>";
    echo "<tr>";
    echo "<td>".$resultados['id']."</td>";
    echo "<td><input type='hidden' name='pagina' value='editatest'><input type='hidden' name='idcuestionario' value='".$idcuestionario."'>
<input type='hidden' name='idrespuesta' value='".$resultados['id']."'><input class='form-control round-input' type='text' name='texto' value='".$resultados['texto']."'  onchange='this.form.submit();'></td>";

    if ($resultados['tipo']==1) {
      $texto_checked='checked';
    }else{
      $texto_checked='';
    }

    echo "<td><input type='hidden'  id='tipo' name='tipo' value='".$resultados['tipo']."'>
    <input type='checkbox' id='op_tipo' name='op_tipo' ".$texto_checked." onchange='cambiar();this.form.submit();'  class='form-control' value='".$resultados['tipo']."' /></td>";
    
    echo "<td>".$resultados['propietario']."</td>";
    echo "<td>";
    echo "  <div class='btn-group'>";
    echo "    <a  data-placement='top' data-original-title='Borrar prueba de examen' 
                  data-toggle='tooltip' href='bin/borrar_respuesta.php?id_respuesta=".$id_respuesta."'
                   class='btn btn-danger tooltips' href='#'><i class='icon_trash_alt'></i></a>";
    echo "  </div>";
    echo "</td>";
    echo "</tr></form>";
  }else {
    echo "No hay respuestas...";
  }
}
?>

  <div class="row">
    <div class="col-lg-12">
      <section class="panel">
        
<?php
$mysqli->set_charset("utf8");
$sql = "SELECT id,texto,num_max, tipo,num,propietario FROM cuestionarios";
$resultado=(mysqli_query($mysqli, $sql));
$fila = mysqli_fetch_array($resultado);
?>
      <header class="panel-heading">
                Titulo de prueba: <?php  echo $fila['texto'];        ?>
      </header>

      <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th><i class="icon_profile"></i> Id</th>
                    <th><i class="icon_calendar"></i> Descrip.</th>
                    <th><i class="icon_pin_alt"></i> Tipo</th>
                    <th><i class="icon_mail_alt"></i> Prop</th>
                    <th><i class="icon_cogs"></i> Acción</th>
                  </tr>
<?php
$sql1= "SELECT * FROM preguntas WHERE id_cuestionario=".$id_cuestionario;
$resultado1=(mysqli_query($mysqli, $sql1));
while ($fila1 = mysqli_fetch_array($resultado1)){
  mostrarPregunta($fila1);
  $sql2= "SELECT * FROM respuestas WHERE id_pregunta=".$fila1['id'];
  $resultado2=(mysqli_query($mysqli, $sql2));
  while ($fila2 = mysqli_fetch_array($resultado2)){
       mostrarRespuestas($fila2,$id_cuestionario);
  }
}
mysqli_free_result($resultado);
mysqli_close($mysqli);
?>          
                </tbody>
              </table>
