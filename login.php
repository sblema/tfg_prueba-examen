
<?php
include('./conf/config.php');

function mensajeUsuario($messaje_user){
        echo '<div class="alert alert-block alert-danger fade in">';
        echo '<button data-dismiss="alert" class="close close-sm" type="button">';
        echo '<i class="icon-remove"></i>';
        echo '</button>';
        echo '<strong><font style="vertical-align: inherit;">'.$messaje_user.'</font></strong>';
        echo '</div>'; 
}

   include('./include/header.php');
   ?>
<style>
#cajacookies {
  box-shadow: 0px 0px 5px 5px #808080;
  background-color: white;
  color: black;
  padding: 10px;
  margin-left: -15px;
  margin-right: -15px;
  margin-bottom: 0px;
  position: fixed;
  top: 0px;
  /*width: 100%;*/
}

#cajacookies button {
  color: black;
}
</style>
   echo '<font color="#fff">TFG: Generador de prueba de exámenes</font>';

<script>
/* ésto comprueba la localStorage si ya tiene la variable guardada */
function compruebaAceptaCookies() {
  if(localStorage.aceptaCookies == 'true'){
    cajacookies.style.display = 'none';
  }
}

/* aquí guardamos la variable de que se ha
aceptado el uso de cookies así no mostraremos
el mensaje de nuevo */
function aceptarCookies() {
  localStorage.aceptaCookies = 'true';
  cajacookies.style.display = 'none';
}

/* ésto se ejecuta cuando la web está cargada */
$(document).ready(function () {
  compruebaAceptaCookies();
});
</script>

<?php
   include('include/form_login.php'); /* no ha hecho login*/
   //echo '</div>';
?>

<div id="cajacookies">
<p><button onclick="aceptarCookies()" class="pull-right"><i class="fa fa-times"></i> Aceptar y cerrar éste mensaje</button>
Éste sitio web usa cookies, si permanece aquí acepta su uso.
Puede leer más sobre el uso de cookies en nuestra <a href="politica.html">política de privacidad</a>.
</p>
</div>

</div></body></html>';
?>



