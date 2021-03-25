<?php
  session_start() or die('Error iniciando gestor de variables de sesión');
  include('./conf/config.php');
  include('./include/header_1.php');
?>
<meta charset="UTF-8"/>
<body>
<!--  comienzo pop up -->
  <style>
  #popup {
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 1001;
}
 
.content-popup {
    margin:0px auto;
    margin-top:120px;
    position:relative;
    padding:10px;
    width:70%;
    min-height:250px;
    border-radius:4px;
    background-color:#FFFFFF;
    box-shadow: 0 2px 5px #666666;
}
 
.content-popup h2 {
    color:#48484B;
    border-bottom: 1px solid #48484B;
    margin-top: 0;
    padding-bottom: 4px;
}
 
.popup-overlay {
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 999;
    display:none;
    background-color: #777777;
    cursor: pointer;
    opacity: 0.7;
}
 
.close {
    position: absolute;
    right: 15px;
}
</style>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script> 
<script> 
$(document).ready(function(){    
$('#open').on('click', function(){         
$('#popup').fadeIn('slow');         
$('.popup-overlay').fadeIn('slow');         
$('.popup-overlay').height($(window).height());         
return false;     });      
 $('#close').on('click', function(){         $('#popup').fadeOut('slow');         
$('.popup-overlay').fadeOut('slow');         
return false;     }); }); 
</script> 
<!--  fin pop up -->
  <!-- container section start -->
  <section id="container" class="">


    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom">
          <i class="icon_menu"></i>
        </div>
      </div>

      <!--logo start-->
      <a href="index.php" class="logo"><span class="lite">Pruebas de Examen</span></a>
      <!--logo end-->

      <div class="nav search-row" id="top_menu">
      </div>

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">
          <?php
              include('./include/cuenta.php');
          ?>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->

    <!--sidebar start o menu izquierdo-->
    <?php
      include('./include/side_bar.php');
    ?>
    <!--sidebar end-->

    <!--main content start-- https://www.silviabaptista.es/participar/index.php?id=9 -->
     <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text-o"></i><?php echo $_SESSION['pagina']?>
            <a href="#" class="btn btn-primary" id="open">?</a>
            </h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="icon_document_alt"></i>Forms</li>
              <li><i class="fa fa-file-text-o"></i><?php echo $_SESSION['pagina']?></li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                <?php echo $_SESSION['pagina']?>
              </header>
              <div class="panel-body">
    <?php
      if (isset($_GET['pagina'])) {
        $_SESSION['pagina']=$_GET['pagina'];
      }

      if (isset($_POST['pagina'])) {
        $_SESSION['pagina']=$_POST['pagina'];
      }
      if (isset($_SESSION['pagina'])) {
        switch ($_SESSION['pagina']) {

        case 'Dashboard':
          include('crea_test.php'); //include('./include/content.php');
        break;

        case 'crear_prueba':
          include('crea_test.php');
        break;
        case 'resultado_prueba':
          if (isset($_POST['id_cuestionario'])) {
            $id_cuestionario=$_POST['id_cuestionario'];
            $cadena_sql="SELECT distinct id, encuestado FROM examenes where idcuestionario=".$_POST['id_cuestionario'];
            echo $sql;
            $sql_hay=1;
            $sql= $mysqli -> query ($cadena_sql);
          
            if (isset($_POST['id_examinado'])) {
              $user_examinado=$_POST['id_examinado'];
              $sql_acertadas="SELECT distinct count(examenes.id) as total_acertadas FROM examenes inner join respuestas on respuestas.id=examenes.idrespuesta where idcuestionario=".$id_cuestionario." and encuestado='".$user_examinado."' and tipo=1";
            }  
          }  
            /*
            Respuestas acertadas:
SELECT distinct * FROM examenes inner join respuestas on respuestas.id=examenes.idrespuesta where idcuestionario=16 and encuestado='Pedro' and tipo=1
Respuestas no acertadas:
çSELECT distinct * FROM examenes inner join respuestas on respuestas.id=examenes.idrespuesta where idcuestionario=16 and encuestado='Pedro' and tipo=0
Preguntas en total:
Select * from preguntas where id_cuestionario=16
            */
         
          include('resultado_prueba.php');

        break;

        case 'buscar_prueba':
          $mysqli->set_charset("utf8");
          if (isset($_POST["texto_busqueda"])){
            $sql="Select * from cuestionarios where texto like '%".$_POST["texto_busqueda"]."%';";
          }else{
            $sql = "SELECT * FROM cuestionarios";
          }
          include('search.php');
        break;

        case 'chart_chartjs':
          include('chart-chartjs.php');
        break;

        case 'editatest':
          //estas variables se puede usar en edita_test
          $id_cuestionario=$_GET['id_prueba'];
          if (isset($_POST["idrespuesta"])){
            if (isset($_POST["texto"])){
              $id_cuestionario=$_GET['id_prueba'];
              $sqlrespuestas="UPDATE  respuestas SET texto='".$_POST["texto"]."' WHERE id=" .$_POST["idrespuesta"].";";
              if (mysqli_query($mysqli, $sqlrespuestas)){
              }
            }
            if (isset($_POST["tipo"])){
              if ($_POST["tipo"]==1) {
                $tipo_respuesta=0;
              }else{
                $tipo_respuesta=1;
              }
              $sqltipo="UPDATE  respuestas SET tipo='".$tipo_respuesta."' WHERE id=" .$_POST["idrespuesta"].";";
              if (mysqli_query($mysqli, $sqltipo)){
                //echo $sqltipo;
              }
            }
          }
          if (isset($_POST["idcuestionario"])){
            $id_cuestionario=$_POST["idcuestionario"];
          }
          include('./bin/edita_test.php');
        break;
        }

      }
    ?>
              </div>
            </section>
            </div>
          </div>
     <!-- page end-->
      </section>
    </section>
    <!--main content end-->



      <div class="text-right">
        <div class="credits">
          <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
          -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

  <!-- javascripts -->
  <?php
      include('./include/lib_jscript.php');
    ?>

</body>

</html>
