<?php
session_start() or die('Error iniciando gestor de variables de sesión');
include('conf/config.php');
?>

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

a.logo {
    font-size: 16px;
    font-weight: 600;
    color: #fed189;
    float: left;
    margin-top: 15px;
    text-transform: uppercase;
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

 <div id="popup" style="display:none;">
    <div class="content-popup">
        <div class="close"><a href="#" id="close">X</a></div>
        <div>
          <h2>Ayuda:</h2>
            <p>
              Indicar en la casilla de "search" la cadena a buscar para la prueba de examen.
            </p>
            <div style="float:left;width:100%;">
      </div>
        </div>
    </div>
</div>
<div class="popup-overlay"></div>



<?php
if (isset($_SESSION['message']) && $_SESSION['message']) {
    printf('<b>%s</b>', $_SESSION['message']);
    unset($_SESSION['message']);
}

function mostrarDatos ($resultados) {
  if ($resultados!=NULL) {  //id,texto,tipo,propietario
    $id_cuestionario=$resultados['id'];
    $tipoPrueba='<span class="label label-success">A</span>';
    if ($resultados['tipo']==0) $tipoPrueba='<span class="label label-danger">C</span>';
    echo "<tr>";
    echo "<td>".$id_cuestionario."</td>";
    echo "<td>".$resultados['texto']."</td>";
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
<!--
  <div class="row">
    <div class="col-lg-12">
      <section class="panel">
      -->
<?php

$resultado=(mysqli_query($mysqli, $sql));
if ($resultado) {
?>
        <ul class="nav top-menu">
          <li>
            <form class="navbar-form"  action="index.php?pagina=buscar_prueba&id_prueba=<?php echo $idcuestionario ?>" 
                  method="post">
              <input type='hidden' name='pagina' value='buscar_prueba'>
              <input type='hidden' name='id_prueba' value='<?php echo $idcuestionario ?>'>
              <input type='hidden' name='idcuestionario' value='<?php echo $idcuestionario ?>'>
              <input class="form-control round-input" name="texto_busqueda"
                    placeholder="Search" type="text">
            </form>
          </li>
        </ul>
<!--
        <header class="panel-heading">
                Resultado de la búsqueda:
        </header>
-->
<div class="nav search-row" id="top_menu">
        <!--  search form start -->
       
        <!--  search form end -->
      </div>
        <table class="table-striped table-advance table-hover table-responsive" style="width: 100%;">
          <tbody>
                  <tr>
                    <th><i class="icon_profile d-none"></i> Id</th>
                    <th><i class="icon_calendar"></i> Descripción</th>
                    <th><i class="icon_pin_alt"></i> Estado</th>
                    <th><i class="icon_pin_alt d-none"></i> nº</th>
                    <th><i class="icon_mail_alt"></i> Prop.</th>
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




<!--
      </section>
    </div>
  </div>

  </body>
</html>-->